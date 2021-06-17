<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Expenses extends MY_Controller {
	
	public function __construct()
    {
		parent::__construct();
        $this->checkLogin();
        $this->load->model('expenses_model');
        $this->load->model('accounting_customers_model');
        $this->load->model('vendors_model');
        $this->load->model('accounting_payment_methods_model');

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
            "assets/js/accounting/expenses/expenses.js"
        ));
        $this->page_data['dropdown']['customers'] = $this->accounting_customers_model->getAllByCompany();
        $this->page_data['dropdown']['employees'] = $this->users_model->getCompanyUsers(logged('company_id'));
        $this->page_data['dropdown']['vendors'] = $this->vendors_model->getAllByCompany();
        $this->page_data['dropdown']['categories'] = $this->get_category_accs();
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->load->view('accounting/expenses/index', $this->page_data);
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

        foreach($accountTypes as $typeName) {
            $accType = $this->account_model->getAccTypeByName($typeName);

            $accounts = $this->chart_of_accounts_model->getByAccountType($accType->id, null, logged('company_id'));

            if(count($accounts) > 0) {
                foreach($accounts as $account) {
                    $childAccs = $this->chart_of_accounts_model->getChildAccounts($account->id);

                    $account->childAccs = $childAccs;

                    $categoryAccs[$typeName][] = $account;
                }
            }
        }

        return $categoryAccs;
    }

    public function load_transactions()
    {
        $post = json_decode(file_get_contents('php://input'), true);
        $column = $post['order'][0]['column'];
        $order = $post['order'][0]['dir'];
        $columnName = $post['columns'][$column]['name'];

        $filters = $this->set_filters($post);

        $data = $this->get_transactions($filters);

        usort($data, function($a, $b) use ($order, $columnName) {
            if($columnName !== 'date') {
                if($order === 'asc') {
                    return strcmp($a[$columnName], $b[$columnName]);
                } else {
                    return strcmp($b[$columnName], $a[$columnName]);
                }
            } else {
                if($order === 'asc') {
                    return strtotime($a[$columnName]) > strtotime($b[$columnName]);
                } else {
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

    private function get_transactions($filters)
    {
        switch($filters['type']) {
            case 'all' :
                if(!isset($filters['payee']) || $filters['payee']['type'] === 'vendor') {
                    $bills = $this->expenses_model->get_company_bill_transactions($filters);
                }
                if(!isset($filters['status'])) {
                    $expenses = $this->expenses_model->get_company_expense_transactions($filters);
                    $checks = $this->expenses_model->get_company_check_transactions($filters);
                    $purchOrders = $this->expenses_model->get_company_purch_order_transactions($filters);
                    $vendorCredits = $this->expenses_model->get_company_vendor_credit_transactions($filters);
                    $ccPayments = $this->expenses_model->get_company_cc_payment_transactions($filters);
                    $billPayments = $this->expenses_model->get_company_bill_payment_items($filters);
                    $creditCardCredits = $this->expenses_model->get_company_cc_credit_transactions($filters);
                }
            break;
            case 'bill' :
                $bills = $this->expenses_model->get_company_bill_transactions($filters);
            break;
            case 'expenses' :
                $expenses = $this->expenses_model->get_company_expense_transactions($filters);
            break;
            case 'check' :
                $checks = $this->expenses_model->get_company_check_transactions($filters);
            break;
            case 'purchase-order' :
                $purchOrders = $this->expenses_model->get_company_purch_order_transactions($filters);
            break;
            case 'vendor-credit' :
                $vendorCredits = $this->expenses_model->get_company_vendor_credit_transactions($filters);
            break;
            case 'credit-card-payment' :
                $ccPayments = $this->expenses_model->get_company_cc_payment_transactions($filters);
            break;
            case 'bill-payments' :
                $billPayments = $this->expenses_model->get_company_bill_payment_items($filters);
            break;
        }

        $transactions = [];
        if(isset($bills) && count($bills) > 0) {
            foreach($bills as $bill) {
                if(!is_null($bill->attachments) && $bill->attachments !== "") {
                    $attachments = count(json_decode($bill->attachments, true));
                } else {
                    $attachments = '';
                }

                $payee = $this->vendors_model->get_vendor_by_id($bill->vendor_id);

                $transactions[] = [
                    'id' => $bill->id,
                    'date' => date("m/d/Y", strtotime($bill->bill_date)),
                    'type' => 'Bill',
                    'number' => $bill->bill_no,
                    'payee' => $payee->display_name,
                    'method' => '',
                    'source' => '',
                    'category' => $this->category_col($bill->id, 'Bill'),
                    'memo' => $bill->memo,
                    'due_date' => '',
                    'balance' => '$'.number_format(floatval($bill->remaining_balance), 2, '.', ','),
                    'total' => '$'.number_format(floatval($bill->total_amount), 2, '.', ','),
                    'status' => $bill->status === "2" ? "Paid" : "Open",
                    'attachments' => $attachments
                ];
            }
        }

        if(isset($billPayments) && count($billPayments) > 0) {
            foreach($billPayments as $billPayment) {
                if(!is_null($billPayment->attachments) && $billPayment->attachments !== "") {
                    $attachments = count(json_decode($billPayment->attachments, true));
                } else {
                    $attachments = '';
                }

                $paymentAcc = $this->chart_of_accounts_model->getById($billPayment->payment_account_id);
                $paymentAccType = $this->account_model->getById($paymentAcc->account_id);
                $paymentType = $paymentAccType->account_name === 'Bank' ? 'Check' : 'Credit Card';

                $payee = $this->vendors_model->get_vendor_by_id($billPayment->payee_id);

                $transactions[] = [
                    'id' => $billPayment->id,
                    'date' => date("m/d/Y", strtotime($billPayment->payment_date)),
                    'type' => "Bill Payment ($paymentType)",
                    'number' => $billPayment->check_no,
                    'payee' => $payee->display_name,
                    'method' => '',
                    'source' => '',
                    'category' => '',
                    'memo' => $billPayment->memo,
                    'due_date' => '',
                    'balance' => '$0.00',
                    'total' => '$'.number_format(floatval($total), 2, '.', ','),
                    'status' => 'Applied',
                    'attachments' => $attachments
                ];
            }
        }

        if(isset($checks) && count($checks) > 0) {
            foreach($checks as $check) {
                if(!is_null($check->attachments) && $check->attachments !== "") {
                    $attachments = count(json_decode($check->attachments, true));
                } else {
                    $attachments = '';
                }

                switch($check->payee_type) {
                    case 'vendor' :
                        $payee = $this->vendors_model->get_vendor_by_id($check->payee_id);
                        $payeeName = $payee->display_name;
                    break;
                    case 'customer' :
                        $payee = $this->accounting_customers_model->get_customer_by_id($check->payee_id);
                        $payeeName = $payee->first_name . ' ' . $payee->last_name;
                    break;
                    case 'employee' : 
                        $payee = $this->users_model->getUser($check->payee_id);
                        $payeeName = $payee->FName . ' ' . $payee->LName;
                    break;
                }

                $transactions[] = [
                    'id' => $check->id,
                    'date' => date("m/d/Y", strtotime($check->payment_date)),
                    'type' => 'Check',
                    'number' => $check->check_no,
                    'payee' => $payeeName,
                    'method' => '',
                    'source' => '',
                    'category' => $this->category_col($check->id, 'Check'),
                    'memo' => $check->memo,
                    'due_date' => '',
                    'balance' => '$0.00',
                    'total' => '$'.number_format(floatval($check->total_amount), 2, '.', ','),
                    'status' => $check->status === "1" ? "Paid" : "Voided",
                    'attachments' => $attachments
                ];
            }
        }

        if(isset($creditCardCredits) && count($creditCardCredits) > 0) {
            foreach($creditCardCredits as $creditCardCredit) {
                if(!is_null($creditCardCredit->attachments) && $creditCardCredit->attachments !== "") {
                    $attachments = count(json_decode($creditCardCredit->attachments, true));
                } else {
                    $attachments = '';
                }

                switch($creditCardCredit->payee_type) {
                    case 'vendor' :
                        $payee = $this->vendors_model->get_vendor_by_id($creditCardCredit->payee_id);
                        $payeeName = $payee->display_name;
                    break;
                    case 'customer' :
                        $payee = $this->accounting_customers_model->get_customer_by_id($creditCardCredit->payee_id);
                        $payeeName = $payee->first_name . ' ' . $payee->last_name;
                    break;
                    case 'employee' : 
                        $payee = $this->users_model->getUser($creditCardCredit->payee_id);
                        $payeeName = $payee->FName . ' ' . $payee->LName;
                    break;
                }

                $transactions[] = [
                    'id' => $creditCardCredit->id,
                    'date' => date("m/d/Y", strtotime($creditCardCredit->payment_date)),
                    'type' => 'Credit Card Credit',
                    'number' => $creditCardCredit->ref_no,
                    'payee' => $payeeName,
                    'method' => '',
                    'source' => '',
                    'category' => $this->category_col($creditCardCredit->id, 'Credit Card Credit'),
                    'memo' => $creditCardCredit->memo,
                    'due_date' => '',
                    'balance' => '$0.00',
                    'total' => '-$'.number_format(floatval($creditCardCredit->total_amount), 2, '.', ','),
                    'status' => '',
                    'attachments' => $attachments
                ];
            }
        }

        if(isset($ccPayments) && count($ccPayments) > 0) {
            foreach($ccPayments as $ccPayment) {
                if(!is_null($ccPayment->attachments) && $ccPayment->attachments !== "") {
                    $attachments = count(json_decode($ccPayment->attachments, true));
                } else {
                    $attachments = '';
                }

                $payee = $this->vendors_model->get_vendor_by_id($ccPayment->payee_id);

                $transactions[] = [
                    'id' => $ccPayment->id,
                    'date' => date("m/d/Y", strtotime($ccPayment->date)),
                    'type' => 'Credit Card Payment',
                    'number' => '',
                    'payee' => $payee->display_name,
                    'method' => '',
                    'source' => '',
                    'category' => '',
                    'memo' => $ccPayment->memo,
                    'due_date' => '',
                    'balance' => '$0.00',
                    'total' => '$'.number_format(floatval($ccPayment->amount), 2, '.', ','),
                    'status' => '',
                    'attachments' => $attachments
                ];
            }
        }

        if(isset($expenses) && count($expenses) > 0) {
            foreach($expenses as $expense) {
                if(!is_null($expense->attachments) && $expense->attachments !== "") {
                    $attachments = count(json_decode($expense->attachments, true));
                } else {
                    $attachments = '';
                }

                switch($expense->payee_type) {
                    case 'vendor' :
                        $payee = $this->vendors_model->get_vendor_by_id($expense->payee_id);
                        $payeeName = $payee->display_name;
                    break;
                    case 'customer' :
                        $payee = $this->accounting_customers_model->get_customer_by_id($expense->payee_id);
                        $payeeName = $payee->first_name . ' ' . $payee->last_name;
                    break;
                    case 'employee' : 
                        $payee = $this->users_model->getUser($expense->payee_id);
                        $payeeName = $payee->FName . ' ' . $payee->LName;
                    break;
                }

                $method = $this->accounting_payment_methods_model->getById($expense->payment_method_id);

                $transactions[] = [
                    'id' => $expense->id,
                    'date' => date("m/d/Y", strtotime($expense->payment_date)),
                    'type' => 'Expense',
                    'number' => $expense->ref_no,
                    'payee' => $payeeName,
                    'method' => $method->name,
                    'source' => '',
                    'category' => $this->category_col($expense->id, 'Expense'),
                    'memo' => $expense->memo,
                    'due_date' => '',
                    'balance' => '$0.00',
                    'total' => '$'.number_format(floatval($expense->total_amount), 2, '.', ','),
                    'status' => $expense->status === "1" ? 'Paid' : 'Voided',
                    'attachments' => $attachments
                ];
            }
        }

        if(isset($purchOrders) && count($purchOrders) > 0) {
            foreach($purchOrders as $purchOrder) {
                if(!is_null($purchOrder->attachments) && $purchOrder->attachments !== "") {
                    $attachments = count(json_decode($purchOrder->attachments, true));
                } else {
                    $attachments = '';
                }

                $payee = $this->vendors_model->get_vendor_by_id($purchOrder->vendor_id);

                $transactions[] = [
                    'id' => $purchOrder->id,
                    'date' => date("m/d/Y", strtotime($purchOrder->purchase_order_date)),
                    'type' => 'Purchase Order',
                    'number' => $purchOrder->purchase_order_number,
                    'payee' => $payee->display_name,
                    'method' => '',
                    'source' => '',
                    'category' => $this->category_col($purchOrder->id, 'Purchase Order'),
                    'memo' => $purchOrder->memo,
                    'due_date' => '',
                    'balance' => '$0.00',
                    'total' => '$'.number_format(floatval($purchOrder->total_amount), 2, '.', ','),
                    'status' => $purchOrder->status === "1" ? "Open" : "Closed",
                    'attachments' => $attachments
                ];
            }
        }

        if(isset($vendorCredits) && count($vendorCredits) > 0) {
            foreach($vendorCredits as $vendorCredit) {
                if(!is_null($vendorCredit->attachments) && $vendorCredit->attachments !== "") {
                    $attachments = count(json_decode($vendorCredit->attachments, true));
                } else {
                    $attachments = '';
                }

                $payee = $this->vendors_model->get_vendor_by_id($vendorCredit->vendor_id);

                $transactions[] = [
                    'id' => $vendorCredit->id,
                    'date' => date("m/d/Y", strtotime($vendorCredit->payment_date)),
                    'type' => 'Vendor Credit',
                    'number' => $vendorCredit->ref_no,
                    'payee' => $payee->display_name,
                    'method' => '',
                    'source' => '',
                    'category' => $this->category_col($vendorCredit->id, 'Vendor Credit'),
                    'memo' => $vendorCredit->memo,
                    'due_date' => '',
                    'balance' => '$'.number_format(floatval($vendorCredit->remaining_balance), 2, '.', ','),
                    'total' => '-$'.number_format(floatval($vendorCredit->total_amount), 2, '.', ','),
                    'status' => $vendorCredit->status === "1" ? "Open" : "Closed",
                    'attachments' => $attachments
                ];
            }
        }

        return $transactions;
    }

    private function set_filters($post)
    {
        $filters = [
            'company_id' => logged('company_id'),
            'type' => $post['type'],
            'delivery_method' => $post['delivery_method'],
            'category' => $post['category']
        ];

        if($post['payee'] !== 'all') {
            $payee = explode('-', $post['payee']);
            $filters['payee'] = [
                'type' => $payee[0],
                'id' => $payee[1]
            ];
        }

        if($post['status'] !== 'all') {
            $filters['status'] = $post['status'];
        }

        switch($post['date']) {
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
            case 'custom' :
                $filters['start-date'] = date("Y-m-d", strtotime($post['from_date']));
                $filters['end-date'] = date("Y-m-d", strtotime($post['to_date']));
            break;
        }

        return $filters;
    }

    private function category_col($transactionId, $transactionType)
    {
        $categories = $this->expenses_model->get_transaction_categories($transactionId, $transactionType);
        $items = $this->expenses_model->get_transaction_items($transactionId, $transactionType);

        $totalCount = count($categories) + count($items);

        if($totalCount > 1) {
            $category = '-Split-';
        } else {
            if($totalCount === 1) {
                if(count($categories) === 1 && count($items) === 0) {
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

                    foreach($accountTypes as $typeName) {
                        $accType = $this->account_model->getAccTypeByName($typeName);

                        $accounts = $this->chart_of_accounts_model->getByAccountType($accType->id, null, logged('company_id'));

                        if(count($accounts) > 0) {
                            $category .= '<optgroup label="'.$typeName.'">';
                            foreach($accounts as $account) {
                                $childAccs = $this->chart_of_accounts_model->getChildAccounts($account->id);

                                if($account->id === $expenseAcc) {
                                    $category .= '<option value="'.$account->id.'" selected>'.$account->name.'</option>';
                                } else {
                                    $category .= '<option value="'.$account->id.'">'.$account->name.'</option>';
                                }

                                if(count($childAccs) > 0) {
                                    $category .= '<optgroup label="&nbsp;&nbsp;&nbsp;Sub-account of '.$account->name.'">';

                                    foreach($childAccs as $childAcc) {
                                        if($childAcc->id === $expenseAcc) {
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
}