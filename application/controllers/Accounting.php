<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounting extends MY_Controller {

    private $upload_path = "./uploads/accounting/";
    private $expenses_path = "./uploads/accounting/expenses/";
    public function __construct()
    {
        parent::__construct();

        $this->checkLogin();
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
        $this->load->model('Estimate_model', 'estimate_model');
        $this->load->model('Jobs_model', 'jobs_model');
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
                array("",	array('/accounting/chart_of_accounts','/accounting/reconcile')),
            );
        $this->page_data['menu_icon'] = array("fa-tachometer","fa-university","fa-credit-card","fa-money","fa-dollar","fa-bar-chart","fa-minus-circle","fa-file","fa-calculator");
    }

    /*public function index()
    {
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->load->view('tools/business_tools', $this->page_data);
    }*/
    public function banking()
    {
        $is_allowed = $this->isAllowedModuleAccess(45);
        if( !$is_allowed ){
            $this->page_data['module'] = 'accounting';
            echo $this->load->view('no_access_module', $this->page_data, true);
            die();
        }

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
            
        $this->load->view('accounting/dashboard', $this->page_data);
    }

    public function apply_for_capital() {
        $this->load->view('includes/header', $this->page_data);
        $this->load->view('accounting/apply_for_capital', $this->page_data);
    }

    public function expenses()
    {
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['vendors'] = $this->vendors_model->getVendors();
        $this->page_data['checks'] = $this->expenses_model->getCheck();
        $this->page_data['transactions'] = $this->expenses_model->getTransaction();
        $this->page_data['categories'] = $this->expenses_model->getExpenseCategory();
        $this->page_data['bills'] = $this->expenses_model->getBill();
        $this->page_data['vendor_credits'] = $this->expenses_model->getVendorCredit();
        $this->page_data['expenses'] = $this->expenses_model->getExpense();
        $this->page_data['list_categories'] = $this->categories_model->getCategories();
        $this->page_data['attachments'] = $this->expenses_model->getAttachment();
        $this->load->view('accounting/expenses', $this->page_data);
    }
    public function vendors(){
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['vendors'] = $this->vendors_model->getVendors();
        $this->load->view('accounting/vendors', $this->page_data);
    }

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

    public function chart_of_accounts()
    {
        $this->page_data['alert'] = 'accounting/alert_promt';
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->load->view('accounting/chart_of_accounts/index', $this->page_data);
    }

    public function attachments()
    {
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->load->view('accounting/lists/attachment', $this->page_data);
    }

    public function upload_files()
    {
        $this->load->helper('string');
        $files = $_FILES['attachments'];

        if(count($files) > 0) {
            $data = [];
            foreach($files['name'] as $key => $name) {
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

            $insert = $this->accounting_attachments_model->insertBatch($data);


            $return = [
                'data' => $insert,
                'success' => $insert ? true : false,
                'message' => $insert ? 'Success!' : 'Error!'
            ];
        } else {
            $return = [
                'data' => null,
                'success' => false,
                'message' => 'No files uploaded.'
            ];
        }

        echo json_encode($return);
    }

    public function load_attachment_files()
    {
        $post = json_decode(file_get_contents('php://input'), true);
        $start = $post['start'];
        $limit = $post['length'];

        $attachments = $this->accounting_attachments_model->getCompanyAttachments();

        $data = [];

        if(count($attachments) > 0) {
            foreach($attachments as $attachment) {
                $data[] = [
                    'id' => $attachment['id'],
                    'thumbnail' => $attachment['stored_name'],
                    'type' => $attachment['type'],
                    'name' => $attachment['uploaded_name'],
                    'size' => $attachment['size'],
                    'upload_date' => date('m/d/Y', strtotime($attachment['created_at'])),
                    'links' => '',
                    'note' => $attachment['notes']
                ];
            }
        }

        $result = [
            'draw' => $post['draw'],
            'recordsTotal' => count($attachments),
            'recordsFiltered' => count($data),
            'data' => array_slice($data, $start, $limit)
        ];

        echo json_encode($result);
    }

    public function download_attachment() {
        $filename = $this->input->get('filename');
        $file = "./uploads/accounting/attachments/$filename";

        if(file_exists($file)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.basename($file).'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            readfile($file);
        }
    }

    public function edit_attachment() {
        $post = $this->input->post();

        $data = [
            'uploaded_name' => $post['file_name'],
            'notes' => $post['notes']
        ];

        $update = $this->accounting_attachments_model->updateAttachment($post['id'], $data);

        echo json_encode([
            'data' => $update,
            'success' => $update ? true : false,
            'message' => $update ? 'Success!' : 'Error!'
        ]);
    }

    public function delete_attachment($id) {
        $result = [];

        $attachment = $this->accounting_attachments_model->getById($id);
        if(file_exists("./uploads/accounting/attachments/".$attachment->stored_name)) {
            unlink("./uploads/accounting/attachments/".$attachment->stored_name);
        }
        $delete = $this->accounting_attachments_model->delete($id);
        $result['success'] = $delete;
        $result['message'] = $delete ? 'Successfully Deleted' : 'Failed to Delete';

        echo json_encode($result);
        exit;
    }

    public function payment_methods()
    {
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->load->view('accounting/payment_methods', $this->page_data);
    }

    public function add_payment_method()
    {
        $data = [
            'company_id' => getLoggedCompanyID(),
            'name' => $this->input->post('name'),
            'credit_card' => $this->input->post('credit_card'),
            'status' => 1,
            'created_at' => date('Y-m-d h:i:s'),
            'updated_at' => date('Y-m-d h:i:s')
        ];

        $paymentMethod= $this->accounting_payment_methods_model->create($data);

        $return = [
            'data' => $paymentMethod,
            'success' => $paymentMethod ? true : false,
            'message' => $paymentMethod ? 'Success!' : 'Error!'
        ];

        echo json_encode($return);
    }

    public function load_payment_methods()
    {
        $post = json_decode(file_get_contents('php://input'), true);
        $order = $post['order'][0]['dir'];
        $start = $post['start'];
        $limit = $post['length'];

        $status = [
            1
        ];

        if($post['inactive'] === '1' || $post['inactive'] === 1) {
            array_push($status, 0);
        }

        $paymentMethods = $this->accounting_payment_methods_model->getCompanyPaymentMethods($order, $status);

        $data = [];
        $search = $post['columns'][0]['search']['value'];

        if(count($paymentMethods) > 0) {
            foreach($paymentMethods as $method) {
                if($search !== "") {
                    if(stripos($method['name'], $search) !== false) {
                        $data[] = [
                            'id' => $method['id'],
                            'name' => $method['name'],
                            'credit_card' => $method['credit_card'],
                            'status' => $method['status']
                        ];
                    }
                } else {
                    $data[] = [
                        'id' => $method['id'],
                        'name' => $method['name'],
                        'credit_card' => $method['credit_card'],
                        'status' => $method['status']
                    ];
                }
            }
        }

        $result = [
            'draw' => $post['draw'],
            'recordsTotal' => count($paymentMethods),
            'recordsFiltered' => count($data),
            'data' => array_slice($data, $start, $limit)
        ];

        echo json_encode($result);
    }

    public function delete_payment_method($id) {
        $result = [];

        $delete = $this->accounting_payment_methods_model->delete($id);
        $result['success'] = $delete;
        $result['message'] = $delete ? 'Successfully Deleted' : 'Failed to Delete';

        echo json_encode($result);
        exit;
    }

    public function activate_payment_method($id) {
        $result = [];

        $activate = $this->accounting_payment_methods_model->activate($id);
        $result['success'] = $activate;
        $result['message'] = $activate ? 'Successfully Activated' : 'Failed to activate';

        echo json_encode($result);
        exit;
    }

    public function update_payment_method()
    {
        $data = [
            'name' => $this->input->post('name'),
            'credit_card' => $this->input->post('credit_card')
        ];

        $update = $this->accounting_payment_methods_model->updatePaymentMethod($this->input->post('id'), $data);

        echo json_encode([
            'data' => $update,
            'success' => $update ? true : false,
            'message' => $update ? 'Success!' : 'Error!'
        ]);
    }

    public function recurring_transactions()
    {
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->load->view('accounting/recurring_transactions', $this->page_data);
    }

    public function load_recurring_transactions()
    {
        $post = json_decode(file_get_contents('php://input'), true);
        $column = $post['order'][0]['column'];
        $order = $post['order'][0]['dir'];
        $columnName = $post['columns'][$column]['name'];
        $start = $post['start'];
        $limit = $post['length'];

        $where = [
            'company_id' => getLoggedCompanyID(),
            'status' => 1
        ];

        if($post['type'] !== "all") {
            $where['recurring_type'] = $post['type'];
        }

        if($post['transaction_type'] !== "all") {
            $where['txn_type'] = $post['transaction_type'];
        }

        $items = $this->accounting_recurring_transactions_model->getCompanyRecurringTransactions($where, $columnName, $order);

        $data = [];
        $search = $post['columns'][0]['search']['value'];

        if(count($items) > 0) {
            foreach($items as $item) {
                switch ($item['recurring_interval']) {
                    case 'daily' :
                        $interval = 'Every Day';
                    break;
                    case 'weekly' :
                        $interval = 'Every Week';
                    break;
                    case 'monthly' :
                        $interval = 'Every Month';
                    break;
                    case 'yearly' :
                        $interval = 'Every Year';
                    break;
                }

                if($search !== "") {
                    if(stripos($item['template_name'], $search) !== false) {
                        $data[] = [
                            'id' => $item['id'],
                            'template_name' => $item['template_name'],
                            'recurring_type' => ucfirst($item['recurring_type']),
                            'txn_type' => ucwords($item['txn_type']),
                            'recurring_interval' => $interval,
                            'previous_date' => $item['previous_date'] !== '' && $item['previous_date'] !== null ? date('m/d/Y', strtotime($item['previous_date'])) : null,
                            'next_date' => $item['next_date'] !== '' && $item['next_date'] !== null ? date('m/d/Y', strtotime($item['next_date'])) : null,
                            'customer_vendor' => null,
                            'amount' => null
                        ];
                    }
                } else {
                    $data[] = [
                        'id' => $item['id'],
                        'template_name' => $item['template_name'],
                        'recurring_type' => ucfirst($item['recurring_type']),
                        'txn_type' => ucwords($item['txn_type']),
                        'recurring_interval' => $interval,
                        'previous_date' => $item['previous_date'] !== '' && $item['previous_date'] !== null ? date('m/d/Y', strtotime($item['previous_date'])) : null,
                        'next_date' => $item['next_date'] !== '' && $item['next_date'] !== null ? date('m/d/Y', strtotime($item['next_date'])) : null,
                        'customer_vendor' => null,
                        'amount' => null
                    ];
                }
            }
        }

        $result = [
            'draw' => $post['draw'],
            'recordsTotal' => count($items),
            'recordsFiltered' => count($data),
            'data' => array_slice($data, $start, $limit)
        ];

        echo json_encode($result);
    }

    public function delete_recurring_transaction($id) {
        $result = [];

        $delete = $this->accounting_recurring_transactions_model->delete($id);
        $result['success'] = $delete;
        $result['message'] = $delete ? 'Successfully Deleted' : 'Failed to Delete';

        echo json_encode($result);
        exit;
    }

    public function get_recurring_transaction($id) {
        $this->load->model('accounting_bank_deposit_model');
        $this->load->model('accounting_transfer_funds_model');
        $this->load->model('accounting_journal_entries_model');

        $data = $this->accounting_recurring_transactions_model->getRecurringTransaction($id);

        switch($data->txn_type) {
            case 'deposit' :
                $data->transaction = $this->accounting_bank_deposit_model->getById($data->txn_id);

                $tags = [];
                if($data->transaction->tags !== null) {
                    foreach(json_decode($data->transaction->tags, true) as $tag) {
                        $t = $this->tags_model->getTagById($tag);
                        $tags[] = [
                            'id' => $tag,
                            'name' => $t->name
                        ];
                    }
                }

                $data->transaction->tags = json_encode($tags);
                $data->transaction->items = $this->accounting_bank_deposit_model->getFunds($data->transaction->id);
            break;
            case 'transfer' :
                $data->transaction = $this->accounting_transfer_funds_model->getById($data->txn_id);
            break;
            case 'journal entry' :
                $data->transaction = $this->accounting_journal_entries_model->getById($data->txn_id);
                $data->transaction->items = $this->accounting_journal_entries_model->getEntries($data->transaction->id);
            break;
        }

        $result = [
            'data' => $data,
            'success' => $data ? true : false,
            'message' => $data ? 'Success' : 'Error'
        ];

        echo json_encode($result);
        exit;
    }

    public function update_recurring_transaction($type, $id) {
        $data = $this->input->post();
        
        switch($type) {
            case 'deposit' :
                $this->form_validation->set_rules('bank_account', 'Bank Account', 'required');

                if($data['cash_back_amount'] !== "") {
                    $this->form_validation->set_rules('cash_back_target', 'Cash back account', 'required|differs[bank_account]');
                }

                $this->form_validation->set_rules('account[]', 'Account', 'required');
                $this->form_validation->set_rules('amount[]', 'Amount', 'required');
            break;
            case 'transfer' :
                $this->form_validation->set_rules('transfer_from', 'Transfer From Account', 'required');
                $this->form_validation->set_rules('transfer_to', 'Transfer To Account', 'required|differs[transfer_from]');
                $this->form_validation->set_rules('transfer_amount', 'Amount', 'required');
            break;
        }

        $this->form_validation->set_rules('template_name', 'Template Name', 'required');
        $this->form_validation->set_rules('recurring_type', 'Recurring Type', 'required');

        if($data['recurring_type'] !== 'unscheduled') {
            $this->form_validation->set_rules('recurring_interval', 'Recurring interval', 'required');

            if($data['recurring_interval'] !== 'daily') {
                if($data['recurring_interval'] === 'monthly') {
                    $this->form_validation->set_rules('recurring_week', 'Recurring week', 'required');
                } else if($data['recurring_interval'] === 'yearly') {
                    $this->form_validation->set_rules('recurring_month', 'Recurring month', 'required');
                }

                $this->form_validation->set_rules('recurring_day', 'Recurring day', 'required');
            }
            if($data['recurring_interval'] !== 'yearly') {
                $this->form_validation->set_rules('recurr_every', 'Recurring interval', 'required');
            }
            $this->form_validation->set_rules('end_type', 'Recurring end type', 'required');

            if($data['end_type'] === 'by') {
                $this->form_validation->set_rules('end_date', 'Recurring end date', 'required');
            } else if($data['end_type'] === 'after') {
                $this->form_validation->set_rules('max_occurence', 'Recurring max occurence', 'required');
            }
        }

        $return = [];

        if($this->form_validation->run() === false) {
            $return['data'] = null;
            $return['success'] = false;
            $return['message'] = 'Error';
        } else {
            if($type === 'journal_entry') {
                $totalDebit = array_sum(array_map(function($item) { 
                    return $item;
                }, $data['debits']));
        
                $totalCredit = array_sum(array_map(function($item) { 
                    return $item;
                }, $data['credits']));

                if(isset($data['accounts']) && count($data['accounts']) < 2 || !isset($data['accounts'])) {
                    $return['data'] = null;
                    $return['success'] = false;
                    $return['message'] = 'You must fill out at least two detail lines.';

                    echo json_encode($return);
                    exit;
                } else if($totalDebit !== $totalCredit) {
                    $return['data'] = null;
                    $return['success'] = false;
                    $return['message'] = 'Please balance debits and credits.';

                    echo json_encode($return);
                    exit;
                }
            }

            $recurringData = [
                'template_name' => $data['template_name'],
                'recurring_type' => $data['recurring_type'],
                'days_in_advance' => $data['recurring_type'] !== 'unscheduled' ? $data['days_in_advance'] !== '' ? $data['days_in_advance'] : null : null,
                'recurring_interval' => $data['recurring_interval'],
                'recurring_month' => $data['recurring_interval'] === 'yearly' ? $data['recurring_month'] : null,
                'recurring_week' => $data['recurring_interval'] === 'monthly' ? $data['recurring_week'] : null,
                'recurring_day' => $data['recurring_interval'] !== 'daily' ? $data['recurring_day'] : null,
                'recurr_every' => $data['recurring_interval'] !== 'yearly' ? $data['recurr_every'] : null,
                'start_date' => $data['recurring_type'] !== 'unscheduled' ? $data['start_date'] !== "" ? date('Y-m-d', strtotime($data['start_date'])) : null : null,
                'end_type' => $data['end_type'],
                'end_date' => $data['end_type'] === 'by' ? $data['end_date'] !== "" ? date('Y-m-d', strtotime($data['end_date'])) : null : null,
                'max_occurences' => $data['end_type'] === 'after' ? $data['max_occurence'] : null,
                'updated_at' => date('Y-m-d h:i:s')
            ];

            $recurringUpdate = $this->accounting_recurring_transactions_model->updateRecurringTransaction($id, $recurringData);

            if($recurringUpdate) {
                $recurringData = $this->accounting_recurring_transactions_model->getRecurringTransaction($id);

                switch($type) {
                    case 'deposit' :
                        $this->load->model('accounting_bank_deposit_model');
                        $bankAccount = explode('-', $data['bank_account']);
                        $cashBackTarget = explode('-', $data['cash_back_target']);

                        $totalAmount = array_sum(array_map(function($item) {
                            return floatval($item);
                        }, $data['amount']));

                        $totalAmount = $totalAmount - floatval($data['cash_back_amount']);

                        $depositData = [
                            'account_key' => $bankAccount[0],
                            'account_id' => $bankAccount[1],
                            'tags' => $data['tags'] !== null ? json_encode($data['tags']) : null,
                            'total_amount' => number_format($totalAmount, 2, '.', ','),
                            'cash_back_account_key' => $cashBackTarget[0],
                            'cash_back_account_id' => $cashBackTarget[1],
                            'cash_back_memo' => $data['cash_back_memo'],
                            'cash_back_amount' => $data['cash_back_amount'],
                            'memo' => $data['memo'],
                            'updated_at' => date('Y-m-d h:i:s')
                        ];

                        $transactionUpdate = $this->accounting_bank_deposit_model->update($recurringData->txn_id, $depositData);

                        $deleteFunds = $this->accounting_bank_deposit_model->deleteFunds($recurringData->txn_id);

                        $fundsData = [];
                        foreach($data['account'] as $key => $value) {
                            $account = explode('-', $value);
                            $receivedFrom = explode('-', $data['received_from'][$key]);

                            $fundsData[] =[
                                'bank_deposit_id' => $recurringData->txn_id,
                                'received_from_key' => $receivedFrom[0],
                                'received_from_id' => $receivedFrom[1],
                                'received_from_account_key' => $account[0],
                                'received_from_account_id' => $account[1],
                                'description' => $data['description'][$key],
                                'payment_method' => $data['payment_method'][$key],
                                'ref_no' => $data['reference_no'][$key],
                                'amount' => $data['amount'][$key],
                            ];
                        }

                        $fundsId = $this->accounting_bank_deposit_model->insertFunds($fundsData);
                    break;
                    case 'transfer' :
                        $this->load->model('accounting_transfer_funds_model');
                        $transferFrom = explode('-', $data['transfer_from']);
                        $transferTo = explode('-', $data['transfer_to']);

                        $transferData = [
                            'transfer_from_account_key' => $transferFrom[0],
                            'transfer_from_account_id' => $transferFrom[1],
                            'transfer_to_account_key' => $transferTo[0],
                            'transfer_to_account_id' => $transferTo[1],
                            'transfer_amount' => $data['transfer_amount'],
                            'transfer_memo' => $data['memo'],
                            'updated_at' => date('Y-m-d h:i:s')
                        ];

                        $transactionUpdate = $this->accounting_transfer_funds_model->update($recurringData->txn_id, $transferData);
                    break;
                    case 'journal_entry' :
                        $this->load->model('accounting_journal_entries_model');
                        $entryData = [
                            'memo' => $data['memo'],
                            'updated_at' => date('Y-m-d h:i:s')
                        ];

                        $transactionUpdate = $this->accounting_journal_entries_model->update($recurringData->txn_id, $entryData);

                        $deleteEntries = $this->accounting_journal_entries_model->deleteEntries($recurringData->txn_id);

                        $entryItems = [];
                        foreach ($data['accounts'] as $key => $value) {
                            $name = explode('-', $data['names'][$key]);
                            $account = explode('-', $value);
            
                            $entryItems[] = [
                                'journal_entry_id' => $recurringData->txn_id,
                                'account_key' => $account[0],
                                'account_id' => $account[1],
                                'debit' => $data['debits'][$key],
                                'credit' => $data['credits'][$key],
                                'description' => $data['descriptions'][$key],
                                'name_key' => $name[0],
                                'name_id' => $name[1]
                            ];
                        }

                        $entryItemsId = $this->accounting_journal_entries_model->insertEntryItems($entryItems);
                    break;
                }
            }

            $return['success'] = $recurringUpdate && $transactionUpdate ? true : false;
            $return['message'] =  $recurringUpdate && $transactionUpdate ? 'Update Successful!' : 'An unexpected error occured!';
        }

        echo json_encode($return);
    }

    public function terms()
    {
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->load->view('accounting/terms', $this->page_data);
    }

    public function add_terms()
    {
        $data = [
            'company_id' => getLoggedCompanyID(),
            'name' => $this->input->post('name'),
            'type' => $this->input->post('type'),
            'net_due_days' => $this->input->post('type') === "1" ? $this->input->post('net_due_days') === "" ? 0 : $this->input->post('net_due_days') : null,
            'day_of_month_due' => $this->input->post('type') === "2" ? $this->input->post('day_of_month_due') === "" ? 0 : $this->input->post('day_of_month_due') : null,
            'minimum_days_to_pay' => $this->input->post('type') === "2" ? $this->input->post('minimum_days_to_pay') === "" ? 0 : $this->input->post('minimum_days_to_pay') : null,
            'discount_days' => 0,
            'created_at' => date('Y-m-d h:i:s'),
            'updated_at' => date('Y-m-d h:i:s')
        ];

        $term = $this->accounting_terms_model->create($data);

        $return = [
            'data' => $term,
            'success' => $term ? true : false,
            'message' => $term ? 'Success!' : 'Error!'
        ];

        echo json_encode($return);
    }

    public function load_terms()
    {
        $post = json_decode(file_get_contents('php://input'), true);
        $order = $post['order'][0]['dir'];
        $start = $post['start'];
        $limit = $post['length'];

        $status = [
            1
        ];

        if($post['inactive'] === '1' || $post['inactive'] === 1) {
            array_push($status, 0);
        }

        $terms = $this->accounting_terms_model->getCompanyTerms($order, $status);

        $data = [];
        $search = $post['columns'][0]['search']['value'];

        if(count($terms) > 0) {
            foreach($terms as $term) {
                if($search !== "") {
                    if(stripos($term['name'], $search) !== false) {
                        $data[] = [
                            'id' => $term['id'],
                            'name' => $term['name'],
                            'type' => $term['type'],
                            'net_due_days' => $term['net_due_days'],
                            'day_of_month_due' => $term['day_of_month_due'],
                            'minimum_days_to_pay' => $term['minimum_days_to_pay'],
                            'status' => $term['status']
                        ];
                    }
                } else {
                    $data[] = [
                        'id' => $term['id'],
                        'name' => $term['name'],
                        'type' => $term['type'],
                        'net_due_days' => $term['net_due_days'],
                        'day_of_month_due' => $term['day_of_month_due'],
                        'minimum_days_to_pay' => $term['minimum_days_to_pay'],
                        'status' => $term['status']
                    ];
                }
            }
        }

        $result = [
            'draw' => $post['draw'],
            'recordsTotal' => count($terms),
            'recordsFiltered' => count($data),
            'data' => array_slice($data, $start, $limit)
        ];

        echo json_encode($result);
    }

    public function delete_term($id) {
        $result = [];

        $delete = $this->accounting_terms_model->delete($id);
        $result['success'] = $delete;
        $result['message'] = $delete ? 'Successfully Deleted' : 'Failed to Delete';

        echo json_encode($result);
        exit;
    }

    public function activate_term($id) {
        $result = [];

        $activate = $this->accounting_terms_model->activate($id);
        $result['success'] = $activate;
        $result['message'] = $activate ? 'Successfully Activated' : 'Failed to activate';

        echo json_encode($result);
        exit;
    }

    public function update_term()
    {
        $data = [
            'name' => $this->input->post('name'),
            'type' => $this->input->post('type'),
            'net_due_days' => $this->input->post('type') === "1" ? $this->input->post('net_due_days') === "" ? 0 : $this->input->post('net_due_days') : null,
            'day_of_month_due' => $this->input->post('type') === "2" ? $this->input->post('day_of_month_due') === "" ? 0 : $this->input->post('day_of_month_due') : null,
            'minimum_days_to_pay' => $this->input->post('type') === "2" ? $this->input->post('minimum_days_to_pay') === "" ? 0 : $this->input->post('minimum_days_to_pay') : null,
        ];

        $update = $this->accounting_terms_model->updateTerm($this->input->post('id'), $data);

        echo json_encode([
            'data' => $update,
            'success' => $update ? true : false,
            'message' => $update ? 'Success!' : 'Error!'
        ]);
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

    //december 30 update
    //Tags
    public function tags()
    {
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->load->view('accounting/tags', $this->page_data);
    }

    public function get_group_tags()
    {
        $groupTags = $this->tags_model->getGroup();

        $return = [];

        foreach($groupTags as $group) {
            $return['results'][] = [
                'id' => $group['id'],
                'text' => $group['name']
            ];
        }

        echo json_encode($return);
    }

    public function load_all_tags()
    {
        $post = json_decode(file_get_contents('php://input'), true);

        $getTags = $this->tags_model->getTags();

        $tags = [];
        foreach($getTags as $key => $tag) {
            $nameColumn = '';
            if($tag['type'] === 'group' && count($tag['tags']) > 0) {
                $nameColumn .= '<a class="mr-3 cursor-pointer" data-toggle="collapse" data-target="#child-'.$key.'"><i class="fa fa-chevron-down"></i></a>';
            }

            if($tag['type'] === 'group'){
                $nameColumn .= '<span class="'.$tag['type'].'-span-'.$tag['id'].'">'.$tag['name'].' ('.count($tag['tags']).')</span>';
            } else {
                $nameColumn .= '<span class="'.$tag['type'].'-span-'.$tag['id'].'">'.$tag['name'].'</span>';
            }

            $actionsColumn = '';

            if($tag['type'] === 'group') {
                $nameColumn .= '
                <div class="form-group-'.$tag['id'].' hide">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" name="group_name" value="'.$tag['name'].'" data-id="'.$tag['id'].'" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-success" id="submiteUpdateTag" data-type="group" data-id="'.$tag['id'].'">Save</button>
                            <button type="button" class="close float-right text-dark" data-type="group" id="closeFormTag" data-id="'.$tag['id'].'" style="transform: translate(0px, -15px);"><span aria-hidden="true">×</span></button>
                        </div>
                    </div>
                </div>';

                $actionsColumn .= '
                <div class="dropdown">
                    <button type="button" class="btn btn-success" style="border-radius: 36px 0 0 36px;">Run report</button>
                    <button class="btn btn-success" type="button" data-toggle="dropdown" style="border-radius: 0 36px 36px 0;margin-left: -5px;">
                        <span class="fa fa-caret-down"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right" data-id="'.$tag['id'].'" data-name="'.$tag['name'].'" data-type="group">
                        <li><a href="javascript:void(0);" id="addNewTag" class="dropdown-item" >Add tag</a></li>
                        <li><a href="javascript:void(0);" id="updateTagGroup" class="dropdown-item">Edit group</a></li>
                        <li><a href="javascript:void(0);" id="deleteGroup" class="dropdown-item">Delete group</a></li>
                    </ul>
                </div>';
            } else {
                $nameColumn .= '
                <div class="form-'.$tag['type'].'-'.$tag['id'].' hide">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" name="tags_name" value="'.$tag['name'].'" data-id="'.$tag['id'].'" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-success" id="submiteUpdateTag" data-type="'.$tag['type'].'" data-id="'.$tag['id'].'">Save</button>
                            <button type="button" class="close float-right text-dark" data-type="'.$tag['type'].'" id="closeFormTag" data-id="'.$tag['id'].'" style="transform: translate(0px, -15px);"><span aria-hidden="true">×</span></button>
                        </div>
                    </div>
                </div>';

                $actionsColumn .= '
                <div class="dropdown">
                    <button type="button" class="btn btn-success" style="border-radius: 36px 0 0 36px;">Run report</button>
                    <button class="btn btn-success" type="button" data-toggle="dropdown" style="border-radius: 0 36px 36px 0;margin-left: -5px;">
                        <span class="fa fa-caret-down"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right" data-id="'.$tag['id'].'" data-type="'.$tag['type'].'">
                        <li><a href="javascript:void(0);" class="dropdown-item" id="updateTagGroup">Edit tag</a></li>
                        <li><a href="javascript:void(0);" class="dropdown-item" id="deleteTag" data-tag_id="'.$tag['id'].'">Delete tag</a></li>
                    </ul>
                </div>
                ';
            }

            $tags[] = [
                'name' => $nameColumn,
                'transactions' => '',
                'actions' => $actionsColumn,
                'type' => $tag['type'],
                'parentIndex' => $tag['parentIndex']
            ];
        }

        $result = [
            'draw' => $post['draw'],
            'recordsTotal' => count($getTags),
            'recordsFiltered' => count($getTags),
            'data' => array_slice($tags, 0, 50)
        ];

        echo json_encode($result);
    }

    public function addTagsGroup(){
        $company_id  = getLoggedCompanyID();
        // echo "<pre>";
        // print_r($this->input->post());
        // exit;
        $new_data = array(
            'name' => $this->input->post('tags_group_name'),
            'company_id' => $company_id,
            'status' => 1,
            'created_at' => date("Y-m-d H:i:s"),
        );

        $tags = $this->tags_model->addtagGroup($new_data);

        $return = [
            'data' => $tags,
            'success' => $tags !== null ? true : false,
            'message' => $tags !== null ? 'Success' : 'Error'
        ];

        echo json_encode($return);
    }

    public function addTags(){
        $company_id  = getLoggedCompanyID();
        $group_id = $this->input->post('group_id');

        $new_data = array(
            'name' => $this->input->post('tag_name'),
            'company_id' => $company_id,
            'status' => 1,
            'created_at' => date("Y-m-d H:i:s"),
        );
        
        if (isset($group_id) && $group_id) $new_data['group_tag_id'] = $group_id;


        $tags = $this->tags_model->add($new_data);

        $return = [
            'data' => $tags,
            'success' => $tags !== null ? true : false,
            'message' => $tags !== null ? 'Success' : 'Error'
        ];

        echo json_encode($return);

    }

    public function deleteGroupTag($id, $type) {
        $result = [];

        $delete = $this->tags_model->delete($id, $type);
        $result['success'] = $delete;
        $result['message'] = $delete ? 'Deleted' : 'Failed';

        echo json_encode($result);
        exit;
    }

    public function updateGroupTag($id, $type) {
        $result = [];
        $name = $this->input->post('name');

        $update = $this->tags_model->update($id, $name, $type);
        $result['success'] = $update;
        $result['message'] = $update ? 'Updated' : 'Failed';

        echo json_encode($result);
        exit;
    }

    //---->

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
        $this->page_data['invoices'] = $this->accounting_invoices_model->getInvoices();
        $this->page_data['page_title'] = "Invoices";
        // print_r($this->page_data);
        $this->load->view('accounting/invoices', $this->page_data);
    }
    public function customers()
    {
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['customers'] = $this->accounting_invoices_model->getCustomers();
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
    public function products_and_services()
    {
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['page_title'] = "Product and Services";
        $this->load->view('accounting/products', $this->page_data);
    }
    public function load_products_services()
    {
        $postData = json_decode(file_get_contents('php://input'), true);
        $order = $postData['order'][0]['dir'];
        $start = $postData['start'];
        $limit = $postData['length'];
        $search = $postData['columns'][0]['search']['value'];
        $data = [];

        if(in_array('0', $postData['category'])) {
            array_unshift($postData['category'], '');
            array_unshift($postData['category'], null);
        }

        $filters = [
            'status' => [
                1
            ],
            'category' => $postData['category']
        ];

        if($postData['status'] === 'inactive') {
            $filters['status'] = [0];
        } else if($postData['status'] === 'all') {
            $filters['status'] = [
                0,
                1
            ];
        }

        if($postData['type'] === 'inventory') {
            $filters['type'] = [
                'product',
                'Product'
            ];
        } else if($postData['type'] === 'non-inventory') {
            $filters['type'] = [
                'material',
                'Material'
            ];
        } else if($postData['type'] === 'service') {
            $filters['type'] = [
                'service',
                'Service'
            ];
        } else if($postData['type'] === 'bundle') {
            $filters['type'] = [
                'bundle',
                'Bundle'
            ];
        }

        $items = $this->items_model->getItemsWithFilter($filters);

        foreach($items as $item) {
            $qty = $this->items_model->countQty($item->id);
            if($search !== "") {
                if(stripos($item->title, $search) !== false) {
                    $data[] = [
                        'id' => $item->id,
                        'name' => $item->title,
                        'sku' => $item->model,
                        'type' => ucfirst($item->type),
                        'sales_desc' => $item->description,
                        'income_account' => '',
                        'expense_account' => '',
                        'inventory_account' => '',
                        'purch_desc' => '',
                        'sales_price' => $item->price,
                        'cost' => $item->cost,
                        'taxable' => '',
                        'qty_on_hand' => $qty,
                        'qty_po' => '',
                        'reorder_point' => $item->re_order_points,
                        'item_categories_id' => $item->item_categories_id
                    ];
                }
            } else {
                $data[] = [
                    'id' => $item->id,
                    'name' => $item->title,
                    'sku' => $item->model,
                    'type' => ucfirst($item->type),
                    'sales_desc' => $item->description,
                    'income_account' => '',
                    'expense_account' => '',
                    'inventory_account' => '',
                    'purch_desc' => '',
                    'sales_price' => $item->price,
                    'cost' => $item->cost,
                    'taxable' => '',
                    'qty_on_hand' => $qty,
                    'qty_po' => '',
                    'reorder_point' => $item->re_order_points,
                    'item_categories_id' => $item->item_categories_id
                ];
            }
        }

        if($postData['stock_status'] !== 'all') {
            $data = array_filter($data, function($item) use ($postData) {
                if($postData['stock_status'] === 'low stock') {
                    return $item['qty_on_hand'] <= 3;
                } else {
                    return $item['qty_on_hand'] === 0;
                }
            });
        }

        $recordsFiltered = count($data);

        if($postData['group_by_category'] === "1") {
            $uncategorized = array_filter($data, function($item) {
                return $item['item_categories_id'] === "0" || $item['item_categories_id'] === null || $item['item_categories_id'] === "";
            });

            $categories = $this->items_model->getItemCategories();

            $categorized = [];
            foreach($categories as $category) {
                $catItems = array_filter($data, function($item) use ($category) {
                    return $item['item_categories_id'] === $category->item_categories_id;
                });

                if(!empty($catItems)) {
                    $categorized[] = [
                        'is_category' => 1,
                        'id' => '',
                        'name' => $category->name,
                        'sku' => '',
                        'type' => '',
                        'sales_desc' => '',
                        'income_account' => '',
                        'expense_account' => '',
                        'inventory_account' => '',
                        'purch_desc' => '',
                        'sales_price' => '',
                        'cost' => '',
                        'taxable' => '',
                        'qty_on_hand' => '',
                        'qty_po' => '',
                        'reorder_point' => '',
                        'item_categories_id' => ''
                    ];
                    foreach($catItems as $value) {
                        $categorized[] = $value;
                    }
                }
            }

            $data = $uncategorized;

            foreach($categorized as $itemWC) {
                $data[] = $itemWC;
            }

            $categoryHeaderCount = count(array_filter($data, function($header) {
                return $header['is_category'] === 1;
            }));

            $recordsFiltered = count($data) - $categoryHeaderCount;
        }

        $result = [
            'draw' => $postData['draw'],
            'recordsTotal' => count($items),
            'recordsFiltered' => $recordsFiltered,
            'data' => array_slice($data, $start, $limit)
        ];

        echo json_encode($result);
    }
    public function product_categories()
    {
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['page_title'] = "Product Categories";
        $this->load->view('accounting/product_categories', $this->page_data);
    }
    public function get_categories()
    {
        $categories = $this->items_model->categoriesWithoutParent();

        $return = [];

        foreach($categories as $category) {
            $return['results'][] = [
                'id' => $category->item_categories_id,
                'text' => $category->name
            ];
        }

        echo json_encode($return);
    }
    public function create_item_category()
    {
        $data = $this->input->post();
        $data['company_id'] = getLoggedCompanyID();

        $create = $this->items_model->insertCategory($data);

        if($create) {
            $this->session->set_flashdata('success', "Category inserted successfully!");
        } else {
            $this->session->set_flashdata('error', "Please try again!");
        }

        redirect("accounting/product-categories");
    }
    public function get_category_details($id)
    {
        $category = $this->items_model->getCategory($id);
        if($category->parent_id !== null && $category->parent_id !== 0 && $category->parent_id !== "") {
            $category->parent = $this->items_model->getCategory($category->parent_id);
        }
        echo json_encode($category);
    }
    public function update_category($id)
    {
        $data = $this->input->post();
        $data['parent_id'] = isset($data['parent_id']) ? $data['parent_id'] : null;

        $update = $this->items_model->updateCategory($id, $data);

        if($update) {
            $this->session->set_flashdata('success', "Category updated successfully!");
        } else {
            $this->session->set_flashdata('error', "Please try again!");
        }

        redirect("accounting/product-categories");
    }
    public function delete_category($id)
    {
        $delete = $this->items_model->deleteCategory($id);

        if($delete) {
            $this->session->set_flashdata('success', "Category deleted successfully!");
        } else {
            $this->session->set_flashdata('error', "Please try again!");
        }
    }
    public function load_product_categories()
    {
        $postData = json_decode(file_get_contents('php://input'), true);
        $order = $postData['order'][0]['dir'];
        $start = $postData['start'];
        $limit = $postData['length'];

        $categories = $this->items_model->getItemCategories($order);

        $data = [];

        foreach($categories as $category) {
            $data[] = [
                'id' => $category->item_categories_id,
                'name' => $category->name
            ];
        }

        $result = [
            'draw' => $postData['draw'],
            'recordsTotal' => count($categories),
            'recordsFiltered' => count($data),
            'data' => array_slice($data, $start, $limit)
        ];

        echo json_encode($result);
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
    public function employees()
    {
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['page_title'] = "Sales Overview";
        $this->page_data['employees'] = $this->users_model->getAll();
        $this->load->view('accounting/employees', $this->page_data);
    }
    public function contractors()
    {
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['page_title'] = "Sales Overview";
        $this->load->view('accounting/contractors', $this->page_data);
    }
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
    
    public function employeeinfo(){
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->load->view('accounting/employeeinfoReport', $this->page_data);
    }
	
	
    /*** Vendors ***/
    public function addVendor()
    {
        $id = logged('id');
        $filePath = "./uploads/accounting/vendors/".$id;
        $file_name = "";

        if (!file_exists($filePath)) {
            mkdir($filePath);
        }
		
		$config['upload_path']  =  $filePath;
        $config['allowed_types']   = 'gif|jpg|png|jpeg|doc|docx|pdf|xlx|xls|csv';
        $config['max_size']        = '20000';

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('attachFiles'))
        {
            $image = $this->upload->data();
            $file_name = $image['file_name'];
        }

        $config = $this->uploadlib->initialize($config);
        $this->load->library('upload',$config);

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
            'business_number' => $this->input->post('business_number'),
            'default_expense_amount' => $this->input->post('default_expense_amount'),
            'notes' => $this->input->post('notes'),
            'attachments' => $file_name,
            'status' => 1,
            'created_by' => logged('id'),
            'date_created' => date("Y-m-d H:i:s"),
            'date_modified' => date("Y-m-d H:i:s")
        );

        $addQuery = $this->vendors_model->createVendor($new_data);

        if($addQuery > 0){

            $new_id = $addQuery;
            $comp = mb_substr($this->input->post('company'), 0, 3);
            $vendor_id = strtolower($comp) . $new_id;
			
            $updateQuery = $this->vendors_model->updateVendor($new_id, array("vendor_id" => $vendor_id));

            if($updateQuery){
                echo json_encode($updateQuery);
            }
        }
        else{
            echo json_encode(0);
        }
    }

    public function deleteVendor(){

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

        $editQuery = $this->vendors_model->update($id,$new_data);

        if($editQuery > 0){
            echo json_encode(1);
        }
        else{
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
            'business_number' => $this->input->post('business_number'),
            'default_expense_amount' => $this->input->post('default_expense_amount'),
            'notes' => $this->input->post('notes'),
            'date_modified' => date("Y-m-d H:i:s")
        );

        $editQuery = $this->vendors_model->updateVendorWithVendorID($id,$new_data);

        if($editQuery){
            echo json_encode(1);
        }
        else{
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

        if ($this->upload->do_upload('attachFiles'))
        {
            $image = $this->upload->data();
            $file_name = $image['file_name'];
        }

        $config = $this->uploadlib->initialize($config);
        $this->load->library('upload',$config);

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

        if($addQuery > 0){
            echo json_encode(1);
        }
        else{
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

        if($addQuery > 0){

            $new_id = $addQuery;
            $term_id = mb_substr($this->input->post('term_name'), 0, 3) . $new_id;
            $updateQuery = $this->terms_model->update($new_id, array("term_id" =>$term_id));

            if($updateQuery > 0){
                echo json_encode($updateQuery);
            }
        }
        else{
            echo json_encode(0);
        }

    }
    /*** Expenses ***/

    public function timeActivity(){
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
        if ($query){
             echo json_encode(1);
        }else{
            echo json_encode(0);
        }
    }

    public function addBill(){
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

    if($query > 0){
           
        $i = 0;
        foreach($a as $row){
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
            foreach($aa as $row2){
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
            
        }
        else{
            echo json_encode(0);
        } 

    }

    public function addBillpay(){
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

       foreach($new_data2 as $datas=>$data){

            $category = $data['username'];
            $description = $data['description'];
            $amount = $data['amount'];
            $status = '1';
            $bill_id = $query;
            $date_created = date("Y-m-d H:i:s");
            $date_modified = date("Y-m-d H:i:s");
        
            $query = $this->expenses_model->addBillcategory($new_data);
     
        }
       

       if ($query == true){
           echo json_encode(1);
       }else{
           echo json_encode(0);
       }

    }

    public function getBillData(){
        $id = $this->input->get('id');
        $transaction_id = $this->input->get('transaction_id');
        $bills = $this->db->get_where('accounting_bill',array('id'=> $id));
        $vendors = $this->db->get_where('accounting_vendors',array('vendor_id' => $bills->row()->vendor_id));
        $check_category = $this->db->get_where('accounting_expense_category',array('expenses_id'=>$id,'transaction_id' => $transaction_id));

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

    public function editBillData(){
        
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
        if($query){
            echo json_encode(1);
        }
        else{
            echo json_encode(0);
        }
    }

    public function deleteBillData(){
        $id = $this->input->post('id');
        $query = $this->expenses_model->deleteBillData($id);

        if($query){
            echo json_encode(1);
        }
        else{
            echo json_encode(0);
        }
    }
    /*** Attachment for Expense Transaction***/
    public function expensesTransactionAttachment(){
        if (! empty($_FILES)){
            $config = array(
                'upload_path' => './uploads/accounting/expenses/',
                'allowed_types' => '*',
                'overwrite' => TRUE,
                'max_size' => '20000',
                'max_height' => '0',
                'max_width' => '0',
                'encrypt_name' => true
            );
            $config = $this->uploadlib->initialize($config);
            $this->load->library('upload',$config);
            if ($this->upload->do_upload("file")){
                $uploadData = $this->upload->data();
                $data = array('attachment'=> $uploadData['file_name']);
                $this->db->insert('accounting_expense_attachment',$data);
                echo json_encode($uploadData['file_name']);
            }
        }
    }

    public function removeTransactionAttachment(){
        $file = $this->input->post('name');
        $index = $this->input->post('index');
        if ($file && file_exists($this->expenses_path. $file[$index])){
            unlink( $this->expenses_path. $file[$index]);
            $this->db->where('attachment',$file[$index]);
            $this->db->delete('accounting_expense_attachment');
        }

    }

    public function displayListAttachment(){
        $id = $this->input->get('id');
        $type = $this->input->get('type');
        $attachments = $this->expenses_model->getAttachment();
        $display = '';
        foreach ($attachments as $attachment){
            $tooltip = ($attachment->status == 0)?"tooltip":"";
            $cross_out = ($attachment->status == 0)?"cross-out":"";
            $exclamation = ($attachment->status == 0)?"fa-times fa-exclamation-triangle":"fa-times";
            $tipbox = ($attachment->status == 0)?"tooltiptext":"tooltiptext hide";
            $file = $attachment->attachment;
            $extension = pathinfo($file, PATHINFO_EXTENSION);
            switch ($extension){
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
            if ($attachment->expenses_id == $id && $attachment->type == $type){
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

    public function removeTemporaryAttachment(){
        $id = $this->input->post('attach_id');
        $status = $this->input->post('status');

        $query = $this->db->get_where('accounting_expense_attachment',array('id'=>$id));
        if ($query->num_rows() == 1 && $status == 1){
            $status = array(
                'status' => 0
            );
            $this->db->where('id',$id);
            $this->db->update('accounting_expense_attachment',$status);
            echo json_encode(0);
        }elseif($query->num_rows() == 1 && $status == 0){
            $status = array(
                'status' => 1
            );
            $this->db->where('id',$id);
            $this->db->update('accounting_expense_attachment',$status);
            echo json_encode(1);
        }
    }
    public function removePermanentlyAttachment(){
        $attachment_id = $this->input->post('attachment_id');
        for ($x = 0; $x < count($attachment_id);$x++){
            $get_filename = $this->db->get_where('accounting_expense_attachment',array('id'=>$attachment_id[$x]));
            unlink( $this->expenses_path. $get_filename->row()->attachment);
            $this->db->where('id',$attachment_id[$x]);
            $this->db->delete('accounting_expense_attachment');
        }

    }

    public function addingFileAttachment(){
        $transaction_id = $this->input->post('transaction_id');
        $transaction_from_id = $this->input->post('trans_from_id');
        $file_id = $this->input->post('file_id');
        $id = $this->input->post('expenses_id');
        $type = $this->input->post('type');
        $get_attachment_id = $this->db->get_where('accounting_expense_attachment',array('id'=>$file_id));
        $file_name = $get_attachment_id->row()->attachment;
        $original_fname = $this->input->post('original_fname');
        $extension = pathinfo($file_name, PATHINFO_EXTENSION);
        $encryption = md5(time()).'.'.$extension;
        copy('./uploads/accounting/expenses/'.$file_name,'./uploads/accounting/expenses/'.$encryption);
        $data = array(
            'transaction_id' => $transaction_id,
            'expenses_id' => $id,
            'type' => $type,
            'original_filename' => $original_fname,
            'attachment' => $encryption,
            'date_created' => date('Y-m-d H:i:s'),
            'status' => 1
        );
        $this->db->insert('accounting_expense_attachment',$data);
        $new_attachment_id = $this->db->insert_id();

        $added = array(
            'attachment_id' => $new_attachment_id,
            'attachment_from_id' => $get_attachment_id->row()->id,
            'trans_from_id' => $transaction_from_id,
            'expenses_type' => $type,
            'expenses_id' => $id,
            'date_created' => date('Y-m-d H:i:s')
        );
        $this->db->insert('accounting_existing_attachment',$added);
        echo json_encode($id);
    }

    public function deleteTemporaryAttachment(){
        $attachments = $this->expenses_model->getAttachment();
        $result = null;
        foreach ($attachments as $attachment){
            if ($attachment->transaction_id == 0){
                unlink( $this->expenses_path.$attachment->attachment);
            }
        }
        $this->db->where('transaction_id',0);
        $this->db->delete('accounting_expense_attachment');
        echo json_encode($result);
    }

    public function showExistingFile(){
        $expense_id = $this->input->get('expenses_id');
        $type = $this->input->get('type');
        $transaction_id = $this->input->get('transaction_id');
        $attachments = $this->expenses_model->getAttachmentById($transaction_id);
        $disabled = null;
        $display = '';
        foreach ($attachments as $attachment){
                $added = $this->expenses_model->getAddedAttachment($attachment->id,$expense_id,$type);
                if ($added == true){
                    $status = 'Added';
                    $disabled = 'isDisabled';
                }else{
                    $status = 'Add';
                    $disabled = null;
                }


                $preview = "";
                if($type == 'Check'){
                    $preview = "-check";
                }elseif ($type == 'Bill'){
                    $preview = "-bill";
                }elseif ($type == 'Expense'){
                    $preview = "-expense";
                }elseif ($type == 'Vendor Credit'){
                    $preview = "-vc";
                }
                $file = $attachment->attachment;
                $extension = pathinfo($file, PATHINFO_EXTENSION);
                switch ($extension){
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

    public function rowCategories(){
        $transaction_id = $this->input->get('transaction_id');
        $row = $this->input->get('row');
        $cat_class = $this->input->get('cat_class');
        $des_class = $this->input->get('des_class');
        $amount_class = $this->input->get('amount_class');
        $counter = $this->input->get('counter');
        $remove = $this->input->get('remove_id');
        $select = $this->input->get('select');
        $preview = $this->input->get('preview');
        $get_categories = $this->db->get_where('accounting_expense_category',array('transaction_id' => $transaction_id));
        $result = $get_categories->result();
        $categories = '';
        $category_list = $this->categories_model->getCategories();
        if ($get_categories->num_rows() >= 2){
            foreach ($result as $cnt => $data){
                $category = ($data->category_id != null)?$data->category_id:"";
                $description = ($data->description != null)?$data->description:"";
                $amount = ($data->amount!=null)?$data->amount:0;
                $cnt += 1;
                $categories .= '<tr id="'.$row.'">';
                $categories .= '<td></td>';
                $categories .= '<td><span id="'.$counter.'">'. $cnt .'</span></td>';
                $categories .= '<td>';
                foreach ($category_list as $list){
                    if ($list->id == $category){
                        $categories .= '<input type="hidden" name="categories_id[]" class="categories_id" value="'.$data->id.'">';
                        $categories .= '<span id="category-preview'.$preview.'">'.$list->category_name.'</span>';
                    }
                }
                $categories .= '<div id="" style="display:none;">';
                $categories .= '<input type="hidden" id="prevent_process" value="true">';
                $categories .= '<select name="category[]" id="category-id'.$preview.'" class="form-control '.$cat_class.' '.$select.'">';
                $categories .= '<option></option>';
                $categories .= '<option value="0" id="add-expense-categories" disabled>&plus; Add Category</option>';
                foreach ($category_list as $list){
                    if ($list->id == $category){
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
        }else{
            foreach ($result as $cnt => $data){
                $category = ($data->category_id != null)?$data->category_id:"";
                $description = ($data->description != null)?$data->description:"";
                $amount = ($data->amount!=null)?$data->amount:0;
                $cnt += 1;
                $categories .= '<tr id="'.$row.'">';
                $categories .= '<td></td>';
                $categories .= '<td><span id="'.$counter.'">'. $cnt .'</span></td>';
                $categories .= '<td>';
                foreach ($category_list as $list){
                    if ($list->id == $category){
                        $categories .= '<input type="hidden" name="categories_id[]" class="categories_id" value="'.$data->id.'">';
                        $categories .= '<span id="category-preview'.$preview.'">'.$list->category_name.'</span>';
                    }
                }
                $categories .= '<div id="" style="display:none;">';
                $categories .= '<input type="hidden" id="prevent_process" value="true">';
                $categories .= '<select name="category[]" id="category-id'.$preview.'" class="form-control '.$cat_class.' '.$select.'">';
                $categories .= '<option></option>';
                $categories .= '<option value="0" id="add-expense-categories" disabled>&plus; Add Category</option>';
                foreach ($category_list as $list){
                    if ($list->id == $category){
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

    public function defaultCategoryRow(){
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
        for ($x = 1;$x <= 2;$x++){
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

    public function getCheckData(){
        $id = $this->input->get('id');
        $transaction_id = $this->input->get('transaction_id');
        $query = $this->db->get_where('accounting_check',array(
            'id' => $id
        ));
        $vendors_detail = $this->db->get_where('accounting_vendors',array('vendor_id'=>$query->row()->vendor_id));
        $check_category = $this->db->get_where('accounting_expense_category',array('expenses_id'=>$id,'transaction_id'=>$transaction_id));
        if ($query->row()->print_later == 1){
            $print = true;
        }else{
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

    public function editCheckData(){
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
        if ($query == true){
            echo json_encode(1);
        }else{
            echo json_encode(0);
        }
    }
    public function deleteCheckData(){

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
    public function getExpenseData(){
        $id = $this->input->get('id');
        $transaction_id = $this->input->get('transaction_id');
        $get_expense = $this->db->get_where('accounting_expense',array('id'=>$id));
        $vendors = $this->db->get_where('accounting_vendors',array('vendor_id'=> $get_expense->row()->vendor_id));
        $check_category = $this->db->get_where('accounting_expense_category',array('expenses_id'=>$id,'transaction_id' => $transaction_id));


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

    public function updateExpenseData(){
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
        if ($query == true){
            echo json_encode(1);
        }else{
            echo json_encode(0);
        }
    }

    public function deleteExpenseData(){
        $id = $this->input->post('id');
        $this->expenses_model->deleteExpenseData($id);
    }

    public function vendorCredit(){
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
        if ($query == true){
            echo json_encode(1);
        }else{
            echo json_encode(0);
        }
    }
    public function getVendorCredit(){
        $id = $this->input->get('id');
        $transaction_id = $this->input->get('transaction_id');
        $get_vc = $this->db->get_where('accounting_vendor_credit',array('id'=>$id));
        $vendors = $this->db->get_where('accounting_vendors',array('vendor_id'=> $get_vc->row()->vendor_id));
        $check_category = $this->db->get_where('accounting_expense_category',array('expenses_id'=>$id,'transaction_id'=>$transaction_id));

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
    public function updateVendorCredit(){
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
        if ($query == true){
            echo json_encode(1);
        }else{
            echo json_encode(0);
        }
    }

    public function deleteVendorCredit(){
        $id = $this->input->post('id');
        $this->expenses_model->deleteVendorCredit($id);
    }

    public function showExpenseTransactionsTable(){
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
            if ($transaction->type == 'Check'){
                // Check
                foreach ($checks as $check){
                    if ($transaction->id == $check->transaction_id){
                        $date = date("m/d/y",strtotime($transaction->date_created));
                        $type = $transaction->type;
                        $number = $check->check_number;
                        $modal_id = "editCheck";
                        $data_id = $check->id;
                        $transaction_id = $check->transaction_id;
                        foreach ($vendors as $vendor){
                            if ($vendor->vendor_id == $check->vendor_id){
                                $vendors_name = $vendor->f_name." ".$vendor->l_name;
                                $delete = 'deleteCheck';
                            }
                        }
                        $get_category = $this->db->get_where('accounting_expense_category',array('transaction_id' => $check->transaction_id));
                        $check_category_id = ($get_category->num_rows() != 0)?$get_category->row()->category_id:0;
                        foreach ($list_categories as $list){
                            if ($list->id == $check_category_id){
                                $category_list_id = $list->id;
                                $category = $list->category_name;
                                $category_id = $get_category->row()->id;
                            }
                        }

                    }
                }
            }elseif ($transaction->type == 'Bill'){
//                                            Bill
                foreach ($bills as $bill){
                    if ($transaction->id == $bill->transaction_id){
                        $date = date("m/d/y",strtotime($transaction->date_created));
                        $type = $transaction->type;
                        $number = null;
                        $modal_id = "editBill";
                        $transaction_id = $bill->transaction_id;
                        foreach ($vendors as $vendor){
                            if ($vendor->vendor_id == $bill->vendor_id){
                                $vendors_name = $vendor->f_name." ".$vendor->l_name;
                                $data_id = $bill->id;
                                $delete = 'deleteBill';
                            }
                        }
                        $get_category = $this->db->get_where('accounting_expense_category',array('transaction_id' => $bill->transaction_id));
                        $bill_category_id = ($get_category->num_rows() != 0)?$get_category->row()->category_id:0;
                        foreach ($list_categories as $list){
                            if ($list->id == $bill_category_id){
                                $category_list_id = $list->id;
                                $category = $list->category_name;
                                $category_id = $get_category->row()->id;
                            }
                        }

                    }
                }
            }elseif ($transaction->type == 'Expense'){
//                                            Expense
                foreach ($expenses as $expense){
                    if ($transaction->id == $expense->transaction_id){
                        $date = date("m/d/y",strtotime($transaction->date_created));
                        $type = $transaction->type;
                        $number = null;
                        $modal_id = "editExpense";
                        $transaction_id = $expense->transaction_id;
                        foreach ($vendors as $vendor){
                            if ($vendor->vendor_id == $expense->vendor_id){
                                $vendors_name = $vendor->f_name." ".$vendor->l_name;
                                $data_id = $expense->id;
                                $delete = 'deleteExpense';
                            }
                        }
                        $get_category = $this->db->get_where('accounting_expense_category',array('transaction_id' => $expense->transaction_id));
                        $expense_category_id = ($get_category->num_rows() != 0)?$get_category->row()->category_id:0;
                        foreach ($list_categories as $list){
                            if ($list->id == $expense_category_id){
                                $category_list_id = $list->id;
                                $category = $list->category_name;
                                $category_id = $get_category->row()->id;
                            }
                        }


                    }
                }
            }elseif ($transaction->type == 'Vendor Credit'){
//                                            Vendor Credit
                foreach ($vendor_credits as $vendor_credit){
                    if ($transaction->id == $vendor_credit->transaction_id){
                        $date = date("m/d/y",strtotime($transaction->date_created));
                        $type = $transaction->type;
                        $payee = $vendor_credit->vendor_id;
                        $number = null;
                        $modal_id = "editVendorCredit";
                        $transaction_id = $vendor_credit->transaction_id;
                        foreach ($vendors as $vendor){
                            if ($vendor->vendor_id == $vendor_credit->vendor_id){
                                $vendors_name = $vendor->f_name." ".$vendor->l_name;
                                $data_id = $vendor_credit->id;
                                $delete = 'deleteVendorCredit';
                            }
                        }
                        $get_category = $this->db->get_where('accounting_expense_category',array('transaction_id' => $vendor_credit->transaction_id));
                        $vc_category_id = ($get_category->num_rows() != 0)?$get_category->row()->category_id:0;
                        foreach ($list_categories as $list){
                            if ($list->id == $vc_category_id){
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
    public function getExpensesCategories(){
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
        if ($categories_by_id != null){
            foreach ($query as $categories){
                foreach ($categories_by_id as $category_by_id){
                    if ($categories->id == $category_by_id->category_id){
                        $data[] = array(
                            'id' => $categories->id,
                            'text' => $categories->category_name,
                            'subtext' => $categories->type,
                            'selected' => true
                        );
                    }
                }
            }
            foreach ($query as $categories){
                foreach ($categories_by_id as $category_by_id){
                    if ($categories->id != $category_by_id->category_id){
                        $data[] = array(
                            'id' => $categories->id,
                            'text' => $categories->category_name,
                            'subtext' => $categories->type
                        );
                    }
                }
            }
        }else{
            foreach ($get_by_search as $categories){
                $data[] = array(
                    'id' => $categories->id,
                    'text' => $categories->category_name,
                    'subtext' => $categories->type
                );
            }
        }

        echo json_encode($data);
    }
    public function addCategories(){
        $new_data = array(
            'account_type' => $this->input->post('account_type'),
            'detail_type' => $this->input->post('detail_type'),
            'name' => $this->input->post('name'),
            'description' => $this->input->post('description'),
            'sub_account' => $this->input->post('sub_account'),
        );
        $query = $this->expenses_model->addCategories($new_data);
        if ($query == true){
            echo json_encode(1);
        }else{
            echo json_encode(0);
        }
    }
    public function updateCategoryById(){
        $id = $this->input->post('id');
        $category = $this->input->post('category');
        $expenses_id = $this->input->post('expenses_id');
        $transaction_id = $this->input->post('transaction_id');
        if ($id == null){
            $new_category = array(
                'transaction_id'=> $transaction_id,
                'expenses_id' => $expenses_id,
                'category_id' => $category
            );
            $this->db->insert('accounting_expense_category',$new_category);
        }else{
            $data = array(
                'category_id' => $category
            );
            $this->db->where('id',$id);
            $this->db->update('accounting_expense_category',$data);
        }

        echo json_encode(1);
    }

    public function payDown(){
        $new_data = array(
            'credit_card_id' => $this->input->post('credit_card_id'),
            'amount' => $this->input->post('amount'),
            'date_payment' => $this->input->post('date_payment'),
            'payment_account' => $this->input->post('payment_account'),
            'check_number' => $this->input->post('check_num'),
        );
        $query = $this->expenses_model->payDown($new_data);
        if ($query == true){
            redirect('accounting/expenses');
        }else{
            redirect('accounting/expenses');
        }
    }

    /***Rules***/
    public function edit_rules(){
        $id = $this->input->get('id');
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['rules'] = $this->rules_model->getRulesById($id);
        $this->page_data['conditions'] = $this->rules_model->getConditionById($id);
        $this->page_data['categories'] = $this->rules_model->getCategoryById($id);
        $this->load->view('accounting/rules/edit-rules', $this->page_data);
    }

    public function addRules(){
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
        if ($rules_id != null){
            //Condition insertion
            $description = $this->input->post('description');
            $contain = $this->input->post('contain');
            $comment = $this->input->post('comment');
            $this->rules_model->addConditions($description,$contain,$comment,$rules_id);
            //Category Insertion
            $category = $this->input->post('category');
            $percentage = $this->input->post('percentage');
            $this->rules_model->addCategory($category,$percentage,$rules_id);

            $this->session->set_flashdata('rules_added','New rules added');
            redirect('accounting/rules');
        }else{
            $this->session->set_flashdata('rules_failed','Rules name already exist.');
            redirect('accounting/rules');
        }

    }

    public function editRules(){
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

        $rules_id = $this->rules_model->editRules($update,$con_id,$description,$contain,$comment,$cat_id,$category,$percentage);
        if ($rules_id == true){
            $this->session->set_flashdata('updated_rules','Rules has been updated.');
            redirect('accounting/rules');
        }else{
            $this->session->set_flashdata('update_rules_failed','Something is wrong in the process.');
            redirect('accounting/rules');
        }
    }

    public function deleteRulesData(){
        $id = $this->input->post('id');
        $this->rules_model->deleteRulesData($id);
        $rules = $this->rules_model->getRules();
        $output = '';
        foreach ($rules as $rule){
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
    public function uploadReceiptImage(){
        if (! empty($_FILES)){
            $config = array(
                'upload_path' => './uploads/accounting/',
                'allowed_types' => 'gif|jpg|png|jpeg',
                'overwrite' => TRUE,
                'max_size' => '5000',
                'max_height' => '0',
                'max_width' => '0',
                'encrypt_name' => true
            );
            $config = $this->uploadlib->initialize($config);
            $this->load->library('upload',$config);
            if ($this->upload->do_upload("file")){
                $uploadData = $this->upload->data();
                $data2 = array('receipt_img' => $uploadData['file_name']);
                $this->db->insert('accounting_receipts',$data2);
                echo json_encode($uploadData['file_name']);
            }else{
                echo $this->upload->display_errors();;
            }

        }
    }

    public function removeReceiptImage(){
        $file = $this->input->post('file');
        if ($file && file_exists($this->upload_path. $file)){
            unlink( $this->upload_path. $file);
            $this->db->where('receipt_img',$file);
            $this->db->delete('accounting_receipts');
        }else{
            echo $this->upload->display_errors();
        }
    }

    public function getReceiptData(){
        if (isset($_POST['id'])){
            $query = $this->db->get_where('accounting_receipts',array('id'=>$_POST['id']));

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

    public function updateReceipt(){
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
        if ($update == true){
            $this->session->set_flashdata('receipt_updated','Receipt updated.');
            redirect('accounting/receipts');
        }else{
            $this->session->set_flashdata('receipt_updateFailed','Something is wrong in the process.');
            redirect('accounting/receipts');
        }
    }

    public function deleteReceiptData(){
        $id = $this->input->post('id');
        $this->receipt_model->deleteReceiptData($id);
    }

    /*chart_of_accounts start*/
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

        foreach($accounts as $account) {
            if($search !== "") {
                if(stripos($account->name, $search) !== false) {
                    $data[] = [
                        'id' => $account->id,
                        'name' => $account->name,
                        'type' => $this->account_model->getName($account->account_id),
                        'detail_type' => $this->account_detail_model->getName($account->acc_detail_id),
                        'nsmartrac_balance' => $account->balance,
                        'bank_balance' => '',
                        'status' => $account->active
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
                    'status' => $account->active
                ];
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

    public function make_account_active($id)
    {
        $active =  $this->chart_of_accounts_model->makeActive($id);

        echo json_encode([
            'success' => $active ? true : false,
            'message' => $active ? 'Success' : 'Error'
        ]);
    }

    public function add()
    {
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->load->view('accounting/chart_of_accounts/add', $this->page_data);
    }

    public function addChartofaccounts()
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

        if($account > 0) {
            $this->session->set_flashdata('success', "Data inserted successfully!");
        } else {
            $this->session->set_flashdata('error', "Please try again!");
        }

        redirect("accounting/chart_of_accounts");
    }

    public function edit($id)
    {
        $this->page_data['alert'] = 'accounting/alert_promt';
        $this->page_data['chart_of_accounts'] = $this->chart_of_accounts_model->getById($id);
        echo $this->load->view('accounting/chart_of_accounts/edit-new', $this->page_data, true);
        exit;
    }

    public function update()
    {
        $data = [
            'id' => $this->input->post('id'),
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

        if($accountUpdate) {
            $this->session->set_flashdata('success', "Data updated successfully!");
        } else {
            $this->session->set_flashdata('error', "Please try again!");
        }
        redirect("accounting/chart_of_accounts");
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

    public function lists()
    {
        $this->load->view('accounting/list', $this->page_data);
    }

    public function update_name()
    {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $this->chart_of_accounts_model->update_name($id,$name);
    }

    public function inactive()
    {
        $id = $this->input->post('id');
        $inactive = $this->chart_of_accounts_model->inactive($id);

        echo json_encode([
            'success' => $inactive ? true : false,
            'message' => $inactive ? 'Success' : 'Error'
        ]);
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

    public function refresh()
    {
        $html = "";
        $i=1;
        foreach($this->chart_of_accounts_model->select() as $row)
        {
            $html .="<tr>
                        <td>
                            <input type='checkbox'></td><td class='edit_field' data-id='".$row->id."'>".$row->name."
                        </td>
                        <td class='type'>".$this->account_model->getName($row->account_id)."</td>
                        <td class='detailtype'>".$this->account_detail_model->getName($row->acc_detail_id)."</td>
                        <td class='nbalance'>".$row->balance."</td>
                        <td class='balance'></td>
                        <td>
                            <div class='dropdown show'><a class='dropdown-toggle' href='#' id='dropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>View Register</a>
                                <div class='dropdown-menu' aria-labelledby='dropdownMenuLink'>
                                    <a class='dropdown-item' href='javascript:void(0);' data-href=".url('/accounting/chart_of_accounts/edit/'.$row->id)." id='editAccount' data-id='$row->id'>Edit</a>
                                    <a class='dropdown-item' href='#' onClick='make_inactive(".$row->id.")'>Make Inactive (Reduce usage)</a>
                                    <a class='dropdown-item' href='#'>Run Report</a>
                                </div>
                            </div>
                        </td>
                    </tr>";
            $i++;
        }
        echo $html;
    }
	
	public function addInvoice()
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
        if($addQuery > 0){
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
        foreach($a as $row){
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
            
        }
        else{
            echo json_encode(0);
        }
    }

    public function getCustomersAcc(){
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

        if($addQuery){
            echo json_encode(1);
        }
        else{
            echo json_encode(0);
        }
    }
	public function deleteInvoice(){
        $id = $this->input->post('id');
        $query = $this->accounting_invoices_model->deleteInvoice($id);

        if($query){
            echo json_encode(1);
        }
        else{
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

        if($addQuery > 0){
            // echo json_encode($addQuery);
            redirect('accounting/banking');
        }
        else{
            echo json_encode(0);
        }
    }

    public function savepaymethod(){

        $company_id  = getLoggedCompanyID();
        $user_id  = getLoggedUserID();
        $new_data = array(
            'payment_method' => $this->input->post('new_pay_method'),
            'quick_name' => $this->input->post('new_pay_method'),
            'user_id' => $user_id,
            'company_id' => $company_id,
        );

        $addQuery = $this->accounting_receive_payment_model->savepaymentmethod($new_data);

        if($addQuery > 0){
            echo json_encode($addQuery);
            //$this->session->set_flashdata('Method added');
        }
        else{
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

        if($updateQuery){
            echo json_encode(1);
        }
        else{
            echo json_encode(0);
        }
    }
	public function deleteReceivePayment(){
        $id = $this->input->post('id');
        $query = $this->accounting_receive_payment_model->deleteReceivePayment($id);

        if($query){
            echo json_encode(1);
        }
        else{
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
        if($addQuery > 0){
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
            foreach($a as $row){
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
        }
        else{
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
            'user_id' => $user_id,
            'company_id' => $company_id,
            // 'created_by' => logged('id'),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        );

        $addQuery = $this->estimate_model->save_estimate($new_data);
        if($addQuery > 0){
            $new_data2 = array(
                'item_type' => $this->input->post('type'),
                'description' => $this->input->post('desc'),
                'qty' => $this->input->post('qty'),
                'location' => $this->input->post('location'),
                'cost' => $this->input->post('cost'),
                'discount' => $this->input->post('discount'),
                'tax' => $this->input->post('tax'),
                'type' => '1',
                'type_id' => $addQuery,
                'status' => '1',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            );
            $a = $this->input->post('items');
            $b = $this->input->post('desc');
            $c = $this->input->post('quantity');
            $d = $this->input->post('location');
            $e = $this->input->post('price');
            $f = $this->input->post('discount');
            $g = $this->input->post('span_tax_0');
            $h = $this->input->post('item_type');

            $i = 0;
            foreach($a as $row){
                $data['item'] = $a[$i];
                $data['item_type'] = $h[$i];
                $data['description'] = $b[$i];
                $data['qty'] = $c[$i];
                $data['location'] = $d[$i];
                $data['cost'] = $e[$i];
                $data['discount'] = $f[$i];
                $data['tax'] = $g[$i];
                $data['type'] = 'Standard Estimate';
                $data['type_id'] = $addQuery;
                $data['status'] = '1';
                $data['created_at'] = date("Y-m-d H:i:s");
                $data['updated_at'] = date("Y-m-d H:i:s");
                $addQuery2 = $this->accounting_invoices_model->additem_details($data);
                $i++;
            }
    
           redirect('accounting/newEstimateList');
        }
        else{
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
            'user_id' => $user_id,
            'company_id' => $company_id,
            // 'created_by' => logged('id'),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        );

        $addQuery = $this->estimate_model->save_estimate($new_data);
        if($addQuery > 0){
            $new_data2 = array(
                'item_type' => $this->input->post('type'),
                'description' => $this->input->post('desc'),
                'qty' => $this->input->post('qty'),
                'location' => $this->input->post('location'),
                'cost' => $this->input->post('cost'),
                'discount' => $this->input->post('discount'),
                'tax' => $this->input->post('tax'),
                'type' => '1',
                'type_id' => $addQuery,
                'status' => '1',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            );
            $a = $this->input->post('type');
            $b = $this->input->post('desc');
            $c = $this->input->post('qty');
            $d = $this->input->post('location');
            $e = $this->input->post('cost');
            $f = $this->input->post('discount');
            $g = $this->input->post('tax');

            $i = 0;
            foreach($a as $row){
                $data['item_type'] = $a[$i];
                $data['description'] = $b[$i];
                $data['qty'] = $c[$i];
                $data['location'] = $d[$i];
                $data['cost'] = $e[$i];
                $data['discount'] = $f[$i];
                $data['tax'] = $g[$i];
                $data['type'] = 'Options Estimate';
                $data['type_id'] = $addQuery;
                $data['status'] = '1';
                $data['created_at'] = date("Y-m-d H:i:s");
                $data['updated_at'] = date("Y-m-d H:i:s");
                $addQuery2 = $this->accounting_invoices_model->createInvoiceProd($data);
                $i++;
            }
    
            redirect('accounting/newEstimateList');
        }
        else{
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
            'user_id' => $user_id,
            'company_id' => $company_id,
            // 'created_by' => logged('id'),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        );

        $addQuery = $this->estimate_model->save_estimate($new_data);
        if($addQuery > 0){
            $new_data2 = array(
                'item_type' => $this->input->post('type'),
                'description' => $this->input->post('desc'),
                'qty' => $this->input->post('qty'),
                'location' => $this->input->post('location'),
                'cost' => $this->input->post('cost'),
                'discount' => $this->input->post('discount'),
                'tax' => $this->input->post('tax'),
                'type' => '1',
                'type_id' => $addQuery,
                'status' => '1',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            );
            $a = $this->input->post('type');
            $b = $this->input->post('desc');
            $c = $this->input->post('qty');
            $d = $this->input->post('location');
            $e = $this->input->post('cost');
            $f = $this->input->post('discount');
            $g = $this->input->post('tax');

            $i = 0;
            foreach($a as $row){
                $data['item_type'] = $a[$i];
                $data['description'] = $b[$i];
                $data['qty'] = $c[$i];
                $data['location'] = $d[$i];
                $data['cost'] = $e[$i];
                $data['discount'] = $f[$i];
                $data['tax'] = $g[$i];
                $data['type'] = 'Bundle Estimate';
                $data['type_id'] = $addQuery;
                $data['status'] = '1';
                $data['created_at'] = date("Y-m-d H:i:s");
                $data['updated_at'] = date("Y-m-d H:i:s");
                $addQuery2 = $this->accounting_invoices_model->createInvoiceProd($data);
                $i++;
            }
    
            redirect('accounting/newEstimateList');
        }
        else{
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
            'amount' => $this->input->post('total_amount'),
            'payment_method' => $this->input->post('payment_method'),
            'ref_number' => $this->input->post('ref_number'),
            'deposit_to' => $this->input->post('deposit_to'),
            'message' => $this->input->post('message'),
            'message_on_statement' => $this->input->post('message_on_statement'),
            // 'attachments' => $this->input->post('file_name'),
            'attachments' => 'testing',
            'shipping' => $this->input->post('shipping'),
            'status' => 1,
            'created_by' => logged('id'),
            'date_created' => date("Y-m-d H:i:s"),
            'date_modified' => date("Y-m-d H:i:s")
        );

        $addQuery = $this->accounting_sales_receipt_model->createSalesReceipts($new_data);

        // if($addQuery > 0){
        //     echo json_encode($addQuery);
        // }
        if($addQuery > 0){
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
            foreach($a as $row){
                $data['product_services'] = $a[$i];
                $data['description'] = $b[$i];
                $data['qty'] = $c[$i];
                $data['rate'] = $d[$i];
                $data['amount'] = $e[$i];
                $data['tax'] = $f[$i];
                $data['type'] = '4';
                $data['type_id'] = $addQuery;
                $data['status'] = '1';
                $data['created_at'] = date("Y-m-d H:i:s");
                $data['updated_at'] = date("Y-m-d H:i:s");
                $addQuery2 = $this->accounting_invoices_model->createInvoiceProd($data);
                $i++;
            }
        
            redirect('accounting/banking');
        }
        else{
            echo json_encode(0);
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

        if($updateQuery > 0){
            echo json_encode($updateQuery);
        }
        else{
            echo json_encode(0);
        }
    }
	
	public function deleteSalesReceipt(){
        $id = $this->input->post('id');
        $query = $this->accounting_sales_receipt_model->deleteSalesReceipt($id);

        if($query){
            echo json_encode(1);
        }
        else{
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
            'total_amount' => $this->input->post('total_amount'),
            'message_refund' => $this->input->post('message_refund'),
            'message_statement' => $this->input->post('mess_statement'),
            'tax_rate' => $this->input->post('tax_rate'),
            'shipping' => $this->input->post('shipping'),
            // 'attachments' => $this->input->post('file_name'),
            'attachments' => 'testing 2',
            'status' => 1,
            'user_id' => $user_id,
            'company_id' => $company_id,
            'created_by' => logged('id'),
            'date_created' => date("Y-m-d H:i:s"),
            'date_modified' => date("Y-m-d H:i:s")
        );

        $addQuery = $this->accounting_refund_receipt_model->createRefundReceipts($new_data);

        if($addQuery > 0){
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
            foreach($a as $row){
                $data['product_services'] = $a[$i];
                $data['description'] = $b[$i];
                $data['qty'] = $c[$i];
                $data['rate'] = $d[$i];
                $data['amount'] = $e[$i];
                $data['tax'] = $f[$i];
                $data['type'] = '5';
                $data['type_id'] = $addQuery;
                $data['status'] = '1';
                $data['created_at'] = date("Y-m-d H:i:s");
                $data['updated_at'] = date("Y-m-d H:i:s");
                $addQuery2 = $this->accounting_invoices_model->createInvoiceProd($data);
                $i++;
            }
        
            redirect('accounting/banking');
        }
        else{
            echo json_encode(0);
        }
    }

    public function addDelayedCredit(){
        $company_id  = getLoggedCompanyID();
        $user_id  = getLoggedUserID();

        $product = json_encode($this->input->post('product'));


        $new_data = array(
            'customer_id' => $this->input->post('customer_id'),
            'delayed_credit_date' => $this->input->post('delayed_credit_date'),
            // 'products' => 'testing',
            'tags' => $this->input->post('tags'),
            'total_amount' => $this->input->post('total_amount'),
            'sub_total' => $this->input->post('sub_total'),
            'memo' => $this->input->post('memo'),
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
        if($addQuery > 0){
            //echo json_encode($addQuery);
            $new_data2 = array(
                'product_services' => $this->input->post('prod'),
                'description' => $this->input->post('desc'),
                'qty' => $this->input->post('qty'),
                'rate' => $this->input->post('rate'),
                'amount' => $this->input->post('amount'),
                'tax' => $this->input->post('tax'),
                'type' => '6',
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
            foreach($a as $row){
                $data['product_services'] = $a[$i];
                $data['description'] = $b[$i];
                $data['qty'] = $c[$i];
                $data['rate'] = $d[$i];
                $data['amount'] = $e[$i];
                $data['tax'] = $f[$i];
                $data['type'] = '6';
                $data['type_id'] = $addQuery;
                $data['status'] = '1';
                $data['created_at'] = date("Y-m-d H:i:s");
                $data['updated_at'] = date("Y-m-d H:i:s");
                $addQuery2 = $this->accounting_invoices_model->createInvoiceProd($data);
                $i++;
            }
        
            redirect('accounting/banking');
        }
        else{
            echo json_encode(0);
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
            // 'products' => $product,
            'products' => 'testing',
            'message_credit_memo' => $this->input->post('message_displayed_on_credit_memo'),
            'message_on_statement' => $this->input->post('message_on_statement'),
            'attachments' => 'testing',
            'status' => 1,
            'user_id' => $user_id,
            'company_id' => $company_id,
            'created_by' => logged('id'),
            'date_created' => date("Y-m-d H:i:s"),
            'date_modified' => date("Y-m-d H:i:s")
        );

        $addQuery = $this->accounting_credit_memo_model->createCreditMemo($new_data);

        // if($addQuery > 0){
        //     redirect('accounting/banking');
        //     // echo json_encode($addQuery);
        // }
        if($addQuery > 0){
            //echo json_encode($addQuery);
            $new_data2 = array(
                'product_services' => $this->input->post('prod'),
                'description' => $this->input->post('desc'),
                'qty' => $this->input->post('qty'),
                'rate' => $this->input->post('rate'),
                'amount' => $this->input->post('amount'),
                'tax' => $this->input->post('tax'),
                'type' => '3',
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
            foreach($a as $row){
                $data['product_services'] = $a[$i];
                $data['description'] = $b[$i];
                $data['qty'] = $c[$i];
                $data['rate'] = $d[$i];
                $data['amount'] = $e[$i];
                $data['tax'] = $f[$i];
                $data['type'] = '3';
                $data['type_id'] = $addQuery;
                $data['status'] = '1';
                $data['created_at'] = date("Y-m-d H:i:s");
                $data['updated_at'] = date("Y-m-d H:i:s");
                $addQuery2 = $this->accounting_invoices_model->createInvoiceProd($data);
                $i++;
            }
        
            redirect('accounting/banking');
        }
        else{
            echo json_encode(0);
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

        if($updateQuery > 0){
            echo json_encode($updateQuery);
        }
        else{
            echo json_encode(0);
        }
    }
	
	public function deleteCreditMemo(){
        $id = $this->input->post('id');
        $query = $this->accounting_credit_memo_model->deleteCreditMemo($id);

        if($query){
            echo json_encode(1);
        }
        else{
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
            // 'products' => $product,
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
        if($addQuery > 0){
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
            foreach($a as $row){
                $data['product_services'] = $a[$i];
                $data['description'] = $b[$i];
                $data['qty'] = $c[$i];
                $data['rate'] = $d[$i];
                $data['amount'] = $e[$i];
                $data['tax'] = $f[$i];
                $data['type'] = '7';
                $data['type_id'] = $addQuery;
                $data['status'] = '1';
                $data['created_at'] = date("Y-m-d H:i:s");
                $data['updated_at'] = date("Y-m-d H:i:s");
                $addQuery2 = $this->accounting_invoices_model->createInvoiceProd($data);
                $i++;
            }
        
            redirect('accounting/banking');
        }
        else{
            echo json_encode(0);
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

        if($addQuery > 0){
            echo json_encode($addQuery);
        }
        else{
            echo json_encode(0);
        }
    }
	
	public function deleteDelayedCharge(){
        $id = $this->input->post('id');
        $query = $this->accounting_delayed_charge_model->deleteDelayedCharge($id);

        if($query){
            echo json_encode(1);
        }
        else{
            echo json_encode(0);
        }
    }
	
	public function addSalesTimeActivity(){
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
        if ($query){
             echo json_encode(1);
        }else{
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
        if ($query){
             echo json_encode(1);
        }else{
            echo json_encode(0);
        }
    }
	
	public function deleteSalesTimeActivity(){
        $id = $this->input->post('id');
        $query = $this->accounting_sales_time_activity_model->deleteTimeActivity($id);

        if($query){
            echo json_encode(1);
        }
        else{
            echo json_encode(0);
        }
    }
	
	public function addCustomersAccounting(){
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
        if ($query){
             echo json_encode(1);
        }else{
            echo json_encode(0);
        }
    }
	
	public function updateCustomersAccounting(){
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
        if ($query){
             echo json_encode(1);
        }else{
            echo json_encode(0);
        }
    }
	public function deleteCustomersAccounting(){
        $id = $this->input->post('id');
        $query = $this->accounting_customer_model->deleteCustomer($id);

        if($query){
            echo json_encode(1);
        }
        else{
            echo json_encode(0);
        }
    }
	public function searchCustomersAccounting(){
        $id = $this->input->post('id');
        $searchCustomer = $this->input->post('word');
        $query = $this->accounting_customer_model->searchCustomer($id,$searchCustomer);

        if($query){
            echo json_encode(1);
        }
        else{
            echo json_encode(0);
        }
    }

    // Jan 2, 2021 Update
    public function modal_invoice(){
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->load->view('accounting/customer_invoice_modal', $this->page_data);
    }
    public function modal_estimate(){
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

        if($query > 0){
           
        $i = 0;
        foreach($a as $row){
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
            foreach($aa as $row2){
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
            
        }
        else{
            echo json_encode(0);
        }
    }

    public function addvendorcredit(){
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
        if($addQuery > 0){
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
        foreach($a as $row){
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
            foreach($aa as $row2){
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
            
        }
        else{
            echo json_encode(0);
        }
    }

    public function addvendorcreditcard(){
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
        if($addQuery > 0){
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
        foreach($a as $row){
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
            foreach($aa as $row2){
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
            
        }
        else{
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
        
        if($query > 0){
           
        $i = 0;
        foreach($a as $row){
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
            foreach($aa as $row2){
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
            
        }
        else{
            echo json_encode(0);
        }
    }

    public function addExpense(){
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

        if($query > 0){
           
        $i = 0;
        foreach($a as $row){
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
            foreach($aa as $row2){
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
            
        }
        else{
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
        if($addQuery > 0){
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
        foreach($a as $row){
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
            
        }
        else{
            echo json_encode(0);
        }
    }


    // New Forms
    public function addNewEstimate()
    {   
        $this->load->model('AcsProfile_model');

        $query_autoincrment = $this->db->query("SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE table_name = 'customer_groups'");
        $result_autoincrement = $query_autoincrment->result_array();

        if(count( $result_autoincrement )) {
            if($result_autoincrement[0]['AUTO_INCREMENT'])
            {
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
        if( $role == 1 || $role == 2 ){
            $this->page_data['customers'] = $this->AcsProfile_model->getAllByCompanyId($company_id);
        }else{
            $this->page_data['customers'] = $this->AcsProfile_model->getAll();    
        }
        $type = $this->input->get('type');
        $this->page_data['type'] = $type;
        $this->page_data['items'] = $this->items_model->getItemlist();
        $this->page_data['plans'] = $this->plans_model->getByWhere(['company_id' => $company_id]);

        // $this->page_data['file_selection'] = $this->load->view('modals/file_vault_selection', array(), TRUE);
        $this->load->view('accounting/addnewEstimate', $this->page_data);
    }

    public function addNewEstimateOptions()
    {   
        $this->load->model('AcsProfile_model');

        $query_autoincrment = $this->db->query("SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE table_name = 'customer_groups'");
        $result_autoincrement = $query_autoincrment->result_array();

        if(count( $result_autoincrement )) {
            if($result_autoincrement[0]['AUTO_INCREMENT'])
            {
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
        if( $role == 1 || $role == 2 ){
            $this->page_data['customers'] = $this->AcsProfile_model->getAllByCompanyId($company_id);
        }else{
            $this->page_data['customers'] = $this->AcsProfile_model->getAll();    
        }
        $type = $this->input->get('type');
        $this->page_data['type'] = $type;
        $this->page_data['items'] = $this->items_model->getItemlist();
        $this->page_data['plans'] = $this->plans_model->getByWhere(['company_id' => $company_id]);

        // $this->page_data['file_selection'] = $this->load->view('modals/file_vault_selection', array(), TRUE);
        $this->load->view('accounting/addNewEstimateOptions', $this->page_data);
    }
    
    public function addNewEstimateBundle()
    {   
        $this->load->model('AcsProfile_model');

        $query_autoincrment = $this->db->query("SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE table_name = 'customer_groups'");
        $result_autoincrement = $query_autoincrment->result_array();

        if(count( $result_autoincrement )) {
            if($result_autoincrement[0]['AUTO_INCREMENT'])
            {
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
        if( $role == 1 || $role == 2 ){
            $this->page_data['customers'] = $this->AcsProfile_model->getAllByCompanyId($company_id);
        }else{
            $this->page_data['customers'] = $this->AcsProfile_model->getAll();    
        }
        $type = $this->input->get('type');
        $this->page_data['type'] = $type;
        $this->page_data['items'] = $this->items_model->getItemlist();
        $this->page_data['plans'] = $this->plans_model->getByWhere(['company_id' => $company_id]);

        // $this->page_data['file_selection'] = $this->load->view('modals/file_vault_selection', array(), TRUE);
        $this->load->view('accounting/addNewEstimateBundle', $this->page_data);
    }

    public function addnewInvoice(){
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['items'] = $this->items_model->getItemlist();
        $this->page_data['invoices'] = $this->accounting_invoices_model->getInvoices();
        $this->page_data['page_title'] = "Invoices";
        // print_r($this->page_data);
        $this->load->view('accounting/addInvoice', $this->page_data);
    }

    public function NewworkOrder(){
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['page_title'] = "Work Order";
        // print_r($this->page_data);
        $this->load->view('accounting/NewworkOrder', $this->page_data);
    }

    public function listworkOrder(){
        // $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        // $this->page_data['page_title'] = "Work Order List";
        // print_r($this->page_data);
        $is_allowed = $this->isAllowedModuleAccess(24);
        if( !$is_allowed ){
            $this->page_data['module'] = 'workorder';
            echo $this->load->view('no_access_module', $this->page_data, true);
            die();
        }

        $is_allowed = $this->isAllowedModuleAccess(24);
        if( !$is_allowed ){
            $this->page_data['module'] = 'workorder';
            echo $this->load->view('no_access_module', $this->page_data, true);
            die();
        }

        $role = logged('role');
        $this->page_data['workorderStatusFilters'] = array ();
        $this->page_data['workorders'] = array ();
        // $this->page_data['jobs'] = $this->jobs_model->getByWhere(['company_id' => logged('company_id')]);
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

        // unserialized the value

        $statusFilter = array();
        foreach ($this->page_data['workorders'] as $workorder) {

            if (is_serialized($workorder)) {

                $workorder = unserialize($workorder);
            }
        }
        $this->load->view('accounting/work_order_list', $this->page_data);
    }

    public function newEstimateList($tab = ''){
        $is_allowed = $this->isAllowedModuleAccess(18);
        if( !$is_allowed ){
            $this->page_data['module'] = 'estimate';
            echo $this->load->view('no_access_module', $this->page_data, true);
            die();
        }
        $role = logged('role');
        if ($role == 2 || $role == 3 || $role == 1) {
            $this->page_data['jobs'] = $this->jobs_model->getByWhere([]);
        }else{
            $company_id = logged('company_id');
            $this->page_data['jobs'] = $this->jobs_model->getByWhere(['company_id' => $company_id]);   
        }
            
        if (!empty($tab)) {
            $query_tab = $tab;
            if( $tab == 'declined%20by%20customer' ){
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
                if( $role == 1 || $role == 2 ){
                    $this->page_data['estimates'] = $this->estimate_model->getAllEstimates();
                }else{
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

    public function savenewWorkOrder(){
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

            redirect('workorder');
        }
    }

    public function tickets(){
        $user_id = logged('id');
        // $this->page_data['leads'] = $this->customer_ad_model->get_leads_data();
        $this->load->view('tickets/list', $this->page_data);
    }

    public function addexpensename(){
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

    public function salesTax(){
        $user_id = logged('id');
        $this->load->view('accounting/sales_tax', $this->page_data);
    }

    public function payrollTax(){
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
        $config['validation'] = TRUE;  

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
        $this->load->view('accounting/estimateviewdetails',$this->page_data);
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

}