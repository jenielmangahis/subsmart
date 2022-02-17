<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employees extends MY_Controller {
	
	public function __construct()
    {
		parent::__construct();
        $this->checkLogin();
        $this->load->model('PayScale_model');
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

        add_css(array(
            "assets/css/accounting/banking.css?v=".rand(),
            "assets/css/accounting/accounting.css",
            "assets/css/accounting/accounting.modal.css",
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
            "assets/js/accounting/payroll/employees.js"
        ));

        $this->page_data['commission_pays'] = $this->users_model->getPayDetailsByPayType('commission');
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->load->view('accounting/employees/index', $this->page_data);
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
                "0",
                "2",
                "3",
                "4",
                "5"
            ];
        } else {
            $status = [
                "0",
                "1",
                "2",
                "3",
                "4",
                "5"
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

                $empPayDetails = $this->users_model->getEmployeePayDetails($employee->id);
                if($empPayDetails) {
                    $payMethod = $empPayDetails->pay_method === 'direct-deposit' ? 'Direct deposit' : 'Check';

                    if($empPayDetails->pay_type === 'hourly') {
                        $payRate = '$'.number_format(floatval($empPayDetails->pay_rate), 2, '.', ',').'/hour';
                    } else if($empPayDetails->pay_type === 'salary') {
                        $payRate = '$'.number_format(floatval($empPayDetails->pay_rate), 2, '.', ',').'/'.$empPayDetails->salary_frequency;
                    } else {
                        $payRate = 'Commission only';
                    }
                } else {
                    $payMethod = 'Missing';
                    $payRate = 'Missing';
                }

                if($search !== "") {
                    if(stripos($employee->LName, $search) !== false || stripos($employee->FName, $search) !== false) {
                        $data[] = [
                            'id' => $employee->id,
                            'name' => "$employee->LName, $employee->FName",
                            'pay_rate' => $payRate,
                            'pay_method' => $payMethod,
                            'status' => $empStatus,
                            'email_address' => $employee->email,
                            'phone_number' => $employee->phone
                        ];
                    }
                } else {
                    $data[] = [
                        'id' => $employee->id,
                        'name' => "$employee->LName, $employee->FName",
                        'pay_rate' => $payRate,
                        'pay_method' => $payMethod,
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

    public function add()
    {
        $role_id = logged('role');
		if( $role_id == 1 || $role_id == 2 ){
			$this->page_data['payscale'] = $this->PayScale_model->getAll();
		}else{
			$this->page_data['payscale'] = $this->PayScale_model->getAllByCompanyId($cid);
		}

        $usedPaySched = $this->users_model->getPayScheduleUsed();
        $nextPayDate = $this->get_next_pay_date($usedPaySched);

        $this->page_data['nextPayDate'] = $nextPayDate;
        $this->page_data['pay_schedules'] = $this->users_model->getPaySchedules();
        $this->load->view('accounting/employees/add_employee', $this->page_data);
    }

    private function get_next_pay_date($paySched)
    {
        switch($paySched->pay_frequency) {
            case 'every-week' :
                $day = date('l', strtotime($paySched->next_payday));
                $nextPayday = date('m/d/Y', strtotime(strtolower($day)));
            break;
            case 'every-other-week' :
                $date = date('m/d/Y', strtotime($paySched->next_payday));

                if(strtotime($date) <= strtotime(date("m/d/Y"))) {
                    do {
                        $payDate = strtotime($date." +14 days");
                        $date = date('m/d/Y', $payDate);
                    } while($payDate <= strtotime(date("m/d/Y")));
                }

                $nextPayday = $date;
            break;
            case 'twice-month' :
                $currentMonth = date("m");
                $currentYear = date("Y");
                $firstPayday = $paySched->first_payday === '0' ? cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear) : $paySched->first_payday;
                $secondPayday = $paySched->second_payday === '0' ? cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear) : $paySched->second_payday;

                if(strtotime(date("$currentMonth/$firstPayday/$currentYear")) < strtotime(date("m/d/Y"))) {
                    $nextPayday = date("m/$secondPayday/Y");
                } else {
                    $nextPayday = date("m/$firstPayday/Y");
                }
            break;
            case 'every-month' :
                $currentMonth = date("m");
                $currentYear = date("Y");
                $firstPayday = $paySched->first_payday === '0' ? cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear) : $paySched->first_payday;

                if(strtotime(date("$currentMonth/$firstPayday/$currentYear")) < strtotime(date("m/d/Y"))) {
                    $nextPayday = date("m/d/Y", strtotime(date("m/$firstPayday/Y")." +1 month"));
                } else {
                    $nextPayday = date("m/$firstPayday/Y");
                }
            break;
        }

        return $nextPayday;
    }

    public function create()
    {
        $data = [
            'FName' => $this->input->post('first_name'),
            'LName' => $this->input->post('last_name'),
            'username' => $this->input->post('email'),
            'email' => $this->input->post('email'),
            'password' => hash("sha256",$this->input->post('password')),
            'password_plain' => $this->input->post('password'),
            'role' => $this->input->post('title'),
            'user_type' => $this->input->post('user_type'),
            'status' => $this->input->post('status'),
            'company_id' => logged('company_id'),
            'profile_img' => $this->input->post('profile_photo'),
            'address' => $this->input->post('address'),
            'state' => $this->input->post('state'),
            'city' => $this->input->post('city'),
            'postal_code' => $this->input->post('zip_code'),
            'payscale_id' => $this->input->post('payscale'),
            'employee_number' => $this->input->post('employee_number'),
            'date_hired' => date('Y-m-d', strtotime($this->input->post('hire_date')))
        ];

        $last_id = $this->users_model->addNewEmployee($data);

        if($last_id) {
            $payDetails = [
                'user_id' => $last_id,
                'company_id' => logged('company_id'),
                'pay_schedule_id' => $this->input->post('pay_schedule'),
                'pay_type' => $this->input->post('pay_type'),
                'pay_rate' => $this->input->post('pay_type') !== 'commission' ? $this->input->post('pay_rate') : null,
                'hours_per_day' => $this->input->post('pay_type') !== 'commission' ? $this->input->post('default_hours') : null,
                'days_per_week' => $this->input->post('pay_type') !== 'commission' ? $this->input->post('days_per_week') : null,
                'salary_frequency' => $this->input->post('pay_type') === 'salary' ? $this->input->post('salary_frequency') : null,
                'pay_method' => $this->input->post('pay_method'),
                'status' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ];
            $this->users_model->insertEmployeePayDetails($payDetails);
    
            $this->load->model('TimesheetTeamMember_model');
            $this->TimesheetTeamMember_model->create([
                'user_id' => $last_id,
                'name' => $data['FName'] . ' ' . $data['LName'],
                'email' => $data['username'],
                'role' => 'Employee',
                'department_id' => 0,
                'department_role' => 'Member',
                'will_track_location' => 1,
                'status' => 1,
                'company_id' => $data['company_id']
            ]);
            //End Timesheet		
    
            //Create Trac360 record
            $this->load->model('Trac360_model');
            $data = [
                'user_id' => $last_id,
                'name' => $data['FName'] . ' ' . $data['LName'],
                'company_id' => $data['company_id']
            ];
            $this->Trac360_model->add('trac360_people', $data);

            $this->session->set_flashdata('success', "New Employee Added!");
        } else {
            $this->session->set_flashdata('error', "Please try again!");
        }

        redirect('/accounting/employees');
    }

    public function edit($id)
    {
        $role_id = logged('role');
		if( $role_id == 1 || $role_id == 2 ){
			$this->page_data['payscale'] = $this->PayScale_model->getAll();
		}else{
			$this->page_data['payscale'] = $this->PayScale_model->getAllByCompanyId($cid);
		}

        $employee = $this->users_model->getUser($id);
        $payDetails = $this->users_model->getEmployeePayDetails($employee->id);
        $userPaySched = $this->users_model->getPaySchedule($payDetails->pay_schedule_id);
        $nextPayDate = $this->get_next_pay_date($userPaySched);

        $this->page_data['nextPayDate'] = $nextPayDate;
        $this->page_data['pay_schedules'] = $this->users_model->getPaySchedules();
        $this->page_data['employee'] = $employee;
        $this->page_data['payDetails'] = $payDetails;
        $this->load->view('accounting/employees/edit_employee', $this->page_data);
    }

    public function update($id)
    {
        $data = [
            'FName' => $this->input->post('first_name'),
            'LName' => $this->input->post('last_name'),
            'username' => $this->input->post('username'),
            'email' => $this->input->post('email'),
            'role' => $this->input->post('title'),
            'user_type' => $this->input->post('user_type'),
            'status' => $this->input->post('status'),
            'profile_img' => $this->input->post('profile_photo'),
            'address' => $this->input->post('address'),
            'state' => $this->input->post('state'),
            'city' => $this->input->post('city'),
            'postal_code' => $this->input->post('zip_code'),
            'payscale_id' => $this->input->post('payscale'),
            'employee_number' => $this->input->post('employee_number'),
            'date_hired' => date('Y-m-d', strtotime($this->input->post('hire_date')))
        ];

        $user = $this->users_model->update($id,$data);

        if($user) {
            $payDetails = [
                'pay_schedule_id' => $this->input->post('pay_schedule'),
                'pay_type' => $this->input->post('pay_type'),
                'pay_rate' => $this->input->post('pay_type') !== 'commission' ? $this->input->post('pay_rate') : null,
                'hours_per_day' => $this->input->post('pay_type') !== 'commission' ? $this->input->post('default_hours') : null,
                'days_per_week' => $this->input->post('pay_type') !== 'commission' ? $this->input->post('days_per_week') : null,
                'salary_frequency' => $this->input->post('pay_type') === 'salary' ? $this->input->post('salary_frequency') : null,
                'pay_method' => $this->input->post('pay_method'),
                'updated_at' => date("Y-m-d H:i:s")
            ];

            if($this->users_model->getEmployeePayDetails($id)) {
                $this->users_model->updateEmployeePayDetails($id, $payDetails);
            } else {
                $payDetails['company_id'] = logged('company_id');
                $payDetails['user_id'] = $id;
                $payDetails['status'] = 1;
                $payDetails['created_at'] = $payDetails['updated_at'];

                $this->users_model->insertEmployeePayDetails($payDetails);
            }

            $this->session->set_flashdata('success', "Employee details updated successfully.");
        } else {
            $this->session->set_flashdata('error', "Please try again!");
        }

        redirect('/accounting/employees');
    }

    public function delete($id)
    {
        ifPermissions('users_delete');

		if($id!==1 && $id!=logged($id)){ }else{
			redirect('/accounting/employees','refresh');

			return;
		}

		$user = $this->users_model->delete($id);
        $this->users_model->deleteEmployeePayDetails($id);

		//Delete Timesheet 
		$this->load->model('TimesheetTeamMember_model');
		$this->TimesheetTeamMember_model->deleteByUserId($id);
		//Delete Tract360
		$this->load->model('Trac360_model');
		$this->Trac360_model->deleteUser('trac360_people', $id);

		$this->activity_model->add("User #$id Deleted by User:".logged('name'));

		$this->session->set_flashdata('success', 'Employee record has been deleted successfully.');

		redirect('/accounting/employees');
    }

    public function set_status($id, $status)
    {
        switch ($status) {
            case 'terminated' :
                $empStatus = 0;
            break;
            case 'paid-leave' : 
                $empStatus = 2;
            break;
            case 'unpaid-leave' : 
                $empStatus = 3;
            break;
            case 'not-on-payroll' : 
                $empStatus = 4;
            break;
            case 'deceased' : 
                $empStatus = 5;
            break;
            default : 
                $empStatus = 1;
            break;
        }

        $data = [
            'status' => $empStatus
        ];

        $update = $this->users_model->update($id,$data);

        if($update) {
            $this->session->set_flashdata('success', "Employee status successfully set to $status.");
        } else {
            $this->session->set_flashdata('error', "Please try again!");
        }

        redirect('/accounting/employees');
    }

    public function pay_schedule_form()
    { 
        $this->page_data['nextPayPeriodEnd'] = date('m/d/Y', strtotime("wednesday"));
        $this->page_data['nextPayday'] = date('m/d/Y', strtotime("friday"));
        $this->load->view('accounting/employees/add_pay_schedule', $this->page_data);
    }

    public function add_pay_schedule()
    {
        $post = $this->input->post();

        if(in_array($post['pay_frequency'], ['every-week', 'every-other-week'])) {
            $data = $this->set_weekly_pay_data($post);
        } else {
            if($post['custom_schedule'] === 'on') {
                if($post['pay_frequency'] === 'every-month') {
                    $data = $this->set_custom_monthly_schedule($post);
                } else {
                    $data = $this->set_custom_twice_month_schedule($post);
                }
            } else {
                if($post['pay_frequency'] === 'every-month') {
                    $data = $this->set_monthly_schedule($post);
                } else {
                    $data = $this->set_twice_month_schedule($post);
                }
            }
        }

        $data['company_id'] = logged('company_id');
        $data['use_for_new_employees'] = !isset($post['use_for_new_employees']) ? 0 : 1;
        $data['status'] = 1;
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');

        if($data['use_for_new_employees'] === 1) {
            $usedPaySched = $this->users_model->getPayScheduleUsed();
            $this->users_model->updateUsedForNewEmp($usedPaySched->id, 0);
        }

        $insert = $this->users_model->addPaySchedule($data);

        $return = [
            'id' => $insert,
            'name' => $data['name'],
            'success' => $insert ? true : false,
            'message' => $insert ? 'Success!' : 'Error!'
        ];

        echo json_encode($return);
    }

    private function set_weekly_pay_data($post)
    {
        $nextPayDay = date('Y-m-d', strtotime($post['next_payday']));
        $nextPayPeriodEnd = date('Y-m-d', strtotime($post['next_pay_period_end']));

        $data = [
            'pay_frequency' => $post['pay_frequency'],
            'next_payday' => $nextPayDay,
            'next_pay_period_end' => $nextPayPeriodEnd,
            'name' => $post['name'],
        ];

        return $data;
    }

    private function set_custom_monthly_schedule($post)
    {
        $data = [
            'pay_frequency' => $post['pay_frequency'],
            'name' => $post['name'],
            'first_payday' => $post['first_payday'],
            'end_of_first_pay_period' => $post['end_of_first_pay_period'],
            'first_pay_month' => $post['first_pay_month'],
            'first_pay_day' => $post['first_pay_day'],
            'first_pay_days_before' => $post['end_of_first_pay_period'] !== 'end-date' ? $post['first_pay_days_before'] : null,
        ];

        return $data;
    }

    private function set_custom_twice_month_schedule($post)
    {
        $data = [
            'pay_frequency' => $post['pay_frequency'],
            'name' => $post['name'],
            'first_payday' => $post['first_payday'],
            'end_of_first_pay_period' => $post['end_of_first_pay_period'],
            'first_pay_month' => $post['end_of_first_pay_period'] === 'end-date' ? $post['first_pay_month'] : null,
            'first_pay_day' => $post['end_of_first_pay_period'] === 'end-date' ? $post['first_pay_day'] : null,
            'first_pay_days_before' => $post['end_of_first_pay_period'] !== 'end-date' ? $post['first_pay_days_before'] : null,
            'second_payday' => $post['second_payday'],
            'end_of_second_pay_period' => $post['end_of_second_pay_period'],
            'second_pay_month' => $post['end_of_second_pay_period'] === 'end-date' ? $post['second_pay_month'] : null,
            'second_pay_day' => $post['end_of_second_pay_period'] === 'end-date' ? $post['second_pay_day'] : null,
            'second_pay_days_before' => $post['end_of_second_pay_period'] !== 'end-date' ? $post['second_pay_days_before'] : null,
        ];

        return $data;
    }

    public function set_monthly_schedule($post)
    {
        $nextPayDay = date('Y-m-d', strtotime($post['next_payday']));
        $nextPayDayMonth = intval(date('m', strtotime($nextPayDay)));
        $nextPayDayYear = intval(date('Y', strtotime($nextPayDay)));
        $nextPayDayDate = intval(date('d', strtotime($nextPayDay)));

        $nextPayPeriodEnd = date('Y-m-d', strtotime($post['next_pay_period_end']));
        $nextPayPeriodEndMonth = intval(date('m', strtotime($nextPayPeriodEnd)));
        $nextPayPeriodEndYear = intval(date('Y', strtotime($nextPayDay)));
        $nextPayPeriodEndDate = intval(date('d', strtotime($nextPayDay)));

        if($nextPayDayDate === cal_days_in_month(CAL_GREGORIAN, $nextPayDayMonth, $nextPayDayYear)) {
            $firstPayDay = 0;
        } else {
            $firstPayDay = $nextPayDayDate;
        }

        if($nextPayPeriodEndDate === cal_days_in_month(CAL_GREGORIAN, $nextPayPeriodEndMonth, $nextPayPeriodEndYear)) {
            $firstPayDate = 0;
        } else {
            $firstPayDate = $nextPayPeriodEndDate;
        }

        if($nextPayDayMonth === $nextPayPeriodEndMonth) {
            $firstPayMonth = 'same';
        } else if($nextPayDayMonth > $nextPayPeriodEndMonth) {
            $firstPayMonth = 'previous';
        } else if($nextPayDayMonth < $nextPayPeriodEndMonth) {
            $firstPayMonth = 'next';
        }

        $firstPayDaysBefore = null;

        $data = [
            'pay_frequency' => $post['pay_frequency'],
            'name' => $post['name'],
            'first_payday' => $firstPayDay,
            'end_of_first_pay_period' => 'end-date',
            'first_pay_month' => $firstPayMonth,
            'first_pay_day' => $firstPayDate,
            'first_pay_days_before' => $post['end_of_first_pay_period'] !== 'end-date' ? $post['first_pay_days_before'] : null,
        ];

        return $data;
    }

    public function set_twice_month_schedule($post)
    {
        $nextPayDay = date('Y-m-d', strtotime($post['next_payday']));
        $nextPayDayMonth = intval(date('m', strtotime($nextPayDay)));
        $nextPayDayYear = intval(date('Y', strtotime($nextPayDay)));
        $nextPayDayDate = intval(date('d', strtotime($nextPayDay)));

        $nextPayPeriodEnd = date('Y-m-d', strtotime($post['next_pay_period_end']));
        $nextPayPeriodEndMonth = intval(date('m', strtotime($nextPayPeriodEnd)));
        $nextPayPeriodEndYear = intval(date('Y', strtotime($nextPayDay)));
        $nextPayPeriodEndDate = intval(date('d', strtotime($nextPayDay)));

        if(intval(date('m', strtotime($nextPayDay.' -15 days'))) < $nextPayDayMonth) {
            $firstPayDay = $nextPayDayDate;
            if($nextPayDayMonth === $nextPayPeriodEndMonth) {
                $firstPayMonth = 'same';
            } else if($nextPayDayMonth > $nextPayPeriodEndMonth) {
                $firstPayMonth = 'previous';
            } else if($nextPayDayMonth < $nextPayPeriodEndMonth) {
                $firstPayMonth = 'next';
            }

            if($nextPayPeriodEndDate === cal_days_in_month(CAL_GREGORIAN, $nextPayPeriodEndMonth, $nextPayPeriodEndYear)) {
                $firstPayDate = 0;
            } else {
                $firstPayDate = $nextPayPeriodEndDate;
            }

            $secondPayDay = date('Y-m-d', strtotime($nextPayDay.' +15 days'));
            $secondPayDayMonth = intval(date('m', strtotime($secondPayDay)));
            $secondPayDayYear = intval(date('Y', strtotime($secondPayDay)));
            $secondPayDayDate = intval(date('d', strtotime($secondPayDay)));

            $secondPayPeriodEnd = date('Y-m-d', strtotime($nextPayPeriodEnd.' +15 days'));
            $secondPayPeriodEndMonth = intval(date('m', strtotime($secondPayPeriodEnd)));
            $secondPayPeriodEndYear = intval(date('Y', strtotime($secondPayPeriodEnd)));
            $secondPayPeriodEndDate = intval(date('d', strtotime($secondPayPeriodEnd)));

            if($secondPayDayMonth === $secondPayPeriodEndMonth) {
                $secondPayMonth = 'same';
            } else if($secondPayDayMonth > $secondPayPeriodEndMonth) {
                $secondPayMonth = 'previous';
            } else if($secondPayDayMonth < $secondPayPeriodEndMonth) {
                $secondPayMonth = 'next';
            }

            $secondPayDate = $secondPayPeriodEndDate;
        } else {
            if($nextPayDayDate === cal_days_in_month(CAL_GREGORIAN, $nextPayDayMonth, $nextPayDayYear)) {
                $firstPayDate = date('Y-m-d', strtotime("$nextPayDayMonth/15/$nextPayDayYear"));

                $secondPayDayDate = 0;
            } else {
                $firstPayDay = $nextPayDayDate - 15;
                $firstPayDate = date('Y-m-d', strtotime("$nextPayDayMonth/$firstPayDay/$nextPayDayYear"));

                $secondPayDayDate = $nextPayDayDate;
            }

            $firstPayDateMonth = intval(date('m', strtotime($firstPayDate)));
            $firstPayDateYear = intval(date('Y', strtotime($firstPayDate)));
            $firstPayDay = intval(date('d', strtotime($firstPayDate)));

            $firstPayPeriodEnd = date('Y-m-d', strtotime($nextPayPeriodEnd.' -15 days'));
            $firstPayPeriodEndMonth = intval(date('m', strtotime($firstPayPeriodEnd)));
            $firstPayPeriodEndYear = intval(date('Y', strtotime($firstPayPeriodEnd)));
            $firstPayPeriodEndDate = intval(date('d', strtotime($firstPayPeriodEnd)));

            if($firstPayDateMonth === $firstPayPeriodEndMonth) {
                $firstPayMonth = 'same';
            } else if($firstPayDateMonth > $firstPayPeriodEndMonth) {
                $firstPayMonth = 'previous';
            } else if($firstPayDateMonth < $firstPayPeriodEndMonth) {
                $firstPayMonth = 'next';
            }

            if($firstPayPeriodEndDate === cal_days_in_month(CAL_GREGORIAN, $firstPayPeriodEndMonth, $firstPayPeriodEndYear)) {
                $firstPayDate = 0;
            } else {
                $firstPayDate = $firstPayPeriodEndDate;
            }

            if($nextPayDayMonth === $nextPayPeriodEndMonth) {
                $secondPayMonth = 'same';
            } else if($nextPayDayMonth > $nextPayPeriodEndMonth) {
                $secondPayMonth = 'previous';
            } else if($nextPayDayMonth < $nextPayPeriodEndMonth) {
                $secondPayMonth = 'next';
            }

            if($nextPayPeriodEndDate === cal_days_in_month(CAL_GREGORIAN, $nextPayPeriodEndMonth, $nextPayPeriodEndYear)) {
                $secondPayDate = 0;
            } else {
                $secondPayDate = $nextPayPeriodEndDate;
            }
        }

        $data = [
            'pay_frequency' => $post['pay_frequency'],
            'name' => $post['name'],
            'first_payday' => $firstPayDay,
            'end_of_first_pay_period' => 'end-date',
            'first_pay_month' => $firstPayMonth,
            'first_pay_day' => $firstPayDate,
            'first_pay_days_before' => null,
            'second_payday' => $secondPayDayDate,
            'end_of_second_pay_period' => 'end-date',
            'second_pay_month' => $secondPayMonth,
            'second_pay_day' => $secondPayDate,
            'second_pay_days_before' => null,
        ];

        return $data;
    }

    public function edit_pay_schedule($id)
    {
        $this->page_data['paySchedule'] = $this->users_model->getPaySchedule($id);
        $this->load->view('accounting/employees/edit_pay_schedule', $this->page_data);
    }

    public function update_pay_schedule($id)
    {
        $post = $this->input->post();

        if(in_array($post['pay_frequency'], ['every-week', 'every-other-week'])) {
            $nextPayDay = date('Y-m-d', strtotime($post['next_payday']));
            $nextPayPeriodEnd = date('Y-m-d', strtotime($post['next_pay_period_end']));
        } 
        else {
            if($post['custom_schedule'] === 'on') {
                $nextPayDay = null;
                $nextPayPeriodEnd = null;
            } else {
                $nextPayDay = date('Y-m-d', strtotime($post['next_payday']));
                $nextPayPeriodEnd = date('Y-m-d', strtotime($post['next_pay_period_end']));
            }
        }

        if($post['pay_frequency'] !== 'twice-month') {
            $post['second_payday'] = null;
            $post['end_of_second_pay_period'] = null;
            $post['second_pay_month'] = null;
            $post['second_pay_day'] = null;
            $post['second_pay_days_before'] = null;
        }

        $data = [
            'pay_frequency' => $post['pay_frequency'],
            'next_payday' => $nextPayDay,
            'next_pay_period_end' => $nextPayPeriodEnd,
            'name' => $post['name'],
            'first_payday' => $post['custom_schedule'] === 'on' ? $post['first_payday'] : null,
            'end_of_first_pay_period' => $post['custom_schedule'] === 'on' ? $post['end_of_first_pay_period'] : null,
            'first_pay_month' => $post['custom_schedule'] === 'on' && $post['end_of_first_pay_period'] === 'end-date' ? $post['first_pay_month'] : null,
            'first_pay_day' => $post['custom_schedule'] === 'on' && $post['end_of_first_pay_period'] === 'end-date' ? $post['first_pay_day'] : null,
            'first_pay_days_before' => $post['custom_schedule'] === 'on' && $post['end_of_first_pay_period'] !== 'end-date' ? $post['first_pay_days_before'] : null,
            'second_payday' => $post['second_payday'],
            'end_of_second_pay_period' => $post['end_of_second_pay_period'],
            'second_pay_month' => $post['second_pay_month'],
            'second_pay_day' => $post['second_pay_day'],
            'second_pay_days_before' => $post['second_pay_days_before'],
            'use_for_new_employees' => $post['use_for_new_employees'],
            'updated_at' => date('Y-m-d H:i:s')
        ];

        if($data['use_for_new_employees'] === "1") {
            $usedPaySched = $this->users_model->getPayScheduleUsed();
            $this->users_model->updateUsedForNewEmp($usedPaySched->id, 0);
        }

        $insert = $this->users_model->updatePaySchedule($id, $data);

        $return = [
            'id' => $id,
            'name' => $data['name'],
            'success' => $insert ? true : false,
            'message' => $insert ? 'Success!' : 'Error!'
        ];

        echo json_encode($return);
    }

    public function get_pay_date($id)
    {
        $paySched = $this->users_model->getPaySchedule($id);
        $payDate = $this->get_next_pay_date($paySched);

        echo json_encode(['date' => $payDate]);
    }

    public function commission_only_modal()
    {
        $accounts = $this->chart_of_accounts_model->select();
        $accounts = array_filter($accounts, function($v, $k) {
            return $v->account_id === 3 || $v->account_id === "3";
        }, ARRAY_FILTER_USE_BOTH);
        $this->page_data['accounts'] = $accounts;
        $this->page_data['payDetails'] = $this->users_model->getPayDetailsByPayType('commission');;
        $this->load->view('accounting/employees/commission_only_payroll', $this->page_data);
    }

    public function generate_commission_payroll()
    {
        $postData = $this->input->post();
        $socialSecurity = 6.2;
        $medicare = 1.45;
        $futa = 0.006;
        $sui = 0.00;

        $this->page_data['payPeriod'] = $postData['pay_date'].' to '.$postData['pay_date'];
        $this->page_data['payDate'] = date('m/d/Y', strtotime($postData['pay_date']));

        $employees = [];
        foreach($postData['select'] as $key => $empId) {
            $emp = $this->users_model->getUser($empId);
            $empPayDetails = $this->users_model->getEmployeePayDetails($emp->id);

            $empTotalPay = (float)$postData['commission'][$key];
            $empTotalPay = number_format($empTotalPay, 2, '.', ',');

            $empSocial = ($empTotalPay / 100) * $socialSecurity;
            $empSocial = number_format($empSocial, 2, '.', ',');
            $empMedicare = ($empTotalPay / 100) * $medicare;
            $empMedicare = number_format($empMedicare, 2, '.', ',');
            $empTax = number_format($empSocial + $empMedicare, 2, '.', ',');
            $employeeSUI = ($empTotalPay / 100) * $sui;
            $employeeSUI = number_format($employeeSUI, 2, '.', ',');

            $netPay = $empTotalPay - $empTax;

            $employees[] = [
                'id' => $emp->id,
                'name' => $emp->LName . ', ' . $emp->FName,
                'pay_method' => $empPayDetails->pay_method === 'direct-deposit' ? 'Direct deposit' : 'Paper check',
                'total_pay' => $empTotalPay,
                'employee_tax' => $empTax,
                'net_pay' => number_format($netPay, 2, '.', ','),
                'employee_futa' => number_format($empTotalPay * $futa, 2, '.', ','),
                'employee_sui' => $employeeSUI
            ];
        }

        $totalPay = array_sum(array_column($employees, 'total_pay'));
        $totalPay = number_format($totalPay, 2, '.', ',');
        $totalTaxes = array_sum(array_column($employees, 'employee_tax'));
        $totalTaxes = number_format($totalTaxes, 2, '.', ',');
        $totalNetPay = array_sum(array_column($employees, 'net_pay'));
        $totalNetPay = number_format($totalNetPay, 2, '.', ',');
        $totalFuta = array_sum(array_column($employees, 'employee_futa'));
        $totalFuta = number_format($totalFuta, 2, '.', ',');
        $totalSUI = array_sum(array_column($employees, 'employee_sui'));
        $totalSUI = number_format($totalSUI, 2, '.', ',');

        $totalEmployerTax = $totalTaxes + $totalFuta + $totalSUI;

        $totalPayrollCost = $totalNetPay + $totalTaxes + $totalEmployerTax;

        $this->page_data['employees'] = $employees;
        $this->page_data['total'] = [
            'total_pay' => $totalPay,
            'total_taxes' => $totalTaxes,
            'total_net_pay' => $totalNetPay,
            'total_employer_tax' => number_format($totalEmployerTax, 2, '.', ','),
            'total_payroll_cost' => number_format($totalPayrollCost, 2, '.', ',')
        ];

        $this->load->view('accounting/employees/commission_payroll_summary', $this->page_data);
    }

    public function get_employee_pay_details($user_id)
    {
        $empPayDetails = $this->users_model->getEmployeePayDetails($user_id);

        echo json_encode($empPayDetails);
    }

    public function bonus_only_modal()
    {
        $this->load->view('accounting/employees/bonus_only_payroll');
    }

    public function bonus_only_form($bonusPayType)
    {
        $accounts = $this->chart_of_accounts_model->select();
        $accounts = array_filter($accounts, function($v, $k) {
            return $v->account_id === 3 || $v->account_id === "3";
        }, ARRAY_FILTER_USE_BOTH);
        $this->page_data['bonusPayType'] = $bonusPayType;
        $this->page_data['accounts'] = $accounts;
        $this->page_data['payDetails'] = $this->users_model->getActiveEmployeePayDetails();
        $this->load->view('accounting/employees/bonus_only_payroll_form', $this->page_data);
    }

    public function generate_bonus_payroll($bonusPayType)
    {
        $postData = $this->input->post();
        $socialSecurity = $bonusPayType === 'gross-pay' ? 6.200000000000001 : 6.7333333333333325;
        $medicare = $bonusPayType === 'gross-pay' ? 1.4000000000000001 : 1.5333333333333334;
        $futa = 0.006;
        $sui = 0.00;

        $this->page_data['payPeriod'] = $postData['pay_date'].' to '.$postData['pay_date'];
        $this->page_data['payDate'] = date('m/d/Y', strtotime($postData['pay_date']));

        $employees = [];
        foreach($postData['select'] as $key => $empId) {
            $emp = $this->users_model->getUser($empId);
            $empPayDetails = $this->users_model->getEmployeePayDetails($emp->id);

            $empTotalPay = (float)$postData['bonus'][$key];
            $empTotalPay = number_format($empTotalPay, 2, '.', ',');

            $empSocial = ($empTotalPay / 100) * $socialSecurity;
            $empSocial = number_format($empSocial, 2, '.', ',');
            $empMedicare = ($empTotalPay / 100) * $medicare;
            $empMedicare = number_format($empMedicare, 2, '.', ',');
            $empTax = number_format($empSocial + $empMedicare, 2, '.', ',');
            $employeeSUI = ($empTotalPay / 100) * $sui;
            $employeeSUI = number_format($employeeSUI, 2, '.', ',');

            if($bonusPayType === 'net-pay') {
                $empTotalPay = $empTotalPay + $empTax;
            }

            $netPay = $empTotalPay - $empTax;

            $employees[] = [
                'id' => $emp->id,
                'name' => $emp->LName . ', ' . $emp->FName,
                'pay_method' => $empPayDetails->pay_method === 'direct-deposit' ? 'Direct deposit' : 'Paper check',
                'total_pay' => $empTotalPay,
                'employee_tax' => $empTax,
                'net_pay' => number_format($netPay, 2, '.', ','),
                'employee_futa' => number_format($empTotalPay * $futa, 2, '.', ','),
                'employee_sui' => $employeeSUI
            ];
        }

        $totalPay = array_sum(array_column($employees, 'total_pay'));
        $totalPay = number_format($totalPay, 2, '.', ',');
        $totalTaxes = array_sum(array_column($employees, 'employee_tax'));
        $totalTaxes = number_format($totalTaxes, 2, '.', ',');
        $totalNetPay = array_sum(array_column($employees, 'net_pay'));
        $totalNetPay = number_format($totalNetPay, 2, '.', ',');
        $totalFuta = array_sum(array_column($employees, 'employee_futa'));
        $totalFuta = number_format($totalFuta, 2, '.', ',');
        $totalSUI = array_sum(array_column($employees, 'employee_sui'));
        $totalSUI = number_format($totalSUI, 2, '.', ',');

        $totalEmployerTax = $totalTaxes + $totalFuta + $totalSUI;

        $totalPayrollCost = $totalNetPay + $totalTaxes + $totalEmployerTax;

        $this->page_data['employees'] = $employees;
        $this->page_data['total'] = [
            'total_pay' => $totalPay,
            'total_taxes' => $totalTaxes,
            'total_net_pay' => $totalNetPay,
            'total_employer_tax' => number_format($totalEmployerTax, 2, '.', ','),
            'total_payroll_cost' => number_format($totalPayrollCost, 2, '.', ',')
        ];

        $this->load->view('accounting/employees/bonus_payroll_summary', $this->page_data);
    }
}