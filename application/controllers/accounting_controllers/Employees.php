<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employees extends MY_Controller {
	
	public function __construct()
    {
		parent::__construct();
        $this->checkLogin();

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
            "assets/js/accounting/payroll/employees.js"
        ));
        // $this->page_data['employees'] = $this->users_model->getAll();
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->load->view('accounting/employees/index', $this->page_data);
        // $this->load->view('accounting/employees', $this->page_data);
    }

    public function load_employees()
    {
        $post = json_decode(file_get_contents('php://input'), true);
        $order = $post['order'][0]['dir'];
        $orderColumn = $post['order'][0]['column'];
        $columnName = $post['columns'][$orderColumn]['name'];
        $start = $post['start'];
        $limit = $post['length'];

        if($post['status'] === 'active') {
            $status = [
                "1"
            ];
        } else if($post['status'] === 'inactive') {
            $status = [
                "0"
            ];
        } else {
            $status = [
                "0",
                "1"
            ];
        }

        $employees = $this->users_model->getCompanyUsersWithFilter($status, $order, $orderColumn);

        $data = [];
        $search = $post['columns'][0]['search']['value'];

        if(count($employees) > 0) {
            foreach($employees as $employee) {
                switch ($employee->status) {
                    case '0' :
                        $empStatus = "Terminated";
                    break;
                    case '2' : 
                        $empStatus = "Paid leave of absence";
                    break;
                    case '3' : 
                        $empStatus = "Unpaid leave of absence";
                    break;
                    case '4' : 
                        $empStatus = "Not on payroll";
                    break;
                    case '5' : 
                        $empStatus = "Deceased";
                    break;
                    default : 
                        $empStatus = "Active";
                    break;
                }

                if($search !== "") {
                    if(stripos($employee->LName, $search) !== false || stripos($employee->FName, $search) !== false) {
                        $data[] = [
                            'id' => $employee->id,
                            'name' => "$employee->LName, $employee->FName",
                            'pay_rate' => $employee->pay_rate,
                            'pay_method' => '',
                            'status' => $empStatus,
                            'email_address' => $employee->email,
                            'phone_number' => $employee->phone
                        ];
                    }
                } else {
                    $data[] = [
                        'id' => $employee->id,
                        'name' => "$employee->LName, $employee->FName",
                        'pay_rate' => $employee->pay_rate,
                        'pay_method' => '',
                        'status' => $empStatus,
                        'email_address' => $employee->email,
                        'phone_number' => $employee->phone
                    ];
                }
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
            'draw' => $post['draw'],
            'recordsTotal' => count($employees),
            'recordsFiltered' => count($data),
            'data' => array_slice($data, $start, $limit)
        ];

        echo json_encode($result);
    }
}