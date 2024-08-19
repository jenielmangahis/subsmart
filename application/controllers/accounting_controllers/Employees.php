<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Employees extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->checkLogin();
        $this->load->model('PayScale_model');
        $this->load->model('accounting_customers_model');
        $this->load->model('accounting_invoices_model');

        $this->load->model('vendors_model');
        $this->load->model('AcsProfile_model');
        $this->load->model('invoice_model');
        $this->load->model('workorder_model');
        $this->load->model('estimate_model');
        $this->load->model('accounting_receive_payment_model');
        $this->load->model('accounting_sales_receipt_model');
        $this->load->model('accounting_credit_memo_model');
        $this->load->model('accounting_statements_model');
        $this->load->model('accounting_worksites_model');
        $this->load->model('deductions_and_contribution_model');
        $this->load->model('accounting_payroll_model');
        $this->load->model('EmployeeCommissionSetting_model');
        $this->load->model('CommissionSetting_model');
        $this->load->model('accounting_user_employment_details_model', 'employment_details_model');
        $this->load->model('accounting_paychecks_model');
        $this->load->model('General_model', 'general_model');

        $this->page_data['page']->title = 'Employees';
        $this->page_data['page']->parent = 'Payroll';

        add_css(array(
            // "assets/css/accounting/banking.css?v=".rand(),
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
            // "assets/js/accounting/accounting.js",
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
                array("", array('/accounting/payroll-overview', '/accounting/employees', 'accounting/paycheck_list', '/accounting/contractors', '/accounting/workers-comp', '#')),
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
            "assets/js/v2/accounting/payroll/employees/list.js"
        ));

        $accounts = $this->chart_of_accounts_model->select();
        $accounts = array_filter($accounts, function ($v, $k) {
            return $v->account_id === 3 || $v->account_id === "3";
        }, ARRAY_FILTER_USE_BOTH);
        $this->page_data['accounts'] = $accounts;
        $this->page_data['payDetails'] = $this->users_model->getPayDetailsByPayType('commission');

        $filters = [];
        switch (get('status')) {
            case 'all':
                $filters['status'] = [
                    "0",
                    "1",
                    "2",
                    "3",
                    "4",
                    "5"
                ];
                break;
            case 'inactive':
                $filters['status'] = [
                    "0",
                    "2",
                    "3",
                    "4",
                    "5"
                ];
                break;
            default:
                $filters['status'] = [
                    "1"
                ];
                break;
        }

        if (!empty(get('status'))) {
            $this->page_data['status'] = get('status');
        }

        if (!empty(get('search'))) {
            $this->page_data['search'] = get('search');
            $filters['search'] = get('search');
        }

        if (!empty(get('pay-method'))) {
            $this->page_data['pay_method'] = get('pay-method');
            $filters['pay-method'] = get('pay-method');
        }

        $role_id = logged('role');
        if ($role_id == 1 || $role_id == 2) {
            $this->page_data['payscale'] = $this->PayScale_model->getAll();
        } else {
            $this->page_data['payscale'] = $this->PayScale_model->getAllByCompanyId($cid);
        }

        $usedPaySched = $this->users_model->getPayScheduleUsed();
        $nextPayDate = $this->get_next_pay_date($usedPaySched);

        $cid   = logged('company_id');
        $roles = $this->users_model->getRoles($cid);
        $this->page_data['roles'] = $roles;
        $this->session->set_userdata('roles', $roles);
        $this->page_data['nextPayDate'] = $nextPayDate;
        $this->page_data['nextPayPeriodEnd'] = date('m/d/Y', strtotime("wednesday"));
        $this->page_data['nextPayday'] = date('m/d/Y', strtotime("friday"));
        $this->page_data['pay_schedules'] = $this->users_model->getPaySchedules();
        $this->page_data['employees'] = $this->get_employees($filters);
        $this->page_data['commission_pays'] = $this->users_model->getPayDetailsByPayType('commission');
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        // $this->load->view('accounting/employees/index', $this->page_data);
        $this->load->view('v2/pages/accounting/payroll/employees/list', $this->page_data);
    }

    private function get_employees($filters)
    {
        $employees = $this->users_model->getCompanyUsersWithFilter($filters['status']);

        $data = [];
        if (count($employees) > 0) {
            foreach ($employees as $employee) {
                if ($employee->status !== '0') {
                    $empStatus = "Active";
                } else {
                    $empStatus = "Inactive";
                }

                $empPayDetails = $this->users_model->getEmployeePayDetails($employee->id);
                if ($empPayDetails) {
                    $payMethod = $empPayDetails->pay_method === 'direct-deposit' ? 'Direct deposit' : 'Check';
                } else {
                    $payMethod = 'Missing';
                }

                $payRate = '$0.00/hour'; //'Missing';
                $payscale = $this->users_model->get_payscale_by_id($employee->payscale_id);

                if ($payscale->pay_type === 'Hourly') {
                    $payRate = str_replace('$-', '-$', '$' . number_format(floatval(str_replace(',', '', $employee->base_hourly)), 2, '.', ',')) . '/hour';

                    $totalPay = floatval(str_replace(',', '', $employee->base_hourly)) * $totalHrs;
                }

                if ($payscale->pay_type === 'Daily') {
                    $payRate = str_replace('$-', '-$', '$' . number_format(floatval(str_replace(',', '', $employee->base_daily)), 2, '.', ',')) . '/day';
                }

                if ($payscale->pay_type === 'Weekly') {
                    $payRate = str_replace('$-', '-$', '$' . number_format(floatval(str_replace(',', '', $employee->base_weekly)), 2, '.', ',')) . '/week';

                    $weeklyPay = floatval(str_replace(',', '', $employee->base_weekly));
                    $hoursPerWeek = 40.00;
                    $perHourPay = $weeklyPay / $hoursPerWeek;

                    $totalPay = $perHourPay * $totalHrs;
                }

                if ($payscale->pay_type === 'Monthly') {
                    $payRate = str_replace('$-', '-$', '$' . number_format(floatval(str_replace(',', '', $employee->base_monthly)), 2, '.', ',')) . '/month';

                    $monthlyPay = floatval(str_replace(',', '', $employee->base_monthly));
                    $hoursPerWeek = 40.00;
                    $hoursPerMonth = $hoursPerWeek * 4;
                    $perHourPay = $monthlyPay / $hoursPerMonth;

                    $totalPay = $perHourPay * $totalHrs;
                }

                if ($payscale->pay_type === 'Yearly') {
                    $payRate = str_replace('$-', '-$', '$' . number_format(floatval(str_replace(',', '', $employee->base_yearly)), 2, '.', ',')) . '/year';
                }

                if ($payscale->pay_type === 'Commission Only') {
                    $payRate = 'Commission only';
                }

                $commission = 0.00;
                $commissions = $this->accounting_payroll_model->get_employee_commissions($employee->id, date("Y-m-d"), date("Y-m-d"));
                foreach ($commissions as $comm) {
                    $commission += floatval(str_replace(',', '', $comm->commission_amount));
                }

                if (isset($filters['search']) && $filters['search'] !== "") {
                    if (stripos($employee->LName, $filters['search']) !== false || stripos($employee->FName, $filters['search']) !== false || stripos($employee->email, $filters['search']) !== false) {
                        $data[] = [
                            'id' => $employee->id,
                            'name' => "$employee->LName, $employee->FName",
                            'pay_rate' => $payRate,
                            'pay_method' => $payMethod,
                            'status' => $empStatus,
                            'email_address' => $employee->email,
                            'phone_number' => $employee->phone,
                            'commission' => $commission
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
                        'phone_number' => $employee->phone,
                        'commission' => $commission
                    ];
                }
            }
        }

        if (!empty($filters['pay-method'])) {
            $data = array_filter($data, function ($v, $k) use ($filters) {
                return $v['pay_method'] === str_replace('-', ' ', ucfirst($filters['pay-method']));
            }, ARRAY_FILTER_USE_BOTH);
        }

        usort($data, function ($a, $b) {
            return strcmp($a['name'], $b['name']);
        });

        return $data;
    }

    public function view($id)
    {
        $this->load->model('LeaveType_model');
        $this->load->model('EmployeeLeaveCredit_model');
        $company_id = logged('company_id');
        $employee_id = logged('id');
        $user_type = logged('user_type');

        add_footer_js(array(
            "assets/js/v2/accounting/payroll/employees/view.js"
        ));

        $employee = $this->users_model->getUser($id);

        if ($employee->status !== '0') {
            $employee->status_text = "Active";
        } else {
            $employee->status_text = "Inactive";
        }

        $address = '';
        $address .= !in_array($employee->address, ['', null]) ? $employee->address . '<br>' : '';
        $address .= !in_array($employee->city, ['', null]) ? $employee->city . ', ' : '';
        $address .= !in_array($employee->state, ['', null]) ? $employee->state . ' ' : '';
        $address .= !in_array($employee->postal_code, ['', null]) ? $employee->postal_code : '';
        $employee->complete_address = $address;

        $empPayDetails = $this->users_model->getEmployeePayDetails($employee->id);
        if ($empPayDetails) {
            $employee->payment_method = $empPayDetails->pay_method === 'direct-deposit' ? 'Direct deposit' : 'Paper check';

            if ($empPayDetails->pay_type === 'hourly') {
                $employee->pay_rate = '$' . number_format(floatval($empPayDetails->pay_rate), 2, '.', ',') . '/hour';
            } else if ($empPayDetails->pay_type === 'salary') {
                $employee->pay_rate = '$' . number_format(floatval($empPayDetails->pay_rate), 2, '.', ',') . '/' . str_replace('per-', '', $empPayDetails->salary_frequency);
            } else {
                $employee->pay_rate = 'Commission only';
            }
        } else {
            $employee->payment_method = 'Missing';
        }

        $employee->pay_rate = 'Missing';
        $salary_rate = 0;
        $salary_type_label = '';
        $payscale = $this->users_model->get_payscale_by_id($employee->payscale_id);

        if ($payscale->pay_type === 'Hourly') {
            $employee->pay_rate = str_replace('$-', '-$', '$' . number_format(floatval(str_replace(',', '', $employee->base_hourly)), 2, '.', ',')) . '/hour';

            $salary_rate = $employee->base_hourly;
            $salary_type_label = 'Hourly Rate';
        }

        if ($payscale->pay_type === 'Daily') {
            $employee->pay_rate = str_replace('$-', '-$', '$' . number_format(floatval(str_replace(',', '', $employee->base_daily)), 2, '.', ',')) . '/day';

            $salary_rate = $employee->base_salary;
            $salary_type_label = 'Daily Rate';
        }

        if ($payscale->pay_type === 'Weekly') {
            $employee->pay_rate = str_replace('$-', '-$', '$' . number_format(floatval(str_replace(',', '', $employee->base_weekly)), 2, '.', ',')) . '/week';

            $salary_rate = $employee->base_weekly;
            $salary_type_label = 'Weekly Rate';
        }

        if ($payscale->pay_type === 'Monthly') {
            $employee->pay_rate = str_replace('$-', '-$', '$' . number_format(floatval(str_replace(',', '', $employee->base_monthly)), 2, '.', ',')) . '/month';

            $salary_rate = $employee->base_monthly;
            $salary_type_label = 'Monthly Rate';
        }

        if ($payscale->pay_type === 'Yearly') {
            $employee->pay_rate = str_replace('$-', '-$', '$' . number_format(floatval(str_replace(',', '', $employee->base_yearly)), 2, '.', ',')) . '/year';

            $salary_rate = $employee->base_yearly;
            $salary_type_label = 'Yearly Rate';
        }

        if ($payscale->pay_type === 'Commission Only') {
            $employee->pay_rate = 'Commission only';

            $salary_rate = 0;
            $salary_type_label = 'Commission Only';
        }

        $paySchedule = $this->users_model->getPaySchedule($empPayDetails->pay_schedule_id);
        $employee->pay_schedule = $paySchedule;

        $employee->title = ($employee->role) ? ucfirst($this->roles_model->getById($employee->role)->title) : '-';

        $this->page_data['salary_rate'] = $salary_rate;
        $this->page_data['salary_type_label'] = $salary_type_label;
        $this->page_data['employee'] = $employee;
        $this->page_data['pay_details'] = $empPayDetails;
        $this->page_data['pay_schedules'] = $this->users_model->getPaySchedules();

        $cid   = logged('company_id');
        $roles = $this->users_model->getRoles($cid);
        $this->page_data['roles'] = $roles;

        // $role_id = logged('role');
        // if( $role_id == 1 || $role_id == 2 ){
        // 	$this->page_data['payscale'] = $this->PayScale_model->getAll();
        // }else{
        $this->page_data['payscale'] = $this->PayScale_model->getAllByCompanyId($cid);
        // }

        $employmentDetails = $this->employment_details_model->get_all_employment_details($id);        
        $this->page_data['employmentDetails'] = $employmentDetails;
        $this->page_data['worksites'] = $this->accounting_worksites_model->get_company_worksites(logged('company_id'));

        $address = '';

        $usedPaySched = $this->users_model->getPayScheduleUsed();
        $nextPayDate = $this->get_next_pay_date($usedPaySched);

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

        $this->page_data['filter_from'] = $quarters[$quarter]['start'];
        $this->page_data['filter_to'] = $quarters[$quarter]['end'];

        $hasFilter = false;

        if (!empty(get('date'))) {
            $this->page_data['filter_date'] = get('date');
            $this->page_data['filter_from'] = str_replace('-', '/', get('from'));
            $this->page_data['filter_to'] = str_replace('-', '/', get('to'));

            $hasFilter = true;
        }

        $paychecksFilter = [
            'start_date' => $this->page_data['filter_from'],
            'end_date' => $this->page_data['filter_to'],
            'employee_id' => $id
        ];

        $prevUrl = $_SERVER['HTTP_REFERER'];
        $prevUrl = explode('?', $prevUrl);

        if ($hasFilter === false && count($prevUrl) > 1) {
            $hasFilter = true;
        }

        $this->page_data['has_filter'] = $hasFilter;

        $this->page_data['workLocations'] = [];
        $this->page_data['workLocations_ids'] = [];
        if(isset($employmentDetails[0])) {
            $empDetails = $employmentDetails[0];
            $ids = explode(",", $empDetails->work_location_id);
            $work_locations = $this->accounting_worksites_model->get_by_ids($ids);      
            $this->page_data['workLocations'] = $work_locations;
            $this->page_data['workLocations_ids'] = $ids;
        }

        //Leave Credits  
        $employeeLeaveCredits = [];
        $leaveTypes = $this->LeaveType_model->getAllByCompanyId($cid,[]);
        foreach( $leaveTypes as $l ){
            $leaveCredits = $this->EmployeeLeaveCredit_model->getByUserIdAndPtoId($id, $l->id);

            $credits = 0;
            if( $leaveCredits ){
                $credits = $leaveCredits->leave_credits;
            }

            $employeeLeaveCredits[$l->id] = ['leave_type' => $l->name, 'leave_credits' => $credits];
        }       

        $this->page_data['employeeLeaveCredits'] = $employeeLeaveCredits;

        $getTaxWithholding = array(
            'select' => '*',
            'table' => 'accounting_tax_withholding',
            'where' => array('company_id' => $company_id, 'employee_id' => $employee_id,),
        );
        
        $this->page_data['taxWithholdingData'] = $this->general_model->get_data_with_param($getTaxWithholding, false);
        $this->page_data['userType'] = $user_type;
        $this->page_data['commissionSettings'] = $this->CommissionSetting_model->getAllByCompanyId(logged('company_id'));
        $this->page_data['optionCommissionTypes'] = $this->CommissionSetting_model->optionCommissionTypes();
        $this->page_data['employeeCommissionSettings'] = $this->EmployeeCommissionSetting_model->getAllByUserId($id);
        $this->page_data['nextPayDate'] = $nextPayDate;
        $this->page_data['nextPayPeriodEnd'] = date('m/d/Y', strtotime("wednesday"));
        $this->page_data['nextPayday'] = date('m/d/Y', strtotime("friday"));
        $this->page_data['empWorksite'] = $address;
        $this->page_data['paychecks'] = $this->get_emp_paychecks($paychecksFilter);
        $this->load->view('v2/pages/accounting/payroll/employees/view', $this->page_data);
    }

    private function get_emp_paychecks($filter = [])
    {
        $data = [];
        $paychecks = $this->accounting_paychecks_model->get_by_employee_id($filter['employee_id']);

        foreach ($paychecks as $paycheck) {
            $emp = $this->users_model->getUser($paycheck->employee_id);

            $checkNo = $paycheck->check_no;
            if ($paycheck->status === '4') {
                $checkNo = 'Void';
            }

            if ($paycheck->pay_method === 'Adjustment' && $paycheck->status !== '4') {
                $checkNo = '-';
            }

            $data[] = [
                'id' => $paycheck->id,
                'pay_date' => date('m/d/Y', strtotime($paycheck->pay_date)),
                'name' => "$emp->LName, $emp->FName",
                'total_pay' => number_format(floatval($paycheck->total_pay), 2),
                'net_pay' => number_format(floatval($paycheck->net_pay), 2),
                'pay_method' => $paycheck->pay_method,
                'check_number' => $checkNo,
                'status' => '-'
            ];
        }

        $data = array_filter($data, function ($v, $k) use ($filter) {
            return strtotime($v['pay_date']) > strtotime($filter['start_date']) && strtotime($v['pay_date']) < strtotime($filter['end_date']);
        }, ARRAY_FILTER_USE_BOTH);

        usort($data, function ($a, $b) {
            return strtotime($a['pay_date']) < strtotime($b['pay_date']);
        });

        return $data;
    }

    private function get_next_pay_date($paySched)
    {
        switch ($paySched->pay_frequency) {
            case 'every-week':
                $day = date('l', strtotime($paySched->next_payday));
                $nextPayday = date('m/d/Y', strtotime(strtolower($day)));
                break;
            case 'every-other-week':
                $date = date('m/d/Y', strtotime($paySched->next_payday));

                if (strtotime($date) <= strtotime(date("m/d/Y"))) {
                    do {
                        $payDate = strtotime($date . " +14 days");
                        $date = date('m/d/Y', $payDate);
                    } while ($payDate <= strtotime(date("m/d/Y")));
                }

                $nextPayday = $date;
                break;
            case 'twice-month':
                $currentMonth = date("m");
                $currentYear = date("Y");
                $firstPayday = $paySched->first_payday === '0' ? cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear) : $paySched->first_payday;
                $secondPayday = $paySched->second_payday === '0' ? cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear) : $paySched->second_payday;

                if (strtotime(date("$currentMonth/$firstPayday/$currentYear")) < strtotime(date("m/d/Y"))) {
                    $nextPayday = date("m/$secondPayday/Y");
                } else {
                    $nextPayday = date("m/$firstPayday/Y");
                }
                break;
            case 'every-month':
                $currentMonth = date("m");
                $currentYear = date("Y");
                $firstPayday = $paySched->first_payday === '0' ? cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear) : $paySched->first_payday;

                if (strtotime(date("$currentMonth/$firstPayday/$currentYear")) < strtotime(date("m/d/Y"))) {
                    $nextPayday = date("m/d/Y", strtotime(date("m/$firstPayday/Y") . " +1 month"));
                } else {
                    $nextPayday = date("m/$firstPayday/Y");
                }
                break;
        }

        return $nextPayday;
    }

    public function create()
    {
        if (isset($_FILES['userfile']) && $_FILES['userfile']['size'] > 0) {
            $config = array(
                'upload_path' => './uploads/users/user-profile/',
                'allowed_types' => '*',
                'overwrite' => TRUE,
                'max_size' => '20000',
                'max_height' => '0',
                'max_width' => '0',
                'encrypt_name' => true
            );
            $config = $this->uploadlib->initialize($config);
            $this->load->library('upload', $config);
            if ($this->upload->do_upload("userfile")) {
                $uploadData = $this->upload->data();
                $profile_image = $uploadData['file_name'];

                $data = array(
                    'profile_image' => $uploadData['file_name'],
                    'date_created' => time()
                );
                $img_id = $this->users_model->addProfilePhoto($data);
            }
        }

        $payscale = $this->users_model->get_payscale_by_id($this->input->post('empPayscale'));

        $data = [
            'employee_number' => $this->input->post('emp_number'),
            'FName' => $this->input->post('firstname'),
            'LName' => $this->input->post('lastname'),
            'username' => $this->input->post('email'),
            'email' => $this->input->post('email'),
            'password' => hash("sha256", $this->input->post('password')),
            'password_plain' => $this->input->post('password'),
            'role' => $this->input->post('role'),
            'user_type' => $this->input->post('user_type'),
            'status' => $this->input->post('status'),
            'company_id' => logged('company_id'),
            'profile_img' => $profile_image,
            'address' => $this->input->post('address'),
            'state' => $this->input->post('state'),
            'city' => $this->input->post('city'),
            'postal_code' => $this->input->post('postal_code'),
            'payscale_id' => $this->input->post('empPayscale'),
            'base_hourly' => $payscale->pay_type === 'Hourly' ? $this->input->post('salary_rate') : '',
            'base_weekly' => $payscale->pay_type === 'Weekly' ? $this->input->post('salary_rate') : '',
            'base_monthly' => $payscale->pay_type === 'Monthly' ? $this->input->post('salary_rate') : '',
            'base_salary' => $payscale->pay_type === 'Daily' ? $this->input->post('salary_rate') : '',
            'base_yearly' => $payscale->pay_type === 'Yearly' ? $this->input->post('salary_rate') : '',
            'employee_number' => $this->input->post('employee_number'),
            'date_hired' => date('Y-m-d', strtotime($this->input->post('hire_date'))),
            'phone' => $this->input->post('phone'),
            'mobile' => $this->input->post('mobile'),
            'birthdate' => date('Y-m-d', strtotime($this->input->post('birth_date')))
        ];

        $last_id = $this->users_model->addNewEmployee($data);

        if ($last_id) {
            if (!empty($this->input->post('commission_setting_id'))) {
                foreach ($this->input->post('commission_setting_id') as $key => $csid) {
                    $employee_commission_setting = [
                        'user_id' => $last_id,
                        'company_id' => logged('company_id'),
                        'commission_setting_id' => $csid,
                        'commission_type' => $this->input->post('commission_setting_type')[$key],
                        'commission_value' => $this->input->post('commission_setting_value')[$key]
                    ];

                    $this->EmployeeCommissionSetting_model->create($employee_commission_setting);
                }
            }

            $payDetails = [
                'user_id' => $last_id,
                'company_id' => logged('company_id'),
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
        }

        echo json_encode([
            'success' => $last_id ? true : false,
            'title' => $last_id ? "Save Successful!" : "Failed",
            'message' => $last_id ? "New employee source has been added successfully." : "Something is wrong in the process."
        ]);
    }

    public function update($type, $id)
    {
        if ($type === 'personal-info') {
            $data = [
                'FName' => $this->input->post('first_name'),
                'LName' => $this->input->post('last_name'),
                'username' => $this->input->post('username'),
                'email' => $this->input->post('email'),
                'role' => $this->input->post('role'),
                'status' => $this->input->post('status'),
                'profile_img' => $this->input->post('profile_photo'),
                'address' => $this->input->post('address'),
                'state' => $this->input->post('state'),
                'city' => $this->input->post('city'),
                'postal_code' => $this->input->post('zip_code'),
                'phone' => $this->input->post('phone'),
                'mobile' => $this->input->post('mobile'),
                'birthdate' => date('Y-m-d', strtotime($this->input->post('birth_date'))),
                'has_web_access' => !empty($this->input->post('web_access')) ? 1 : 0,
                'has_app_access' => !empty($this->input->post('app_access')) ? 1 : 0
            ];
        } else {
            switch ($type) {
                case 'payment-method':
                    $payDetails = [
                        'pay_method' => $this->input->post('payment_method')
                    ];
                    break;
                case 'employment-details':
                    $data = [
                        'employee_number' => $this->input->post('employee_number'),
                        'date_hired' => date("Y-m-d", strtotime($this->input->post('hire_date'))),
                        'user_type' => $this->input->post('user_type'),
                        'role' => $this->input->post('role'),
                    ];

                    $employmentDetails = [
                        'work_location_id' => $this->input->post('work_location'),
                        'workers_comp_class' => $this->input->post('workers_comp_class')
                    ];
                    break;
                case 'pay-types':
                    $payscale = $this->users_model->get_payscale_by_id($this->input->post('empPayscale'));

                    $data = [
                        'payscale_id' => $this->input->post('empPayscale'),
                        'base_hourly' => $payscale->pay_type === 'Hourly' ? $this->input->post('salary_rate') : '',
                        'base_weekly' => $payscale->pay_type === 'Weekly' ? $this->input->post('salary_rate') : '',
                        'base_monthly' => $payscale->pay_type === 'Monthly' ? $this->input->post('salary_rate') : '',
                        'base_salary' => $payscale->pay_type === 'Daily' ? $this->input->post('salary_rate') : '',
                        'base_yearly' => $payscale->pay_type === 'Yearly' ? $this->input->post('salary_rate') : ''
                    ];
                    break;
                case 'notes':
                    $payDetails = [
                        'notes' => $this->input->post('notes')
                    ];
                    break;
            }
        }

        if (isset($data)) {
            $update = $this->users_model->update($id, $data);

            if (!empty($this->input->post('commission_setting_id'))) {
                $this->EmployeeCommissionSetting_model->deleteAllByUserId($id);
                foreach ($this->input->post('commission_setting_id') as $key => $csid) {
                    $employee_commission_setting = [
                        'user_id' => $id,
                        'company_id' => logged('company_id'),
                        'commission_setting_id' => $csid,
                        'commission_type' => $this->input->post('commission_setting_type')[$key],
                        'commission_value' => $this->input->post('commission_setting_value')[$key]
                    ];

                    $this->EmployeeCommissionSetting_model->create($employee_commission_setting);
                }
            }
        }

        if (isset($payDetails)) {
            if ($this->users_model->getEmployeePayDetails($id)) {
                $this->users_model->updateEmployeePayDetails($id, $payDetails);
            } else {
                $payDetails['company_id'] = logged('company_id');
                $payDetails['user_id'] = $id;
                $payDetails['status'] = 1;
                $payDetails['created_at'] = $payDetails['updated_at'];

                $this->users_model->insertEmployeePayDetails($payDetails);
            }
        }
        if (isset($employmentDetails)) {
            if ($this->employment_details_model->get_employment_details($id)) {
                $this->employment_details_model->update_employment_details($id, $employmentDetails);

                //Activity Logs
                $activity_name = 'Employees : Update Employment Details'; 
                createActivityLog($activity_name);                

            } else {
                $employmentDetails['user_id'] = $id;
                $this->employment_details_model->create($employmentDetails);
            }
        }

        redirect($_SERVER['HTTP_REFERER']);
    }

    public function delete($id)
    {
        ifPermissions('users_delete');

        if ($id !== 1 && $id != logged($id)) {
        } else {
            redirect('/accounting/employees', 'refresh');

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

        $this->activity_model->add("User #$id Deleted by User:" . logged('name'));

        $this->session->set_flashdata('success', 'Employee record has been deleted successfully.');

        redirect('/accounting/employees');
    }

    public function set_status($id, $status)
    {
        switch ($status) {
            case 'terminated':
                $empStatus = 0;
                break;
            case 'paid-leave':
                $empStatus = 2;
                break;
            case 'unpaid-leave':
                $empStatus = 3;
                break;
            case 'not-on-payroll':
                $empStatus = 4;
                break;
            case 'deceased':
                $empStatus = 5;
                break;
            default:
                $empStatus = 1;
                break;
        }

        $data = [
            'status' => $empStatus
        ];

        $update = $this->users_model->update($id, $data);

        if ($update) {
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

        if (in_array($post['pay_frequency'], ['every-week', 'every-other-week'])) {
            $data = $this->set_weekly_pay_data($post);
        } else {
            if ($post['custom_schedule'] === 'on') {
                if ($post['pay_frequency'] === 'every-month') {
                    $data = $this->set_custom_monthly_schedule($post);
                } else {
                    $data = $this->set_custom_twice_month_schedule($post);
                }
            } else {
                if ($post['pay_frequency'] === 'every-month') {
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

        if ($data['use_for_new_employees'] === 1) {
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

        if ($nextPayDayDate === cal_days_in_month(CAL_GREGORIAN, $nextPayDayMonth, $nextPayDayYear)) {
            $firstPayDay = 0;
        } else {
            $firstPayDay = $nextPayDayDate;
        }

        if ($nextPayPeriodEndDate === cal_days_in_month(CAL_GREGORIAN, $nextPayPeriodEndMonth, $nextPayPeriodEndYear)) {
            $firstPayDate = 0;
        } else {
            $firstPayDate = $nextPayPeriodEndDate;
        }

        if ($nextPayDayMonth === $nextPayPeriodEndMonth) {
            $firstPayMonth = 'same';
        } else if ($nextPayDayMonth > $nextPayPeriodEndMonth) {
            $firstPayMonth = 'previous';
        } else if ($nextPayDayMonth < $nextPayPeriodEndMonth) {
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

        if (intval(date('m', strtotime($nextPayDay . ' -15 days'))) < $nextPayDayMonth) {
            $firstPayDay = $nextPayDayDate;
            if ($nextPayDayMonth === $nextPayPeriodEndMonth) {
                $firstPayMonth = 'same';
            } else if ($nextPayDayMonth > $nextPayPeriodEndMonth) {
                $firstPayMonth = 'previous';
            } else if ($nextPayDayMonth < $nextPayPeriodEndMonth) {
                $firstPayMonth = 'next';
            }

            if ($nextPayPeriodEndDate === cal_days_in_month(CAL_GREGORIAN, $nextPayPeriodEndMonth, $nextPayPeriodEndYear)) {
                $firstPayDate = 0;
            } else {
                $firstPayDate = $nextPayPeriodEndDate;
            }

            $secondPayDay = date('Y-m-d', strtotime($nextPayDay . ' +15 days'));
            $secondPayDayMonth = intval(date('m', strtotime($secondPayDay)));
            $secondPayDayYear = intval(date('Y', strtotime($secondPayDay)));
            $secondPayDayDate = intval(date('d', strtotime($secondPayDay)));

            $secondPayPeriodEnd = date('Y-m-d', strtotime($nextPayPeriodEnd . ' +15 days'));
            $secondPayPeriodEndMonth = intval(date('m', strtotime($secondPayPeriodEnd)));
            $secondPayPeriodEndYear = intval(date('Y', strtotime($secondPayPeriodEnd)));
            $secondPayPeriodEndDate = intval(date('d', strtotime($secondPayPeriodEnd)));

            if ($secondPayDayMonth === $secondPayPeriodEndMonth) {
                $secondPayMonth = 'same';
            } else if ($secondPayDayMonth > $secondPayPeriodEndMonth) {
                $secondPayMonth = 'previous';
            } else if ($secondPayDayMonth < $secondPayPeriodEndMonth) {
                $secondPayMonth = 'next';
            }

            $secondPayDate = $secondPayPeriodEndDate;
        } else {
            if ($nextPayDayDate === cal_days_in_month(CAL_GREGORIAN, $nextPayDayMonth, $nextPayDayYear)) {
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

            $firstPayPeriodEnd = date('Y-m-d', strtotime($nextPayPeriodEnd . ' -15 days'));
            $firstPayPeriodEndMonth = intval(date('m', strtotime($firstPayPeriodEnd)));
            $firstPayPeriodEndYear = intval(date('Y', strtotime($firstPayPeriodEnd)));
            $firstPayPeriodEndDate = intval(date('d', strtotime($firstPayPeriodEnd)));

            if ($firstPayDateMonth === $firstPayPeriodEndMonth) {
                $firstPayMonth = 'same';
            } else if ($firstPayDateMonth > $firstPayPeriodEndMonth) {
                $firstPayMonth = 'previous';
            } else if ($firstPayDateMonth < $firstPayPeriodEndMonth) {
                $firstPayMonth = 'next';
            }

            if ($firstPayPeriodEndDate === cal_days_in_month(CAL_GREGORIAN, $firstPayPeriodEndMonth, $firstPayPeriodEndYear)) {
                $firstPayDate = 0;
            } else {
                $firstPayDate = $firstPayPeriodEndDate;
            }

            if ($nextPayDayMonth === $nextPayPeriodEndMonth) {
                $secondPayMonth = 'same';
            } else if ($nextPayDayMonth > $nextPayPeriodEndMonth) {
                $secondPayMonth = 'previous';
            } else if ($nextPayDayMonth < $nextPayPeriodEndMonth) {
                $secondPayMonth = 'next';
            }

            if ($nextPayPeriodEndDate === cal_days_in_month(CAL_GREGORIAN, $nextPayPeriodEndMonth, $nextPayPeriodEndYear)) {
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

    public function get_pay_schedule($id)
    {
        $paySched = $this->users_model->getPaySchedule($id);

        echo json_encode($paySched);
    }

    public function update_pay_schedule($id)
    {
        $post = $this->input->post();

        if (in_array($post['pay_frequency'], ['every-week', 'every-other-week'])) {
            $nextPayDay = date('Y-m-d', strtotime($post['next_payday']));
            $nextPayPeriodEnd = date('Y-m-d', strtotime($post['next_pay_period_end']));
        } else {
            if ($post['custom_schedule'] === 'on') {
                $nextPayDay = null;
                $nextPayPeriodEnd = null;
            } else {
                $nextPayDay = date('Y-m-d', strtotime($post['next_payday']));
                $nextPayPeriodEnd = date('Y-m-d', strtotime($post['next_pay_period_end']));
            }
        }

        if ($post['pay_frequency'] !== 'twice-month') {
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

        if ($data['use_for_new_employees'] === "1") {
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

    public function generate_commission_payroll()
    {
        $postData = $this->input->post();
        $socialSecurity = 6.2;
        $medicare = 1.45;
        $futa = 0.006;
        $sui = 0.00;
        
        $payPeriod = $postData['pay_period'];

        $dates = explode('-', $payPeriod);

        if (count($dates) === 2) {
            $startDate = $dates[0];
            $endDate = $dates[1];
            $formattedPayPeriod = $startDate . ' to ' . $endDate;
        } else {
            $formattedPayPeriod = $payPeriod; 
        }

        $this->page_data['payPeriod'] = $formattedPayPeriod;
        // $this->page_data['payPeriod'] = $postData['pay_period'] . ' to ' . $postData['pay_period'];
        $this->page_data['payDate'] = date('m/d/Y', strtotime($postData['pay_date']));

        $employees = [];
        foreach ($postData['employees'] as $key => $empId) {
            $emp = $this->users_model->getUser($empId);
            $empPayDetails = $this->users_model->getEmployeePayDetails($emp->id);

            $empTotalPay = floatval($postData['commission'][$key]);
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

        $this->load->view('v2/pages/accounting/payroll/employees/commission_payroll_summary', $this->page_data);
    }

    public function get_employee_pay_details($user_id)
    {
        $empPayDetails = $this->users_model->getEmployeePayDetails($user_id);

        echo json_encode($empPayDetails);
    }

    public function bonus_only_form($bonusPayType)
    {
        $accounts = $this->chart_of_accounts_model->select();
        $accounts = array_filter($accounts, function ($v, $k) {
            return $v->account_id === 3 || $v->account_id === "3";
        }, ARRAY_FILTER_USE_BOTH);
        $roles = $this->session->userdata('roles');
        $this->page_data['roles'] = $roles;
        $cid = logged('company_id');
        $this->page_data['payscale'] = $this->PayScale_model->getAllByCompanyId($cid);
        $this->page_data['bonusPayType'] = $bonusPayType;
        $this->page_data['accounts'] = $accounts;
        $this->page_data['payDetails'] = $this->users_model->getActiveEmployeePayDetails();
        // print_r($this->page_data['payDetails']);
        $this->load->view('v2/pages/accounting/payroll/employees/bonus_only_payroll_form', $this->page_data);
    }

    // public function generate_bonus_payroll($bonusPayType)
    // {
    //     $postData = $this->input->post();
    //     $socialSecurity = $bonusPayType === 'gross-pay' ? 6.200000000000001 : 6.7333333333333325;
    //     $medicare = $bonusPayType === 'gross-pay' ? 1.4000000000000001 : 1.5333333333333334;
    //     $futa = 0.006;
    //     $sui = 0.00;

    //     $this->page_data['payPeriod'] = $postData['pay_date'] . ' to ' . $postData['pay_date'];
    //     $this->page_data['payDate'] = date('m/d/Y', strtotime($postData['pay_date']));

    //     $employees = [];
    //     foreach ($postData['employees'] as $key => $empId) {
    //         $emp = $this->users_model->getUser($empId);
    //         $empPayDetails = $this->users_model->getEmployeePayDetails($emp->id);

    //         $empTotalPay = floatval($postData['bonus'][$key]);
    //         $empTotalPay = number_format($empTotalPay, 2, '.', ',');

    //         $empSocial = ($empTotalPay / 100) * $socialSecurity;
    //         $empSocial = number_format($empSocial, 2, '.', ',');
    //         $empMedicare = ($empTotalPay / 100) * $medicare;
    //         $empMedicare = number_format($empMedicare, 2, '.', ',');
    //         $empTax = number_format($empSocial + $empMedicare, 2, '.', ',');
    //         $employeeSUI = ($empTotalPay / 100) * $sui;
    //         $employeeSUI = number_format($employeeSUI, 2, '.', ',');

    //         if ($bonusPayType === 'net-pay') {
    //             $empTotalPay = $empTotalPay + $empTax;
    //         }

    //         $netPay = $empTotalPay - $empTax;

    //         $employees[] = [
    //             'id' => $emp->id,
    //             'name' => $emp->LName . ', ' . $emp->FName,
    //             'pay_method' => $empPayDetails->pay_method === 'direct-deposit' ? 'Direct deposit' : 'Paper check',
    //             'total_pay' => $empTotalPay,
    //             'bonus' => $empTotalPay,
    //             'employee_tax' => $empTax,
    //             'net_pay' => number_format($netPay, 2, '.', ','),
    //             'employee_futa' => number_format($empTotalPay * $futa, 2, '.', ','),
    //             'employee_sui' => $employeeSUI
    //         ];
    //     }

    //     $totalPay = array_sum(array_column($employees, 'total_pay'));
    //     $totalPay = number_format($totalPay, 2, '.', ',');
    //     $totalBonus = array_sum(array_column($employees, 'bonus'));
    //     $totalBonus = number_format($totalPay, 2, '.', ',');
    //     $totalTaxes = array_sum(array_column($employees, 'employee_tax'));
    //     $totalTaxes = number_format($totalTaxes, 2, '.', ',');
    //     $totalNetPay = array_sum(array_column($employees, 'net_pay'));
    //     $totalNetPay = number_format($totalNetPay, 2, '.', ',');
    //     $totalFuta = array_sum(array_column($employees, 'employee_futa'));
    //     $totalFuta = number_format($totalFuta, 2, '.', ',');
    //     $totalSUI = array_sum(array_column($employees, 'employee_sui'));
    //     $totalSUI = number_format($totalSUI, 2, '.', ',');

    //     $totalEmployerTax = $totalTaxes + $totalFuta + $totalSUI;

    //     $totalPayrollCost = $totalNetPay + $totalTaxes + $totalEmployerTax;

    //     $this->page_data['employees'] = $employees;
    //     $this->page_data['total'] = [
    //         'total_bonus' => $totalBonus,
    //         'total_pay' => $totalPay,
    //         'total_taxes' => $totalTaxes,
    //         'total_net_pay' => $totalNetPay,
    //         'total_employer_tax' => number_format($totalEmployerTax, 2, '.', ','),
    //         'total_payroll_cost' => number_format($totalPayrollCost, 2, '.', ',')
    //     ];

    //     $this->load->view('v2/pages/accounting/payroll/employees/bonus_payroll_summary', $this->page_data);
    // }

    public function generate_bonus_payroll($bonusPayType)
    {
        $postData = $this->input->post();
        $socialSecurity = $bonusPayType === 'gross-pay' ? 6.200000000000001 : 6.7333333333333325;
        $medicare = $bonusPayType === 'gross-pay' ? 1.4000000000000001 : 1.5333333333333334;
        $futa = 0.006;
        $sui = 0.00;

        $payPeriod = $postData['pay_period'];

        if (isset($payPeriod)) {
            $dates = explode('-', $payPeriod);
        
            if (count($dates) == 6) {

                $startDate = $dates[0] . '-' . $dates[1] . '-' . $dates[2];

                $endDate = $dates[3] . '-' . $dates[4] . '-' . $dates[5];
            } else {
                $startDate = '';
                $endDate = '';
            }
        } else {
            $startDate = '';
            $endDate = '';
        }
        // if (count($dates) === 2) {
            $startDate = $startDate;
            $endDate = $endDate;
            $formattedPayPeriod = $startDate . ' to ' . $endDate;
        // } 

        $this->page_data['payPeriod'] = $formattedPayPeriod;
         
        $payDate = date('m/d/Y', strtotime($postData['pay_date']));
        // $this->page_data['payPeriod'] = $postData['pay_date'] . ' to ' . $postData['pay_date'];
        $this->page_data['payDate'] = $payDate;

        $employeesData = [];

        foreach ($postData['employees'] as $key => $empId) {
            // Check if the employee ID is already in the array
            if (!isset($employeesData[$empId])) {
                // If not, add the employee data to the array
                $employeesData[$empId] = [
                    'id' => $empId,
                    'bonus' => $postData['bonus'][$key]
                ];
            }
        }
        // print_r($employeesData);
        $employees = [];
        $employeeData = [];
        
        foreach ($employeesData as $data) {
            $empId = $data['id'];
            $bonus = $data['bonus'];
        
            $emp = $this->users_model->getUser($empId);
            $empPayDetails = $this->users_model->getEmployeePayDetails($emp->id);
        
            $empTotalPay = floatval($bonus);
            $empTotalPay = number_format($empTotalPay, 2, '.', ',');
        
            $empSocial = ($empTotalPay / 100) * $socialSecurity;
            $empSocial = number_format($empSocial, 2, '.', ',');
            $empMedicare = ($empTotalPay / 100) * $medicare;
            $empMedicare = number_format($empMedicare, 2, '.', ',');
            $empTax = number_format($empSocial + $empMedicare, 2, '.', ',');
            $employeeSUI = ($empTotalPay / 100) * $sui;
            $employeeSUI = number_format($employeeSUI, 2, '.', ',');
        
            if ($bonusPayType === 'net-pay') {
                $empTotalPay += $empTax;
            }
        
            $netPay = $empTotalPay - $empTax;
        
            $newEmployeeData = [
                'id' => $emp->id,
                'name' => $emp->LName . ', ' . $emp->FName,
                'pay_method' => $empPayDetails->pay_method === 'direct-deposit' ? 'Direct deposit' : 'Paper check',
                'total_pay' => number_format($empTotalPay, 2, '.', ','),
                'bonus' => number_format($empTotalPay, 2, '.', ','),
                'employee_tax' => number_format($empTax, 2, '.', ','),
                'net_pay' => number_format($netPay, 2, '.', ','),
                'employee_futa' => number_format($empTotalPay * $futa, 2, '.', ','),
                'employee_sui' => $employeeSUI
            ];
        
            // Overwrite any existing entry for the same employee ID
            $employeeData[$empId] = $newEmployeeData;
        }
        
        // Extract the values from the associative array
        $employees = array_values($employeeData);
          
        
        
        $totalPay = array_sum(array_column($employees, 'total_pay'));
        $totalPay = number_format($totalPay, 2, '.', ',');
        $totalBonus = array_sum(array_column($employees, 'bonus'));
        $totalBonus = number_format($totalPay, 2, '.', ',');
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
            'total_bonus' => number_format($totalBonus, 2, '.', ','),
            'total_pay' => number_format($totalPay, 2, '.', ','),
            'total_taxes' => number_format($totalTaxes, 2, '.', ','),
            'total_net_pay' => number_format($totalNetPay, 2, '.', ','),
            'total_employer_tax' => number_format($totalEmployerTax, 2, '.', ','),
            'total_payroll_cost' => number_format($totalPayrollCost, 2, '.', ',')
        ];

        $this->load->view('v2/pages/accounting/payroll/employees/bonus_payroll_summary', $this->page_data);
    }

    public function paycheck_list()
    {
        $this->load->helper('pdf_helper');

        add_footer_js(array(
            "assets/js/v2/accounting/payroll/employees/paycheck-list.js"
        ));

        $data = [];
        $paychecks = $this->accounting_paychecks_model->get_company_paychecks(logged('company_id'));

        usort($paychecks, function ($a, $b) {
            return strtotime($a->pay_date) < strtotime($b->pay_date);
        });

        $this->page_data['start_date'] = date("m/d/Y", strtotime($paychecks[0]->pay_date));
        $this->page_data['end_date'] = date("m/d/Y", strtotime($paychecks[0]->pay_date));

        if (!empty(get('employee'))) {
            $selectedEmployees = explode(',', get('employee')); // Convert comma-separated string to array
            $this->page_data['employee'] = new stdClass();

            // Add selected employee IDs to the page data
            $this->page_data['employee']->ids = $selectedEmployees;

            $data = array_filter($data, function ($v, $k) use ($selectedEmployees) {
                return in_array($v['employee_id'], $selectedEmployees);
            }, ARRAY_FILTER_USE_BOTH);
        }

        if (!empty(get('date'))) {
            $this->page_data['filter_date'] = get('date');
            $this->page_data['start_date'] = str_replace('-', '/', get('from'));
            $this->page_data['end_date'] = str_replace('-', '/', get('to'));
        }

        $dateFilter = [
            'start_date' => $this->page_data['start_date'],
            'end_date' => $this->page_data['end_date']
        ];

        $paychecks = array_filter($paychecks, function ($v, $k) use ($dateFilter) {
            return strtotime($v->pay_date) >= strtotime($dateFilter['start_date']) && strtotime($v->pay_date) <= strtotime($dateFilter['end_date']);
        }, ARRAY_FILTER_USE_BOTH);

        foreach ($paychecks as $paycheck) {
            $employee = $this->users_model->getUser($paycheck->employee_id);

            $checkNo = $paycheck->check_no;
            if ($paycheck->status === '4') {
                $checkNo = 'Void';
            }

            if ($paycheck->pay_method === 'Adjustment' && $paycheck->status !== '4') {
                $checkNo = '-';
            }

            $data[] = [
                'id' => $paycheck->id,
                'pay_date' => date("m/d/Y", strtotime($paycheck->pay_date)),
                'employee_id' => $paycheck->employee_id,
                'name' => (!empty($employee->LName) && !empty($employee->FName)) ? "$employee->LName, $employee->FName" : 'No name provided',
                'total_pay' => number_format(floatval(str_replace(',', '', $paycheck->total_pay)), 2),
                'net_pay' => number_format(floatval(str_replace(',', '', $paycheck->net_pay)), 2),
                'pay_method' => $paycheck->pay_method,
                'check_number' => $checkNo,
                'status' => '-'
            ];
        }

        if (!empty(get('employee'))) {
            $this->page_data['employee'] = new stdClass();
            $this->page_data['employee']->id = get('employee');
            
            if (get('employee') !== 'all') {
                // Split the input string by ',' to get individual employee entries
                $employeeEntries = explode(',', get('employee'));
            
                $employeeIds = [];
                $employeeNames = [];
            
                foreach ($employeeEntries as $entry) {
                    $explode = explode('-', $entry);
                    $employeeId = $explode[1];
            
                    $employee = $this->users_model->getUserByID($employeeId);
                    if ($employee) {
                        $employeeNames[] = $employee->FName . ' ' . $employee->LName;
                        $employeeIds[] = $employeeId;
                    }
                }
            
                $this->page_data['employee']->name = implode(', ', $employeeNames);
            
                $data = array_filter($data, function ($v, $k) use ($employeeIds) {
                    return in_array($v['employee_id'], $employeeIds);
                }, ARRAY_FILTER_USE_BOTH);
            } else {
                $this->page_data['employee']->name = ucwords(str_replace('-', ' ', get('employee')));
            }
            
            
        }
     
        $report_period = 'Paychecks from ' . date("M d, Y", strtotime($this->page_data['start_date'])) . ' to ' . date("M d, Y", strtotime($this->page_data['end_date'])) . ' for all employees';

        $companyName = $this->page_data['clients']->business_name;
        $reportName = 'Paycheck history report';

        $headers = [
            'Pay date',
            'Name',
            'Total pay',
            'Net pay',
            'Pay method',
            'Check Number',
            'Status'
        ];

        $pdfData = [
            'company_name' => $companyName,
            'report_name' => $reportName,
            'report_period' => $report_period,
            'fields' => $headers,
            'orientation' => 'L',
            'paychecks' => $data
        ];
       
        $obj_pdf = $this->generate_paycheck_pdf($pdfData);
        $fileName = str_replace(' ', '_', $companyName) . '_Paycheck_List_' . date("mdY") . '.pdf';
        $blob = $obj_pdf->Output(getcwd() . "/assets/pdf/$fileName", 'S');

        $this->page_data['pdfBlob'] = 'data:application/pdf;base64,' . base64_encode($blob);
        $this->page_data['paychecks'] = $data;
        $this->page_data['page']->title = 'Paycheck list';
        $this->load->view('v2/pages/accounting/payroll/employees/paycheck_list', $this->page_data);
    }

    public function batch_void()
    {
        $ids = $this->input->post('ids');
        if ($ids) {
            $idsArray = explode(',', $ids);
            foreach ($idsArray as $id) {
                $this->accounting_paychecks_model->batch_void_paycheck($id);
            }
            // echo json_encode(['status' => 'success']);
        } else {
            // echo json_encode(['status' => 'error', 'message' => 'No IDs provided.']);
        }
    }

    public function batch_delete()
    {
        $ids = $this->input->post('ids');
        if ($ids) {
            $idsArray = explode(',', $ids);
            foreach ($idsArray as $id) {
                $this->accounting_paychecks_model->batch_delete_paycheck($id);
            }
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No IDs provided.']);
        }
    }

    public function export_paychecks()
    {
        $this->load->library('PHPXLSXWriter');
        $this->load->helper('pdf_helper');
        $post = $this->input->post();

        $data = [];
        $paychecks = $this->accounting_paychecks_model->get_company_paychecks(logged('company_id'));

        usort($paychecks, function ($a, $b) {
            return strtotime($a->pay_date) < strtotime($b->pay_date);
        });

        $start_date = date("m/d/Y", strtotime($paychecks[0]->pay_date));
        $end_date = date("m/d/Y", strtotime($paychecks[0]->pay_date));

        if (!empty($post['date'])) {
            $filter_date = $post['date'];
            $start_date = str_replace('-', '/', $post['from']);
            $end_date = str_replace('-', '/', $post['to']);
        }

        $dateFilter = [
            'start_date' => $start_date,
            'end_date' => $end_date
        ];

        $paychecks = array_filter($paychecks, function ($v, $k) use ($dateFilter) {
            return strtotime($v->pay_date) >= strtotime($dateFilter['start_date']) && strtotime($v->pay_date) <= strtotime($dateFilter['end_date']);
        }, ARRAY_FILTER_USE_BOTH);

        foreach ($paychecks as $paycheck) {
            $employee = $this->users_model->getUser($paycheck->employee_id);

            $data[] = [
                'id' => $paycheck->id,
                'pay_date' => date("m/d/Y", strtotime($paycheck->pay_date)),
                'employee_id' => $paycheck->employee_id,
                'name' => "$employee->LName, $employee->FName",
                'total_pay' => number_format(floatval($paycheck->total_pay), 2),
                'net_pay' => number_format(floatval($paycheck->net_pay), 2),
                'pay_method' => $paycheck->pay_method,
                'check_number' => !empty($paycheck->check_no) ? $paycheck->check_no : '-',
                'status' => '-'
            ];
        }

        if (!empty($post['employee'])) {
            if (!in_array($post['employee'], ['all', 'not-specified', 'specified'])) {
                $explode = explode('-', $post['employee']);

                $employee = $this->users_model->getUserByID($explode[1]);

                $filters = [
                    'key' => $explode[0],
                    'id' => $explode[1]
                ];

                $data = array_filter($data, function ($v, $k) use ($filters) {
                    return $v['employee_id'] === $filters['id'];
                }, ARRAY_FILTER_USE_BOTH);
            } else {
                if ($post['employee'] === 'not-specified') {
                    $data = array_filter($data, function ($v, $k) {
                        return empty($v['employee_id']);
                    }, ARRAY_FILTER_USE_BOTH);
                } else {
                    $data = array_filter($data, function ($v, $k) {
                        return !empty($v['employee_id']);
                    }, ARRAY_FILTER_USE_BOTH);
                }
            }
        }

        $report_period = 'Paychecks from ' . date("M d, Y", strtotime($start_date)) . ' to ' . date("M d, Y", strtotime($end_date)) . ' for all employees';

        $companyName = $this->page_data['clients']->business_name;
        $reportName = 'Paycheck history report';

        $headers = [
            'Pay date',
            'Name',
            'Total pay',
            'Net pay',
            'Pay method',
            'Check Number',
            'Status'
        ];

        if ($post['type'] === 'excel') {
            $writer = new XLSXWriter();
            $row = 0;

            $header = [];
            foreach ($headers as $head) {
                $header[] = 'string';
            }

            $writer->writeSheetHeader('Sheet1', $header, array('suppress_row' => true));

            $writer->writeSheetRow('Sheet1', [$companyName], ['halign' => 'center', 'valign' => 'center', 'font-style' => 'bold']);
            $writer->markMergedCell('Sheet1', 0, 0, 0, count($header) - 1);
            $row++;

            $writer->writeSheetRow('Sheet1', [$reportName], ['halign' => 'center', 'valign' => 'center', 'font-style' => 'bold']);
            $writer->markMergedCell('Sheet1', $row, 0, $row, count($header) - 1);
            $row++;

            $writer->writeSheetRow('Sheet1', [$report_period], ['halign' => 'center', 'valign' => 'center', 'font-style' => 'bold']);
            $writer->markMergedCell('Sheet1', $row, 0, $row, count($header) - 1);
            $row++;

            $writer->writeSheetRow('Sheet1', []);
            $writer->markMergedCell('Sheet1', $row, 0, $row, count($header) - 1);
            $row++;

            $writer->writeSheetRow('Sheet1', $headers, ['halign' => 'left', 'valign' => 'center', 'font-style' => 'bold']);
            $row++;

            foreach ($data as $paycheck) {
                $renderData = [];
                foreach ($headers as $field) {
                    if ($field !== 'Total pay' && $field !== 'Net pay') {
                        $renderData[] = $paycheck[strtolower(str_replace(' ', '_', $field))];
                    } else {
                        $renderData[] = str_replace('$-', '-$', '$' . number_format($paycheck[strtolower(str_replace(' ', '_', $field))], 2));
                    }
                }

                $writer->writeSheetRow('Sheet1', $renderData);
                $row++;
            }

            $fileName = str_replace(' ', '_', $companyName) . '_Paycheck_List_' . date("mdY");
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header("Content-Disposition: attachment;filename=Paycheck_List.xlsx");
            header('Cache-Control: max-age=0');
            $writer->writeToStdOut();
        } else {
            $pdfData = [
                'company_name' => $companyName,
                'report_name' => $reportName,
                'report_period' => $report_period,
                'fields' => $headers,
                'orientation' => $post['orientation'] === 'landscape' ? 'L' : 'P',
                'paychecks' => $data
            ];
            $obj_pdf = $this->generate_paycheck_pdf($pdfData);

            $fileName = str_replace(' ', '_', $companyName) . '_Paycheck_List_' . date("mdY") . '.pdf';
            $obj_pdf->Output($fileName, 'D');
        }
    }

    private function generate_paycheck_pdf($post)
    {
        $this->load->helper('pdf_helper');

        $html = '
        <table style="padding-top:-40px;">
            <tr>
                <td style="text-align: center">';
        $html .= '<h2 style="margin: 0">' . (!empty($post['company_name']) ? $post['company_name'] : 'No Company Name') . '</h2>';
        $html .= '<h3 style="margin: 0">' . (!empty($post['report_name']) ? $post['report_name'] : 'No Report Name') . '</h3>';
        $html .= '<h4 style="margin: 0">' . (!empty($post['report_period']) ? $post['report_period'] : 'No Report Period') . '</h4>';
        $html .= '</td>
            </tr>
        </table>
        <br /><br /><br />

        <table style="width:100%;">
        <thead>
            <tr>';
        foreach ($post['fields'] as $field) {
            $html .= '<th style="border-top: 1px solid black; border-bottom: 1px solid black; border-left: 1px solid black; border-right: 1px solid black"><b>' . $field . '</b></th>';
        }
        $html .= '</tr>
        </thead>
        <tbody>';

        foreach ($post['paychecks'] as $paycheck) {
            $html .= '<tr>';
            foreach ($post['fields'] as $field) {
                $fieldName = strtolower(str_replace(' ', '_', $field));
                $fieldValue = isset($paycheck[$fieldName]) && $paycheck[$fieldName] !== '' ? $paycheck[$fieldName] : 'No data';
                $html .= '<td style="border-bottom: 1px solid black; border-left: 1px solid black; border-right: 1px solid black">' . str_replace('class="text-danger"', 'style="color: red"', $fieldValue) . '</td>';
            }
            $html .= '</tr>';
        }

        $html .= '</tbody>
        </table>';

        tcpdf();
        $obj_pdf = new TCPDF($post['orientation'], PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $title = "Paycheck List";
        $obj_pdf->SetTitle($title);
        $obj_pdf->setPrintHeader(false);
        $obj_pdf->setPrintFooter(false);
        $obj_pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $obj_pdf->SetDefaultMonospacedFont('helvetica');
        $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $obj_pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
        $obj_pdf->SetFont('helvetica', '', 7);
        $obj_pdf->setFontSubsetting(false);
        $obj_pdf->AddPage();
        ob_end_clean();
        $obj_pdf->writeHTML($html, true, false, true, false, '');

        return $obj_pdf;
    }

    public function change_paycheck_pdf_orientation()
    {
        $this->load->helper('pdf_helper');
        $post = $this->input->post();

        $data = [];
        $paychecks = $this->accounting_paychecks_model->get_company_paychecks(logged('company_id'));

        usort($paychecks, function ($a, $b) {
            return strtotime($a->pay_date) < strtotime($b->pay_date);
        });

        $start_date = date("m/d/Y", strtotime($paychecks[0]->pay_date));
        $end_date = date("m/d/Y", strtotime($paychecks[0]->pay_date));

        if (!empty($post['date'])) {
            $filter_date = $post['date'];
            $start_date = str_replace('-', '/', $post['from']);
            $end_date = str_replace('-', '/', $post['to']);
        }

        $dateFilter = [
            'start_date' => $start_date,
            'end_date' => $end_date
        ];

        $paychecks = array_filter($paychecks, function ($v, $k) use ($dateFilter) {
            return strtotime($v->pay_date) >= strtotime($dateFilter['start_date']) && strtotime($v->pay_date) <= strtotime($dateFilter['end_date']);
        }, ARRAY_FILTER_USE_BOTH);

        foreach ($paychecks as $paycheck) {
            $employee = $this->users_model->getUser($paycheck->employee_id);

            $data[] = [
                'id' => $paycheck->id,
                'pay_date' => date("m/d/Y", strtotime($paycheck->pay_date)),
                'employee_id' => $paycheck->employee_id,
                'name' => "$employee->LName, $employee->FName",
                'total_pay' => number_format(floatval($paycheck->total_pay), 2),
                'net_pay' => number_format(floatval($paycheck->net_pay), 2),
                'pay_method' => $paycheck->pay_method,
                'check_number' => !empty($paycheck->check_no) ? $paycheck->check_no : '-',
                'status' => '-'
            ];
        }

        if (!empty($post['employee'])) {
            if (!in_array($post['employee'], ['all', 'not-specified', 'specified'])) {
                $explode = explode('-', $post['employee']);

                $employee = $this->users_model->getUserByID($explode[1]);

                $filters = [
                    'key' => $explode[0],
                    'id' => $explode[1]
                ];

                $data = array_filter($data, function ($v, $k) use ($filters) {
                    return $v['employee_id'] === $filters['id'];
                }, ARRAY_FILTER_USE_BOTH);
            } else {
                if ($post['employee'] === 'not-specified') {
                    $data = array_filter($data, function ($v, $k) {
                        return empty($v['employee_id']);
                    }, ARRAY_FILTER_USE_BOTH);
                } else {
                    $data = array_filter($data, function ($v, $k) {
                        return !empty($v['employee_id']);
                    }, ARRAY_FILTER_USE_BOTH);
                }
            }
        }

        $report_period = 'Paychecks from ' . date("M d, Y", strtotime($start_date)) . ' to ' . date("M d, Y", strtotime($end_date)) . ' for all employees';

        $companyName = $this->page_data['clients']->business_name;
        $reportName = 'Paycheck history report';

        $headers = [
            'Pay date',
            'Name',
            'Total pay',
            'Net pay',
            'Pay method',
            'Check Number',
            'Status'
        ];

        $pdfData = [
            'company_name' => $companyName,
            'report_name' => $reportName,
            'report_period' => $report_period,
            'fields' => $headers,
            'orientation' => $post['orientation'] === 'landscape' ? 'L' : 'P',
            'paychecks' => $data
        ];
        $obj_pdf = $this->generate_paycheck_pdf($pdfData);

        $fileName = str_replace(' ', '_', $companyName) . '_Paycheck_List_' . date("mdY") . '.pdf';
        $blob = $obj_pdf->Output(getcwd() . "/assets/pdf/$fileName", 'S');

        echo 'data:application/pdf;base64,' . base64_encode($blob);
    }

    public function add_work_location()
    {
        $post = $this->input->post();
        $post['company_id'] = logged('company_id');

        $id = $this->accounting_worksites_model->create($post);

        echo json_encode(['id' => $id, 'name' => $post['name']]);
    }

    public function add_deductions_and_contributions(){
        $post = $this->input->post();
        $post['company_id'] = logged('company_id');

        $id = $this->deductions_and_contribution_model->create($post);

        echo json_encode(['success' => $post]);
    }


    public function update_paycheck_num($paycheckId)
    {
        $update = $this->accounting_paychecks_model->update_check_no($paycheckId, $this->input->post('check_number'));

        echo json_encode($update);
    }

    public function print_multiple_paychecks()
    {
        $this->load->helper('pdf_helper');

        $title = "Paycheck";

        tcpdf();
        $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $obj_pdf->SetTitle($title);
        $obj_pdf->setPrintHeader(false);
        $obj_pdf->setPrintFooter(false);
        $obj_pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $obj_pdf->SetDefaultMonospacedFont('helvetica');
        $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $obj_pdf->SetMargins(PDF_MARGIN_LEFT, 0, PDF_MARGIN_RIGHT);
        $obj_pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
        $obj_pdf->SetFont('helvetica', '', 9);
        $obj_pdf->setFontSubsetting(false);
        ob_end_clean();

        foreach ($this->input->post('paycheck_id') as $id) {
            $paycheck = $this->accounting_paychecks_model->get_by_id($id);
            $companyName = $this->invoice_model->getclientsData($paycheck->company_id)->business_name;
            $businessProfile = $this->business_model->getById($paycheck->company_id);

            $companyAddress = !empty($businessProfile->street) ? $businessProfile->street . '<br>' : '';
            $companyAddress .= !empty($businessProfile->city) ? $businessProfile->city : '';
            $companyAddress .= !empty($businessProfile->state) ? ', ' . $businessProfile->state : '';
            $companyAddress .= !empty($businessProfile->postal_code) ? ' ' . $businessProfile->postal_code : '';

            $netPay = number_format(floatval(str_replace(',', '', $paycheck->net_pay)), 2);
            $netPay = str_replace('$-', '-$', '$' . $netPay);

            $employee = $this->users_model->getUser($paycheck->employee_id);
            $name = $employee->FName . ' ' . $employee->LName;

            $address = '';
            $address .= !empty($employee->address) ? $employee->address . '<br>' : '';
            $address .= !empty($employee->city) ? $employee->city : '';
            $address .= !empty($employee->state) ? ', ' . $employee->state : '';
            $address .= !empty($employee->postal_code) ? ' ' . $employee->postal_code : '';

            $payroll = $this->accounting_payroll_model->get_by_id($paycheck->payroll_id);
            $payrollItem = $this->accounting_payroll_model->get_payroll_item($paycheck->payroll_item_id);

            $payscale = $this->users_model->get_payscale_by_id($employee->payscale_id);

            $totalHrs = floatval(str_replace(',', '', $payrollItem->employee_hours));

            if ($payscale->pay_type === 'Hourly') {
                $perHourPay = floatval(str_replace(',', '', $employee->base_hourly));
                $totalPay = floatval(str_replace(',', '', $employee->base_hourly)) * $totalHrs;
            }

            if ($payscale->pay_type === 'Daily') {
                $dailyPay = floatval(str_replace(',', '', $employee->base_daily));
                $hoursPerDay = 8.00;
                $perHourPay = $dailyPay / $hoursPerDay;

                $totalPay = $perHourPay * $totalHrs;
            }

            if ($payscale->pay_type === 'Weekly') {
                $weeklyPay = floatval(str_replace(',', '', $employee->base_weekly));
                $hoursPerWeek = 40.00;
                $perHourPay = $weeklyPay / $hoursPerWeek;

                $totalPay = $perHourPay * $totalHrs;
            }

            if ($payscale->pay_type === 'Monthly') {
                $monthlyPay = floatval(str_replace(',', '', $employee->base_monthly));
                $hoursPerWeek = 40.00;
                $hoursPerMonth = $hoursPerWeek * 4;
                $perHourPay = $monthlyPay / $hoursPerMonth;

                $totalPay = $perHourPay * $totalHrs;
            }

            if ($payscale->pay_type === 'Yearly') {
                $yearlyPay = floatval(str_replace(',', '', $employee->base_yearly));
                $hoursPerWeek = 40.00;
                $hoursPerMonth = $hoursPerWeek * 4;
                $hoursPerYear = $hoursPerMonth * 12;
                $perHourPay = $yearlyPay / $hoursPerYear;

                $totalPay = $perHourPay * $totalHrs;
            }

            $ssTax = (floatval(str_replace(',', '', $payrollItem->employee_total_pay)) / 100) * 6.2;
            $medicareTax = (floatval(str_replace(',', '', $payrollItem->employee_total_pay)) / 100) * 1.45;
            // $empTax = $empSocial + $empMedicare;

            $html = '<table>
                <tr>
                    <td>
                        <p style="margin: 0">' . $companyName . '<br>' . $companyAddress . '</p>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: right">
                        <p style="margin: 0">Pay Stub Detail<br>PAY DATE: ' . date('m/d/Y', strtotime($paycheck->pay_date)) . '<br>NET PAY: ' . $netPay . '</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p style="margin: 0">' . $name . '<br>' . $address . '</p>
                    </td>
                </tr>
            </table>
            <br /><br /><br />';

            $html .= '<table>
                <tr>
                    <td>
                        <p style="margin: 0"><b>EMPLOYER</b><br>' . $companyName . '<br>' . $companyAddress . '</p>
                    </td>
                    <td>
                        <p style="margin: 0"><b>PAY PERIOD</b><br>Period Beginning: ' . date('m/d/Y', strtotime($payroll->pay_period_start)) . '<br>Period Ending: ' . date('m/d/Y', strtotime($payroll->pay_period_end)) . '<br>Pay Date: ' . date('m/d/Y', strtotime($paycheck->pay_date)) . '<br>Total Hours: 0.00</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p style="margin: 0"><b>EMPLOYEE</b><br>' . $name . '<br>' . $address . '</p>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><b>NET PAY: </b><span style="float: right"><b>' . $netPay . '</b></span></td>
                </tr>
                <tr>
                    <td>
                        <p><b>MEMO:</b><br>' . $payrollItem->employee_memo . '</p>
                    </td>
                </tr>
            </table>
            <br /><br /><br />';

            $html .= '<table>
                <tr>
                    <td>
                        <table>
                            <thead>
                                <tr>
                                    <th width="40%"><b>PAY</b></th>
                                    <th width="15%" style="text-align: right"><b>Hours</b></th>
                                    <th width="15%" style="text-align: right"><b>Rate</b></th>
                                    <th width="15%" style="text-align: right"><b>Current</b></th>
                                    <th width="15%" style="text-align: right"><b>YTD</b></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Regular Pay Hours</td>
                                    <td style="text-align: right">' . number_format(floatval(str_replace(',', '', $payrollItem->employee_hours)), 2) . '</td>
                                    <td style="text-align: right">' . number_format($perHourPay, 2) . '</td>
                                    <td style="text-align: right">' . number_format(floatval(str_replace(',', '', $totalPay)), 2) . '</td>
                                    <td style="text-align: right">' . number_format(floatval(str_replace(',', '', $totalPay)), 2) . '</td>
                                </tr>
                                <tr>
                                    <td>Commission</td>
                                    <td style="text-align: right">-</td>
                                    <td style="text-align: right">-</td>
                                    <td style="text-align: right">' . number_format(floatval(str_replace(',', '', $payrollItem->employee_commission)), 2) . '</td>
                                    <td style="text-align: right">' . number_format(floatval(str_replace(',', '', $payrollItem->employee_commission)), 2) . '</td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                    <td>
                        <table>
                            <thead>
                                <tr>
                                    <th width="50%"><b>DEDUCTIONS</b></th>
                                    <th width="25%" style="text-align: right"><b>Current</b></th>
                                    <th width="25%" style="text-align: right"><b>YTD</b></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td style="text-align: right"></td>
                                    <td style="text-align: right"></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            <table>
            <br /><br /><br /><br /><br /><br /><br /><br /><br /><br />';

            $html .= '<table>
                <tr>
                    <td style="padding-top: 20px">
                        <table>
                            <thead>
                                <tr>
                                    <th width="70%"><b>TAXES</b></th>
                                    <th width="15%" style="text-align: right"><b>Current</b></th>
                                    <th width="15%" style="text-align: right"><b>YTD</b></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Federal Income Tax</td>
                                    <td style="text-align: right">0.00</td>
                                    <td style="text-align: right">0.00</td>
                                </tr>
                                <tr>
                                    <td>Social Security</td>
                                    <td style="text-align: right">' . number_format($ssTax, 2) . '</td>
                                    <td style="text-align: right">' . number_format($ssTax, 2) . '</td>
                                </tr>
                                <tr>
                                    <td>Medicare</td>
                                    <td style="text-align: right">' . number_format($medicareTax, 2) . '</td>
                                    <td style="text-align: right">' . number_format($medicareTax, 2) . '</td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                    <td style="padding-top: 20px">
                        <table>
                            <thead>
                                <tr>
                                    <th width="50%"><b>SUMMARY</b></th>
                                    <th width="25%" style="text-align: right"><b>Current</b></th>
                                    <th width="25%" style="text-align: right"><b>YTD</b></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Total Pay</td>
                                    <td style="text-align: right">' . str_replace('$-', '-$', '$' . number_format($paycheck->total_pay, 2)) . '</td>
                                    <td style="text-align: right">' . str_replace('$-', '-$', '$' . number_format($paycheck->total_pay, 2)) . '</td>
                                </tr>
                                <tr>
                                    <td>Taxes</td>
                                    <td style="text-align: right">' . str_replace('$-', '-$', '$' . number_format($payrollItem->employee_taxes, 2)) . '</td>
                                    <td style="text-align: right">' . str_replace('$-', '-$', '$' . number_format($payrollItem->employee_taxes, 2)) . '</td>
                                </tr>
                                <tr>
                                    <td>Deductions</td>
                                    <td style="text-align: right">' . str_replace('$-', '-$', '$' . number_format($deductionsTotal, 2)) . '</td>
                                    <td style="text-align: right">' . str_replace('$-', '-$', '$' . number_format($deductionsTotal, 2)) . '</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td><b>NET PAY</b></td>
                                    <td style="text-align: right"><b>' . $netPay . '</b></td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </td>
                </tr>
            </table>';

            $obj_pdf->AddPage();
            $obj_pdf->writeHTML($html, true, false, true, false, '');
        }

        $obj_pdf->Output(getcwd() . "/assets/pdf/$fileName", 'I');
    }

    public function print_paycheck()
    {
        $this->load->helper('pdf_helper');

        $paycheck = $this->accounting_paychecks_model->get_by_id($this->input->post('paycheck_id'));
        $companyName = $this->invoice_model->getclientsData($paycheck->company_id)->business_name;
        $businessProfile = $this->business_model->getById($paycheck->company_id);

        $companyAddress = !empty($businessProfile->street) ? $businessProfile->street . '<br>' : '';
        $companyAddress .= !empty($businessProfile->city) ? $businessProfile->city : '';
        $companyAddress .= !empty($businessProfile->state) ? ', ' . $businessProfile->state : '';
        $companyAddress .= !empty($businessProfile->postal_code) ? ' ' . $businessProfile->postal_code : '';

        $netPay = number_format(floatval(str_replace(',', '', $paycheck->net_pay)), 2);
        $netPay = str_replace('$-', '-$', '$' . $netPay);

        $employee = $this->users_model->getUser($paycheck->employee_id);
        $name = $employee->FName . ' ' . $employee->LName;

        $address = '';
        $address .= !empty($employee->address) ? $employee->address : '';
        $address .= !empty($employee->city) ? $employee->city : '';
        $address .= !empty($employee->state) ? ', ' . $employee->state : '';
        $address .= !empty($employee->postal_code) ? ' ' . $employee->postal_code : '';

        $payroll = $this->accounting_payroll_model->get_by_id($paycheck->payroll_id);
        $payrollItem = $this->accounting_payroll_model->get_payroll_item($paycheck->payroll_item_id);

        $payscale = $this->users_model->get_payscale_by_id($employee->payscale_id);

        $totalHrs = floatval(str_replace(',', '', $payrollItem->employee_hours));

        if ($payscale->pay_type === 'Hourly') {
            $perHourPay = floatval(str_replace(',', '', $employee->base_hourly));
            $totalPay = floatval(str_replace(',', '', $employee->base_hourly)) * $totalHrs;
        }

        if ($payscale->pay_type === 'Daily') {
            $dailyPay = floatval(str_replace(',', '', $employee->base_daily));
            $hoursPerDay = 8.00;
            $perHourPay = $dailyPay / $hoursPerDay;

            $totalPay = $perHourPay * $totalHrs;
        }

        if ($payscale->pay_type === 'Weekly') {
            $weeklyPay = floatval(str_replace(',', '', $employee->base_weekly));
            $hoursPerWeek = 40.00;
            $perHourPay = $weeklyPay / $hoursPerWeek;

            $totalPay = $perHourPay * $totalHrs;
        }

        if ($payscale->pay_type === 'Monthly') {
            $monthlyPay = floatval(str_replace(',', '', $employee->base_monthly));
            $hoursPerWeek = 40.00;
            $hoursPerMonth = $hoursPerWeek * 4;
            $perHourPay = $monthlyPay / $hoursPerMonth;

            $totalPay = $perHourPay * $totalHrs;
        }

        if ($payscale->pay_type === 'Yearly') {
            $yearlyPay = floatval(str_replace(',', '', $employee->base_yearly));
            $hoursPerWeek = 40.00;
            $hoursPerMonth = $hoursPerWeek * 4;
            $hoursPerYear = $hoursPerMonth * 12;
            $perHourPay = $yearlyPay / $hoursPerYear;

            $totalPay = $perHourPay * $totalHrs;
        }

        $ssTax = (floatval(str_replace(',', '', $payrollItem->employee_total_pay)) / 100) * 6.2;
        $medicareTax = (floatval(str_replace(',', '', $payrollItem->employee_total_pay)) / 100) * 1.45;
        // $empTax = $empSocial + $empMedicare;

        $html = '<table>
            <tr>
                <td>
                    <p style="margin: 0">' . $companyName . '<br>' . $companyAddress . '</p>
                </td>
            </tr>
            <tr>
                <td style="text-align: right">
                    <p style="margin: 0">Pay Stub Detail<br>PAY DATE: ' . date('m/d/Y', strtotime($paycheck->pay_date)) . '<br>NET PAY: ' . $netPay . '</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p style="margin: 0">' . $name . '<br>' . $address . '</p>
                </td>
            </tr>
        </table>
        <br /><br /><br />';

        $html .= '<table>
            <tr>
                <td>
                    <p style="margin: 0"><b>EMPLOYER</b><br>' . $companyName . '<br>' . $companyAddress . '</p>
                </td>
                <td>
                    <p style="margin: 0"><b>PAY PERIOD</b><br>Period Beginning: ' . date('m/d/Y', strtotime($payroll->pay_period_start)) . '<br>Period Ending: ' . date('m/d/Y', strtotime($payroll->pay_period_end)) . '<br>Pay Date: ' . date('m/d/Y', strtotime($paycheck->pay_date)) . '<br>Total Hours: 0.00</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p style="margin: 0"><b>EMPLOYEE</b><br>' . $name . '<br>' . $address . '</p>
                </td>
            </tr>
            <tr>
                <td></td>
                <td><b>NET PAY: </b><span style="float: right"><b>' . $netPay . '</b></span></td>
            </tr>
            <tr>
                <td>
                    <p><b>MEMO:</b><br>' . $payrollItem->employee_memo . '</p>
                </td>
            </tr>
        </table>
        <br /><br /><br />';

        $html .= '<table>
            <tr>
                <td>
                    <table>
                        <thead>
                            <tr>
                                <th width="40%"><b>PAY</b></th>
                                <th width="15%" style="text-align: right"><b>Hours</b></th>
                                <th width="15%" style="text-align: right"><b>Rate</b></th>
                                <th width="15%" style="text-align: right"><b>Current</b></th>
                                <th width="15%" style="text-align: right"><b>YTD</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Regular Pay Hours</td>
                                <td style="text-align: right">' . number_format(floatval(str_replace(',', '', $payrollItem->employee_hours)), 2) . '</td>
                                <td style="text-align: right">' . number_format($perHourPay, 2) . '</td>
                                <td style="text-align: right">' . number_format(floatval(str_replace(',', '', $totalPay)), 2) . '</td>
                                <td style="text-align: right">' . number_format(floatval(str_replace(',', '', $totalPay)), 2) . '</td>
                            </tr>
                            <tr>
                                <td>Commission</td>
                                <td style="text-align: right">-</td>
                                <td style="text-align: right">-</td>
                                <td style="text-align: right">' . number_format(floatval(str_replace(',', '', $payrollItem->employee_commission)), 2) . '</td>
                                <td style="text-align: right">' . number_format(floatval(str_replace(',', '', $payrollItem->employee_commission)), 2) . '</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td>
                    <table>
                        <thead>
                            <tr>
                                <th width="50%"><b>DEDUCTIONS</b></th>
                                <th width="25%" style="text-align: right"><b>Current</b></th>
                                <th width="25%" style="text-align: right"><b>YTD</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td style="text-align: right"></td>
                                <td style="text-align: right"></td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        <table>
        <br /><br /><br /><br /><br /><br /><br /><br /><br /><br />';

        $html .= '<table>
            <tr>
                <td style="padding-top: 20px">
                    <table>
                        <thead>
                            <tr>
                                <th width="70%"><b>TAXES</b></th>
                                <th width="15%" style="text-align: right"><b>Current</b></th>
                                <th width="15%" style="text-align: right"><b>YTD</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Federal Income Tax</td>
                                <td style="text-align: right">0.00</td>
                                <td style="text-align: right">0.00</td>
                            </tr>
                            <tr>
                                <td>Social Security</td>
                                <td style="text-align: right">' . number_format($ssTax, 2) . '</td>
                                <td style="text-align: right">' . number_format($ssTax, 2) . '</td>
                            </tr>
                            <tr>
                                <td>Medicare</td>
                                <td style="text-align: right">' . number_format($medicareTax, 2) . '</td>
                                <td style="text-align: right">' . number_format($medicareTax, 2) . '</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td style="padding-top: 20px">
                    <table>
                        <thead>
                            <tr>
                                <th width="50%"><b>SUMMARY</b></th>
                                <th width="25%" style="text-align: right"><b>Current</b></th>
                                <th width="25%" style="text-align: right"><b>YTD</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Total Pay</td>
                                <td style="text-align: right">' . str_replace('$-', '-$', '$' . number_format($paycheck->total_pay, 2)) . '</td>
                                <td style="text-align: right">' . str_replace('$-', '-$', '$' . number_format($paycheck->total_pay, 2)) . '</td>
                            </tr>
                            <tr>
                                <td>Taxes</td>
                                <td style="text-align: right">' . str_replace('$-', '-$', '$' . number_format($payrollItem->employee_taxes, 2)) . '</td>
                                <td style="text-align: right">' . str_replace('$-', '-$', '$' . number_format($payrollItem->employee_taxes, 2)) . '</td>
                            </tr>
                            <tr>
                                <td>Deductions</td>
                                <td style="text-align: right">' . str_replace('$-', '-$', '$' . number_format($deductionsTotal, 2)) . '</td>
                                <td style="text-align: right">' . str_replace('$-', '-$', '$' . number_format($deductionsTotal, 2)) . '</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td><b>NET PAY</b></td>
                                <td style="text-align: right"><b>' . $netPay . '</b></td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </td>
            </tr>
        </table>';

        $title = "Paycheck";

        tcpdf();
        $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $obj_pdf->SetTitle($title);
        $obj_pdf->setPrintHeader(false);
        $obj_pdf->setPrintFooter(false);
        $obj_pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $obj_pdf->SetDefaultMonospacedFont('helvetica');
        $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $obj_pdf->SetMargins(PDF_MARGIN_LEFT, 0, PDF_MARGIN_RIGHT);
        $obj_pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
        $obj_pdf->SetFont('helvetica', '', 10);
        $obj_pdf->setFontSubsetting(false);
        $obj_pdf->AddPage();
        ob_end_clean();
        $obj_pdf->writeHTML($html, true, false, true, false, '');
        $obj_pdf->Output(getcwd() . "/assets/pdf/$fileName", 'I');
    }

    public function delete_paycheck($paycheckId)
    {
        $delete = $this->accounting_paychecks_model->delete($paycheckId);

        echo json_encode([
            'success' => $delete
        ]);
    }

    public function void_paycheck($paycheckId)
    {
        $void = $this->accounting_paychecks_model->void_paycheck($paycheckId);

        echo json_encode([
            'success' => $void
        ]);
    }

    public function get_voided_paychecks()
    {
        $voided_paychecks = $this->accounting_paychecks_model->get_voided_paychecks(logged('company_id'));

        if ($voided_paychecks !== false) {
            echo json_encode([
                'success' => true,
                'data' => $voided_paychecks
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'No voided paychecks found.'
            ]);
        }
    }

    public function edit_paycheck($paycheckId)
    {

    }

    public function ajax_update_leave_credits()
    {
        $this->load->model('EmployeeLeaveCredit_model');
        $this->load->model('Users_model');

        $is_success = 0;
        $msg = 'Record not found';

        $cid  = logged('company_id');
        $uid  = logged('id');
        $post = $this->input->post();

        $user = $this->Users_model->get_user_name($uid);

        foreach($post['leaveCredits'] as $lid => $value){
            $leaveCredits =  $this->EmployeeLeaveCredit_model->getByUserIdAndPtoId($uid, $lid);
            if( $leaveCredits ){
                $data = [
                    'leave_credits' => $value,
                    'date_updated' => date("Y-m-d H:i:s")
                ];
                $this->EmployeeLeaveCredit_model->update($leaveCredits->id, $data);
            }else{
                $data = [
                    'user_id' => $uid,
                    'pto_id' => $lid,
                    'leave_credits' => $value,
                    'date_created' => date("Y-m-d H:i:s")
                ];
                $this->EmployeeLeaveCredit_model->create($data);
            }

            //Activity Logs
            $name = $user->FName . ' ' . $user->LName;
            $activity_name = 'Leave Credits : Updated '.$name.' leave credits'; 
            createActivityLog($activity_name);

            $is_success = 1;
            $msg = '';
            
        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
    }

    public function saveTaxWithholding() {
        $company_id = logged('company_id');
        $employee_id = logged('id');

        $postData = $this->input->post();
        $postData['company_id'] = $company_id;
        $postData['employee_id'] = $employee_id;

        $saveTaxWithholdingDetails = $this->employment_details_model->createTaxWithholding($postData);
        print_r($postData);
    }
}
