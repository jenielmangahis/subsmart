<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employees extends MY_Controller {
	
	public function __construct()
    {
		parent::__construct();
        $this->checkLogin();
        $this->load->model('PayScale_model');

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

    public function add()
    {
        $role_id = logged('role');
		if( $role_id == 1 || $role_id == 2 ){
			$this->page_data['payscale'] = $this->PayScale_model->getAll();
		}else{
			$this->page_data['payscale'] = $this->PayScale_model->getAllByCompanyId($cid);
		}

        $this->load->view('accounting/employees/add_employee', $this->page_data);
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

        if($last_id) {
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

        $this->page_data['employee'] = $this->users_model->getUser($id);
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
        $this->load->view('accounting/employees/add_pay_schedule');
    }

    public function add_pay_schedule()
    {
        if(in_array($this->input->post('pay_frequency'), ['every-week', 'every-other-week'])) {
            $nextPayDay = date('Y-m-d', strtotime($this->input->post('next_payday')));
            $nextPayPeriodEnd = date('Y-m-d', strtotime($this->input->post('next_pay_period_end')));
        } 
        else {
            if($this->input->post('custom_schedule') === 'on') {
                $nextPayDay = null;
                $nextPayPeriodEnd = null;
            } else {
                $nextPayDay = date('Y-m-d', strtotime($this->input->post('next_payday')));
                $nextPayPeriodEnd = date('Y-m-d', strtotime($this->input->post('next_pay_period_end')));
            }
        }

        $data = [
            'company_id' => logged('company_id'),
            'pay_frequency' => $this->input->post('pay_frequency'),
            'next_payday' => $nextPayDay,
            'next_pay_period_end' => $nextPayPeriodEnd,
            'name' => $this->input->post('name'),
            'first_payday' => $this->input->post('custom_schedule') === 'on' ? $this->input->post('first_payday') : null,
            'end_of_first_pay_period' => $this->input->post('custom_schedule') === 'on' ? $this->input->post('end_of_first_pay_period') : null,
            'first_pay_month' => $this->input->post('custom_schedule') === 'on' && $this->input->post('end_of_first_pay_period') === 'end-date' ? $this->input->post('end_of_first_pay_period') : null,
            'first_pay_day' => $this->input->post('custom_schedule') === 'on' && $this->input->post('end_of_first_pay_period') === 'end-date' ? $this->input->post('first_pay_day') : null,
            // 'first_pay_days_before' => $this->input->post('custom_schedule') === 'on' && $this->input->post('end_of_first_pay_period') !== 'end-date' ? $this->input->post('') :
            'second_payday' => $this->input->post('custom_schedule') === 'on' && $this->input->post('pay_frequency') === 'twice-month' ? $this->input->post('second_payday') : null,
            'end_of_second_pay_period' => $this->input->post('custom_schedule') === 'on' && $this->input->post('pay_frequency') === 'twice-month' ?$this->input->post('end_of_second_pay_period') : null,
            'second_pay_month' => $this->input->post('custom_schedule') === 'on' && $this->input->post('pay_frequency') === 'twice-month' && $this->input->post('end_of_second_pay_period') === 'end-date' ?$this->input->post('second_pay_month') : null,
            'second_pay_day' => $this->input->post('custom_schedule') === 'on' && $this->input->post('pay_frequency') === 'twice-month' && $this->input->post('end_of_second_pay_period') === 'end-date' ?$this->input->post('second_pay_day') : null,
            'use_for_new_employees' => $this->input->post('use_for_new_employees'),
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $insert = $this->users_model->addPaySchedule($data);

        $return = [
            'data' => $insert,
            'success' => $insert ? true : false,
            'message' => $insert ? 'Success!' : 'Error!'
        ];

        echo json_encode($return);
    }
}