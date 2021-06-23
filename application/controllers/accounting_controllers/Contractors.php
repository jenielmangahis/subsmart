<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contractors extends MY_Controller {
	
	public function __construct()
    {
		parent::__construct();
        $this->checkLogin();
        $this->load->model('vendors_model');

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
        $this->hasAccessModule(77); 
        
        add_footer_js(array(
            "assets/js/accounting/payroll/contractors.js"
        ));
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['page_title'] = "Contractors";
        $this->load->view('accounting/contractors/index', $this->page_data);
    }

    public function load_contractors()
    {
        $post = json_decode(file_get_contents('php://input'), true);
        $order = $post['order'][0]['dir'];
        $start = $post['start'];
        $limit = $post['length'];

        switch($post['status']) {
            case 'active' :
                $status = [
                    1
                ];
            break;
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
        }

        $contractors = $this->vendors_model->get_company_contractors($status);

        $data = [];
        $search = $post['columns'][0]['search']['value'];

        if(count($contractors) > 0) {
            foreach($contractors as $contractor) {
                if($search !== "") {
                    if(stripos($contractor->name, $search) !== false) {
                        $data[] = [
                            'id' => $contractor->id,
                            'name' => $contractor->display_name,
                            'status' => $contractor->status
                        ];
                    }
                } else {
                    $data[] = [
                        'id' => $contractor->id,
                        'name' => $contractor->display_name,
                        'status' => $contractor->status
                    ];
                }
            }
        }

        usort($data, function($a, $b) use ($order) {
            if($order === 'asc') {
                return strcmp($a['name'], $b['name']);
            } else {
                return strcmp($b['name'], $a['name']);
            }
        });

        $result = [
            'draw' => $post['draw'],
            'recordsTotal' => count($contractors),
            'recordsFiltered' => count($data),
            'data' => array_slice($data, $start, $limit)
        ];

        echo json_encode($result);
    }

    public function add()
    {
        $data = [
            'company_id' => logged('company_id'),
            'display_name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'contractor' => 1,
            'created_by' => logged('id'),
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $contractorId = $this->vendors_model->createVendor($data);

        if($contractorId) {
            $this->session->set_flashdata('success', "Contractor added successfully!");
        } else {
            $this->session->set_flashdata('error', "Please try again!");
        }

        redirect("accounting/contractors");
    }

    public function view($contractorId)
    {
        add_footer_js(array(
            "assets/js/accounting/payroll/view-contractor.js"
        ));

        $paymentsCount = 0;
        $checks = $this->vendors_model->get_vendor_check_transactions($contractorId);
        $expenses = $this->vendors_model->get_vendor_expense_transactions($contractorId);
        $bills = $this->vendors_model->get_vendor_bill_transactions($contractorId);

        $paymentsCount += count($checks);
        $paymentsCount += count($expenses);
        $paymentsCount += count($bills);

        $paymentsTotal = 0.00;
        if($checks && count($checks) > 0) {
            foreach($checks as $check) {
                $paymentsTotal += floatval($check->total_amount);
            }
        }
        if($expenses && count($expenses) > 0) {
            foreach($expenses as $expense) {
                $paymentsTotal += floatval($expense->amount);
            }
        }
        if($bills && count($bills) > 0) {
            foreach($bills as $bill) {
                $paymentsTotal += floatval($bill->total_amount);
            }
        }

        $this->page_data['paymentsTotal'] = number_format($paymentsTotal, 2, '.', ',');
        $this->page_data['paymentsCount'] = $paymentsCount;
        $this->page_data['contractorTypes'] = $this->vendors_model->get_contractor_types();
        // $this->page_data['contractor_details'] = $this->accounting_contractors_model->get_contractor_details($contractorId);
        $this->page_data['contractor'] = $this->vendors_model->get_contractor($contractorId);
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['page_title'] = "Contractors";
        $this->load->view('accounting/contractors/view', $this->page_data);
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
            'email' => $this->input->post('email'),
            'company' => $this->input->post('contractor_type') === "2" ? $this->input->post('business_name') : null,
            'display_name' => $this->input->post('display_name'),
            'street' => $this->input->post('address'),
            'city' => $this->input->post('city'),
            'state' => $this->input->post('state'),
            'zip' => $this->input->post('zip_code'),
            'tax_id' => $this->input->post('contractor_type') === "1" ? $this->input->post('social_sec_num') : $this->input->post('emp_id_num'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $update = $this->vendors_model->update_contractor($contractorId, $basicDetails);

        if($update) {
            $this->session->set_flashdata('success', "Contractor details updated successfully!");
        } else {
            $this->session->set_flashdata('error', "Unexpected error, please try again!");
        }

        redirect("accounting/contractors/view/$contractorId");
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

        redirect("accounting/contractors/view/$contractorId");
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
}