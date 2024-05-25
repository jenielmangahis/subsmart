<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contractors extends MY_Controller {
	
	public function __construct()
    {
		parent::__construct();
        $this->checkLogin();
        $this->load->model('vendors_model');
        $this->load->model('account_model');
        $this->load->model('expenses_model');        
        $this->load->model('accounting_account_transactions_model');
        $this->load->model('accounting_customers_model');
        $this->load->model('accounting_invoices_model');

        $this->load->model('AcsProfile_model');
        $this->load->model('invoice_model');
        $this->load->model('workorder_model');
        $this->load->model('estimate_model');
        $this->load->model('accounting_receive_payment_model');
        $this->load->model('accounting_sales_receipt_model');
        $this->load->model('accounting_credit_memo_model');
        $this->load->model('accounting_statements_model');

        $this->page_data['page']->title = 'Contractors';
        $this->page_data['page']->parent = 'Payroll';

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
        $this->hasAccessModule(77); 
        
        add_footer_js(array(
            "assets/js/v2/accounting/payroll/contractors/list.js"
        ));

        switch(get('status')) {
            case 'inactive' :
                $status = [
                    0
                ];
            break;
            case 'all' :
                $status = [
                    0,
                    1
                ];
            break;
            default :
                $status = [
                    1
                ];
            break;
        }

        $this->page_data['status'] = get('status');

        $contractors = $this->vendors_model->get_company_contractors($status);

        if(!empty(get('search'))) {
            $search = get('search');
            $contractors = array_filter($contractors, function($contractor, $key) use ($search) {
                return stripos($contractor->display_name, $search) !== false;
            }, ARRAY_FILTER_USE_BOTH);

            $this->page_data['search'] = $search;
        }

        usort($contractors, function($a, $b) use ($order) {
            return strcasecmp($a->display_name, $b->display_name);
        });


        $this->page_data['contractors'] = $contractors;
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['page_title'] = "Contractors";
        $this->load->view('v2/pages/accounting/payroll/contractors/list', $this->page_data);
    }

    public function add()
    {
        $data = [
            'company_id' => logged('company_id'),
            'display_name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'contractor' => 1,
            'created_by' => logged('id'),
            'status' => 1
        ];

        $contractorId = $this->vendors_model->createVendor($data);

        if($contractorId) {
            $this->session->set_flashdata('success', "Contractor added successfully!");
        } else {
            $this->session->set_flashdata('error', "Please try again!");
        }

        redirect($_SERVER['HTTP_REFERER']);
    }

    public function view($contractorId)
    {
        $this->hasAccessModule(77); 
        add_footer_js(array(
            "assets/js/v2/accounting/payroll/contractors/view.js"
        ));

        $hasFilter = false;

        $filter = [];
        if(!empty(get('date'))) {
            switch(get('date')) {
                case 'this-month' :
                    $filter['start-date'] = date("Y-m-01");
                    $filter['end-date'] = date("Y-m-t");
                break;
                case 'last-3-months' :
                    $filter['start-date'] = date("Y-m-d", strtotime(date("Y-m-d").' -3 months'));
                    $filter['end-date'] = date("Y-m-d");
                break;
                case 'last-12-months' :
                    $filter['start-date'] = date("Y-m-d", strtotime(date("Y-m-d").' -12 months'));
                    $filter['end-date'] = date("Y-m-d");
                break;
                case 'year-to-date' :
                    $filter['start-date'] = date("Y-m-d", strtotime(date("Y-m-d").' -1 year'));
                    $filter['end-date'] = date("Y-m-d");
                break;
            }

            $this->page_data['date'] = get('date');
            $hasFilter = true;
        }

        if(!empty(get('type'))) {
            switch(get('type')) {
                case 'check' :
                    $checks = $this->vendors_model->get_vendor_check_transactions($contractorId, $filter);
                break;
                case 'expense' :
                    $expenses = $this->vendors_model->get_vendor_expense_transactions($contractorId, $filter);
                break;
                case 'bill-payment' :
                    $bills = $this->vendors_model->get_vendor_bill_transactions($contractorId, $filter);
                break;
            }

            $this->page_data['type'] = get('type');

            $hasFilter = true;
        } else {
            $checks = $this->vendors_model->get_vendor_check_transactions($contractorId, $filter);
            $expenses = $this->vendors_model->get_vendor_expense_transactions($contractorId, $filter);
            $bills = $this->vendors_model->get_vendor_bill_transactions($contractorId, $filter);
        }

        $data = [];
        if($checks && count($checks) > 0) {
            foreach($checks as $check) {
                $data[] = [
                    'date' => $check->payment_date,
                    'type' => 'Check',
                    'payment_method' => 'Check',
                    'amount' => floatval($check->total_amount)
                ];
            }
        }

        if($expenses && count($expenses) > 0) {
            foreach($expenses as $expense) {
                if($expense->payment_method !== 'Check' && $expense->payment_method !== 'Direct deposit') {
                    $payMethod = 'Other';
                } else {
                    $payMethod = $expense->payment_method;
                }

                $data[] = [
                    'date' => $expense->payment_date,
                    'type' => 'Expense',
                    'payment_method' => $payMethod,
                    'amount' => floatval($expense->total_amount)
                ];
            }
        }

        if($bills && count($bills) > 0) {
            foreach($bills as $bill) {
                $data[] = [
                    'date' => $bill->bill_date,
                    'type' => 'Bill payment',
                    'payment_method' => 'Check',
                    'amount' => floatval($bill->total_amount)
                ];
            }
        }

        if(!empty(get('method'))) {
            $paymentMethod = get('method');
            $data = array_filter($data, function($value, $key) use ($paymentMethod) {
                switch($paymentMethod) {
                    case 'check' :
                        return $value['payment_method'] === 'Check';
                    break;
                    case 'direct-deposit' :
                        return $value['payment_method'] === 'Direct deposit';
                    break;
                    case 'other' :
                        return $value['payment_method'] === 'Other';
                    break;
                    default :
                        return true;
                    break;
                }
            }, ARRAY_FILTER_USE_BOTH);

            $this->page_data['method'] = get('method');
            $hasFilter = true;
        }

        usort($data, function($a, $b) {
            return strtotime($a['date']) < strtotime($b['date']);
        });

        $prevUrl = $_SERVER['HTTP_REFERER'];
        $prevUrl = explode('?', $prevUrl);

        if($hasFilter === false && count($prevUrl) > 1) {
            $hasFilter = true;
        }

        $this->page_data['has_filter'] = $hasFilter;

        $this->page_data['payments'] = $data;
        $this->page_data['paymentsTotal'] = array_sum(array_column($data, 'amount'));
        $this->page_data['contractorTypes'] = $this->vendors_model->get_contractor_types();
        $this->page_data['contractor'] = $this->vendors_model->get_contractor($contractorId);
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['page_title'] = "Contractors";
        $this->load->view('v2/pages/accounting/payroll/contractors/view', $this->page_data);
    }

    public function update($contractorId)
    {
        $details = [
            'display_name' => $this->input->post('name'),
            'email' => $this->input->post('email')
        ];

        $update = $this->vendors_model->update_contractor($contractorId, $details);

        if($update) {
            $this->session->set_flashdata('success', "Contractor details updated successfully!");
        } else {
            $this->session->set_flashdata('error', "Unexpected error, please try again!");
        }

        redirect($_SERVER['HTTP_REFERER']);
    }

    public function update_details($contractorId)
    {
        $basicDetails = [
            'contractor_type_id' => $this->input->post('contractor_type'),
            'title' => $this->input->post('contractor_type') === "1" ? $this->input->post('title') : null,
            'f_name' => $this->input->post('contractor_type') === "1" ? $this->input->post('first_name') : null,
            'm_name' => $this->input->post('contractor_type') === "1" ? $this->input->post('middle_name') : null,
            'l_name' => $this->input->post('contractor_type') === "1" ? $this->input->post('last_name') : null,
            'suffix' => $this->input->post('contractor_type') === "1" ? $this->input->post('suffix') : null,
            // 'email' => $this->input->post('email'),
            'company' => $this->input->post('contractor_type') === "2" ? $this->input->post('business_name') : null,
            'display_name' => $this->input->post('display_name'),
            'street' => $this->input->post('address'),
            'city' => $this->input->post('city'),
            'state' => $this->input->post('state'),
            'zip' => $this->input->post('zip_code'),
            'tax_id' => $this->input->post('contractor_type') === "1" ? $this->input->post('social_sec_num') : $this->input->post('emp_id_num'),
        ];

        $update = $this->vendors_model->update_contractor($contractorId, $basicDetails);

        if($update) {
            $this->session->set_flashdata('success', "Contractor details updated successfully!");
        } else {
            $this->session->set_flashdata('error', "Unexpected error, please try again!");
        }

        redirect($_SERVER['HTTP_REFERER']);
    }

    public function set_status($contractorId, $status)
    {
        if($status === 'inactive') {
            $updateStatus = $this->vendors_model->update_contractor_status($contractorId, 0);
        } else {
            $updateStatus = $this->vendors_model->update_contractor_status($contractorId, 1);
        }

        if($updateStatus) {
            $this->session->set_flashdata('success', "Contractor successfully set as $status.");
        } else {
            $this->session->set_flashdata('success', 'Unexpected error, please try again!');
        }

        redirect($_SERVER['HTTP_REFERER']);
    }

    public function load_contractor_payments($contractorId)
    {
        $post = json_decode(file_get_contents('php://input'), true);
        $start = $post['start'];
        $limit = $post['length'];
        $date = $post['date'];
        $type = $post['type'];
        $paymentMethod = $post['payment_method'];

        $filter = [];
        switch ($date) {
            case 'this-month' :
                $filter['start-date'] = date("Y-m-01");
                $filter['end-date'] = date("Y-m-t");
            break;
            case 'last-3-months' :
                $filter['start-date'] = date("Y-m-d", strtotime(date("Y-m-d").' -3 months'));
                $filter['end-date'] = date("Y-m-d");
            break;
            case 'last-12-months' :
                $filter['start-date'] = date("Y-m-d", strtotime(date("Y-m-d").' -12 months'));
                $filter['end-date'] = date("Y-m-d");
            break;
            case 'year-to-date' :
                $filter['start-date'] = date("Y-m-d", strtotime(date("Y-m-d").' -1 year'));
                $filter['end-date'] = date("Y-m-d");
            break;
        }

        $recordsTotal = 0;

        switch($type) {
            case 'check' :
                $checks = $this->vendors_model->get_vendor_check_transactions($contractorId, $filter);
                $recordsTotal += count($checks);
            break;
            case 'expense' :
                $expenses = $this->vendors_model->get_vendor_expense_transactions($contractorId, $filter);
                $recordsTotal += count($expenses);
            break;
            case 'bill-payment' :
                $bills = $this->vendors_model->get_vendor_bill_transactions($contractorId, $filter);
                $recordsTotal += count($bills);
            break;
            default :
                $checks = $this->vendors_model->get_vendor_check_transactions($contractorId, $filter);
                $expenses = $this->vendors_model->get_vendor_expense_transactions($contractorId, $filter);
                $bills = $this->vendors_model->get_vendor_bill_transactions($contractorId, $filter);
                $recordsTotal += count($checks);
                $recordsTotal += count($expenses);
                $recordsTotal += count($bills);
            break;
        }

        $data = [];
        if($checks && count($checks) > 0) {
            foreach($checks as $check) {
                $data[] = [
                    'date' => $check->payment_date,
                    'type' => 'Check',
                    'payment_method' => 'Check',
                    'amount' => "$$check->total_amount"
                ];
            }
        }

        if($expenses && count($expenses) > 0) {
            foreach($expenses as $expense) {
                if($expense->payment_method !== 'Check' && $expense->payment_method !== 'Direct deposit') {
                    $payMethod = 'Other';
                } else {
                    $payMethod = $expense->payment_method;
                }

                $data[] = [
                    'date' => $expense->payment_date,
                    'type' => 'Expense',
                    'payment_method' => $payMethod,
                    'amount' => "$$expense->amount"
                ];
            }
        }

        if($bills && count($bills) > 0) {
            foreach($bills as $bill) {
                $data[] = [
                    'date' => $bill->bill_date,
                    'type' => 'Bill payment',
                    'payment_method' => 'Check',
                    'amount' => "$$bill->total_amount"
                ];
            }
        }

        $data = array_filter($data, function($value, $key) use ($paymentMethod) {
            switch($paymentMethod) {
                case 'check' :
                    return $value['payment_method'] === 'Check';
                break;
                case 'direct-deposit' :
                    return $value['payment_method'] === 'Direct deposit';
                break;
                case 'other' :
                    return $value['payment_method'] === 'Other';
                break;
                default :
                    return true;
                break;
            }
        }, ARRAY_FILTER_USE_BOTH);

        usort($data, function($a, $b) {
            return strtotime($a['date']) < strtotime($b['date']);
        });

        $result = [
            'draw' => $post['draw'],
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => count($data),
            'data' => array_slice($data, $start, $limit)
        ];

        echo json_encode($result);
    }

    public function get_payments_total($contractorId)
    {
        $post = $this->input->post();
        $date = $post['date'];
        $type = $post['type'];
        $paymentMethod = $post['payment_method'];

        $filter = [];
        switch ($date) {
            case 'this-month' :
                $filter['start-date'] = date("Y-m-01");
                $filter['end-date'] = date("Y-m-t");
            break;
            case 'last-3-months' :
                $filter['start-date'] = date("Y-m-d", strtotime(date("Y-m-d").' -3 months'));
                $filter['end-date'] = date("Y-m-d");
            break;
            case 'last-12-months' :
                $filter['start-date'] = date("Y-m-d", strtotime(date("Y-m-d").' -12 months'));
                $filter['end-date'] = date("Y-m-d");
            break;
            case 'year-to-date' :
                $filter['start-date'] = date("Y-m-d", strtotime(date("Y-m-d").' -1 year'));
                $filter['end-date'] = date("Y-m-d");
            break;
        }

        switch($type) {
            case 'check' :
                $checks = $this->vendors_model->get_vendor_check_transactions($contractorId, $filter);
            break;
            case 'expense' :
                $expenses = $this->vendors_model->get_vendor_expense_transactions($contractorId, $filter);
            break;
            case 'bill-payment' :
                $bills = $this->vendors_model->get_vendor_bill_transactions($contractorId, $filter);
            break;
            default :
                $checks = $this->vendors_model->get_vendor_check_transactions($contractorId, $filter);
                $expenses = $this->vendors_model->get_vendor_expense_transactions($contractorId, $filter);
                $bills = $this->vendors_model->get_vendor_bill_transactions($contractorId, $filter);
            break;
        }

        if($checks && count($checks) > 0) {
            foreach($checks as $check) {
                $data[] = [
                    'payment_method' => 'Check',
                    'amount' => "$check->total_amount"
                ];
            }
        }

        if($expenses && count($expenses) > 0) {
            foreach($expenses as $expense) {
                if($expense->payment_method !== 'Check' && $expense->payment_method !== 'Direct deposit') {
                    $payMethod = 'Other';
                } else {
                    $payMethod = $expense->payment_method;
                }

                $data[] = [
                    'payment_method' => $payMethod,
                    'amount' => "$expense->amount"
                ];
            }
        }

        if($bills && count($bills) > 0) {
            foreach($bills as $bill) {
                $data[] = [
                    'payment_method' => 'Check',
                    'amount' => "$bill->total_amount"
                ];
            }
        }

        $data = array_filter($data, function($value, $key) use ($paymentMethod) {
            switch($paymentMethod) {
                case 'check' :
                    return $value['payment_method'] === 'Check';
                break;
                case 'direct-deposit' :
                    return $value['payment_method'] === 'Direct deposit';
                break;
                case 'other' :
                    return $value['payment_method'] === 'Other';
                break;
                default :
                    return true;
                break;
            }
        }, ARRAY_FILTER_USE_BOTH);

        $paymentsCount = count($data);
        $paymentsTotal = 0.00;
        foreach($data as $rec) {
            $paymentsTotal += floatval($rec['amount']);
        }

        echo json_encode([
            'payments_count' => $paymentsCount,
            'payments_total' => number_format($paymentsTotal, 2, '.', ',')
        ]);
    }

    public function preview_contractor_payment()
    {
        $correspondingAcc = $this->chart_of_accounts_model->getById($this->input->post('corresponding_account'));

        $contractors  = $this->input->post('contractor');

        $unique_contractors = isset($contractors) ? array_unique($contractors) : [];
        $total_amount = $this->input->post('total_pay');


        if($this->input->post('contractor')) {
            $html = '<div class="row" style="min-height: 100%">
                <div class="col-12">
                    <div class="row grid-mb">
                        <div class="col-md-2 col-12 grid-mb">
                            <label for="corresponding-account">Corresponding account in nSmarTrac</label>
                            <h4>'.$correspondingAcc->name.'</h4>
                        </div>
                        <div class="col-md-2 col-12 grid-mb">
                            <label for="pay-date">Pay date</label>
                            <h4>'.$this->input->post('pay_date').'</h4>
                        </div>
                        <div class="col-12 col-md-8 text-end grid-mb">
                            <h6>
                                TOTAL PAY
                            </h6>
                            <h2>
                                <span class="transaction-total-amount">'.str_replace('$-', '-$', '$'.number_format(floatval(str_replace(',', '', $this->input->post('total_amount'))), 2)).'</span>
                            </h2>
                        </div>
                        <div class="col-12">
                            <table class="nsm-table" id="preview-contractor-payment-table">
                                <thead>
                                    <tr>
                                        <td data-name="Contractor">CONTRACTOR</td>
                                        <td data-name="Pay Method">PAY METHOD</td>
                                        <td data-name="Transaction Info" width="50%">TRANSACTION INFO</td>
                                        <td data-name="Fixed Pay" class="text-end">FIXED PAY</td>
                                        <td data-name="Total Pay" class="text-end">TOTAL PAY</td>
                                    </tr>
                                </thead>
                                <tbody>';
                                //if(isset($unique_contractors)) {
                                    //foreach($this->input->post('contractor') as $index => $contractorId) {
                                    foreach($unique_contractors as $index => $contractorId) {
                                        $contractor = $this->vendors_model->get_contractor($contractorId);
                                        $amount = $this->input->post('amount[]')[$index];
    
                                        //if(isset($total_amount[$index]) && $total_amount[$index] > 0 ) {
                                            $html .= '<tr>
                                                <td>'.$contractor->display_name.'</td>
                                                <td>Paper check</td>
                                                <td></td>
                                                <td class="text-end">'.str_replace('$-', '-$', '$'.number_format(floatval(str_replace(',', '', $amount)), 2)).'</td>
                                                <td class="text-end">'.str_replace('$-', '-$', '$'.number_format(floatval(str_replace(',', '', $amount)), 2)).'</td>
                                            </tr>';
                                        //}
    
                                    }
                                //}

                                $html .= '</tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="4"><b>TOTAL</b></td>
                                        <td class="text-end">'.str_replace('$-', '-$', '$'.number_format(floatval(str_replace(',', '', $this->input->post('total_amount'))), 2)).'</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>';
        } else {
            $html = '<div class="row"><div class="col-12">NO SELECTED CONTRACTOR</div></div>';
        }



        echo $html;
    }

    public function submit_contractor_payment()
    {
        $post = $this->input->post();

        $inserted = 0;
        foreach($post['contractor'] as $key => $contractorId)
        {
            $contractor = $this->vendors_model->get_contractor($contractorId);

            $address = '';
            $address .= $contractor->street !== "" && $contractor->street !== null ? $contractor->street : "";
            $address .= $contractor->city !== "" && $contractor->city !== null ? '\n' . $contractor->city : "";
            $address .= $contractor->state !== "" && $contractor->state !== null ? ', ' . $contractor->state : "";
            $address .= $contractor->zip !== "" && $contractor->zip !== null ? ' ' . $contractor->zip : "";

            $checkData = [
                'company_id' => logged('company_id'),
                'payee_type' => 'vendor',
                'payee_id' => $contractorId,
                'bank_account_id' => $post['corresponding_account'],
                'mailing_address' => nl2br($address),
                'payment_date' => date("Y-m-d", strtotime($post['pay_date'])),
                'check_no' => $post['check_number'][$key],
                'to_print' => null,
                'permit_no' => null,
                'memo' => '',
                'total_amount' => floatval(str_replace(',', '', $post['total_pay'][$key])),
                'recurring' => null,
                'status' => 1
            ];

            $checkId = $this->expenses_model->addCheck($checkData);

            if($checkId) {
                $inserted++;
                $bankAcc = $this->chart_of_accounts_model->getById($post['corresponding_account']);
                $newBalance = floatval(str_replace(',', '', $bankAcc->balance)) - floatval(str_replace(',', '', $post['total_pay'][$key]));
                $newBalance = number_format($newBalance, 2, '.', ',');

                $bankAccData = [
                    'id' => $bankAcc->id,
                    'company_id' => logged('company_id'),
                    'balance' => floatval(str_replace(',', '', $newBalance))
                ];

                $this->chart_of_accounts_model->updateBalance($bankAccData);

                $accTransacData = [
                    'account_id' => $bankAcc->id,
                    'transaction_type' => 'Check',
                    'transaction_id' => $checkId,
                    'amount' => floatval(str_replace(',', '', $post['total_pay'][$key])),
                    'transaction_date' => date("Y-m-d", strtotime($post['pay_date'])),
                    'type' => 'decrease',
                ];

                $this->accounting_account_transactions_model->create($accTransacData);

                $expenseAccId = $post['account'][$key];
                $categoryDetail = [
                    'transaction_type' => 'Check',
                    'transaction_id' => $checkId,
                    'expense_account_id' => $expenseAccId,
                    'category' => 'fixed',
                    'description' => $post['description'][$key],
                    'amount' => $post['total_pay'][$key],
                    'billable' => 0,
                    'markup_percentage' => 0,
                    'tax' => 0,
                    'customer_id' => $post['customer'][$key],
                    'linked_transaction_type' => null,
                    'linked_transaction_id' => null,
                    'linked_transaction_category_id' => null
                ];

                $categoryDetailId = $this->expenses_model->insert_vendor_transaction_category($categoryDetail);

                $expenseAcc = $this->chart_of_accounts_model->getById($expenseAccId);
                $expenseAccType = $this->account_model->getById($expenseAcc->account_id);

                if ($expenseAccType->account_name === 'Credit Card') {
                    $newBalance = floatval(str_replace(',', '', $expenseAcc->balance)) - floatval(str_replace(',', '', $post['total_pay'][$key]));
                } else {
                    $newBalance = floatval(str_replace(',', '', $expenseAcc->balance)) + floatval(str_replace(',', '', $post['total_pay'][$key]));
                }
                $newBalance = number_format($newBalance, 2, '.', ',');

                $expenseAccData = [
                    'id' => $expenseAcc->id,
                    'company_id' => logged('company_id'),
                    'balance' => floatval(str_replace(',', '', $newBalance))
                ];

                $this->chart_of_accounts_model->updateBalance($expenseAccData);

                $accTransacData = [
                    'account_id' => $expenseAcc->id,
                    'transaction_type' => 'Check',
                    'transaction_id' => $checkId,
                    'amount' => floatval(str_replace(',', '', $post['total_pay'][$key])),
                    'transaction_date' => date("Y-m-d", strtotime($data['payment_date'])),
                    'type' => 'increase',
                    'is_category' => 1,
                    'child_id' => $categoryDetailId
                ];

                $this->accounting_account_transactions_model->create($accTransacData);
            }
        }

        echo json_encode([
            'success' => count($post['contractor']) === $inserted ? true : false,
            'message' => count($post['contractor']) === $inserted ? 'Contractor payment successful.' : 'Contractor payment error.'
        ]);
    }    
}