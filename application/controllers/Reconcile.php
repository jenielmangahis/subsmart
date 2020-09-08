<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reconcile extends MY_Controller {

	public function __construct()
    {
		parent::__construct();
		$this->checkLogin();
        add_css(array(
            "assets/css/accounting/banking.css?v='rand()'",
            "assets/css/accounting/accounting.modal.css?v='rand()'",
            "assets/css/accounting/sidebar.css",
			"assets/css/accounting/sales.css",
            "assets/plugins/dropzone/dist/dropzone.css"
        ));

        add_footer_js(array(
            "assets/js/accounting/main.js",
            "assets/plugins/dropzone/dist/dropzone.js"
        ));

		$this->page_data['menu_name'] =
			array(
				array("Dashboard",	array()),
				array("Banking", 	array('Link Bank','Rules','Receipts')),
				array("Expenses", 	array('Expenses','Vendors')),
				array("Sales", 		array('Overview','All Sales','Invoices','Customers','Deposits','Products and Services')),
				array("Payroll", 	array('Overview','Employees','Contractors',"Workers' Comp",'Benifits')),
				array("Reports",	array()),
				array("Taxes",		array("Sales Tax","Payroll Tax")),
				array("Mileage",	array()),
				array("Accounting",	array("Chart of Accounts","Reconcile"))
			); 
		$this->page_data['menu_link'] = 
			array(
				array('/accounting/banking',array()), 
				array("",	array('/accounting/link_bank','/accounting/rules','/accounting/receipts')), 
				array("",	array('/accounting/expenses','/accounting/vendors')), 
				array("",	array('/accounting/sales-overview','/accounting/all-sales','/accounting/invoices','/accounting/customers','/accounting/deposits','/accounting/products-and-services')), 
				array("",	array('#','#','#','#','#')), 
				array('#',	array()), 
				array("",	array('#','#')), 
				array('#',	array()), 
				array("",	array('/accounting/chart_of_accounts','#')), 
			); 
		$this->page_data['menu_icon'] = array("fa-tachometer","fa-university","fa-credit-card","fa-money","fa-dollar","fa-bar-chart","fa-minus-circle","fa-file","fa-calculator"); 
    }
	
	public function index($id)
	{
		$this->page_data['alert'] = 'accounting/alert_promt';
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
		$this->page_data['rows']  =  $this->reconcile_model->selectonwhere($id);
		$this->load->view('accounting/reconcile', $this->page_data);
	}

		public function indexmain()
	{
		$this->page_data['alert'] = 'accounting/alert_promt';
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
		$this->load->view('accounting/reconcile/index', $this->page_data);
	}

	public function add()
	{
		$this->page_data['alert'] = 'accounting/alert_promt';
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
		$this->load->view('accounting/reconcile/add', $this->page_data);
	}

	public function addReconcile()
	{
		$chart_of_accounts_id=$this->input->post('chart_of_accounts_id');
        $ending_balance=$this->input->post('ending_balance');
        $ending_date=$this->input->post('ending_date');
        $first_date=$this->input->post('first_date');
        $service_charge=$this->input->post('service_charge');
        $expense_account=$this->input->post('expense_account');
        $second_date=$this->input->post('second_date');
        $interest_earned=$this->input->post('interest_earned');
        $income_account=$this->input->post('income_account');

        $this->reconcile_model->saverecords($chart_of_accounts_id,$ending_balance,$ending_date,$first_date,$service_charge,$expense_account,$second_date,$interest_earned,$income_account);
        
        $this->session->set_flashdata('success', "Data inserted successfully!"); 
        redirect("accounting/reconcile");
	}

	public function edit($id)
	{
		$this->page_data['alert'] = 'accounting/alert_promt';
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['reconcile'] = $this->reconcile_model->getById($id);
		$this->load->view('accounting/reconcile/edit', $this->page_data);
	}

	public function update($id)
	{
		$id=$id;
		$chart_of_accounts_id=$this->input->post('chart_of_accounts_id');
        $ending_balance=$this->input->post('ending_balance');
        $ending_date=$this->input->post('ending_date');
        $first_date=$this->input->post('first_date');
        $service_charge=$this->input->post('service_charge');
        $expense_account=$this->input->post('expense_account');
        $second_date=$this->input->post('second_date');
        $interest_earned=$this->input->post('interest_earned');
        $income_account=$this->input->post('income_account');

        $this->reconcile_model->updaterecords($id,$chart_of_accounts_id,$ending_balance,$ending_date,$first_date,$service_charge,$expense_account,$second_date,$interest_earned,$income_account);
		
	}

	public function do_upload($id)
    {
            $config['upload_path']          = './uploads/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg|jpe|pdf|doc|docx|rtf|text|txt';
            $config['max_size'] = 1024 * 8;
    		$config['encrypt_name'] = TRUE;
		    $config['max_width'] = '1024';
		    $config['max_height'] = '1024';

            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('userfile'))
            {
                    $error = array('error' => $this->upload->display_errors());

                    //$this->load->view('accounting/upload_success', $error);
            }
            else
            {
                    $data = array('upload_data' => $this->upload->data());
            		$success = array('success' => "successfully added");
                    //$this->load->view('accounting/upload_success', $success);
            }
        $this->index($id);
    }

    public function delete()
    {
    	$id = $this->input->post('id');
        $this->reconcile_model->delete($id);
    }

    public function report($id)
    {
    	$this->page_data['alert'] = 'accounting/alert_promt';
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['rows']  =  $this->reconcile_model->selectonwhere($id);
		$this->load->view('accounting/reconcile/report', $this->page_data);
    }

    public function summary()
    {
        $this->page_data['alert'] = 'accounting/alert_promt';
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['rows']  =  $this->reconcile_model->selectsummary();
        $this->load->view('accounting/reconcile/summary', $this->page_data);
    }

    public function adjustment_date()
    {
        $id=$this->input->post('id');
        $adjustment_date=$this->input->post('adjustment_date');
        $this->reconcile_model->updatesingle($id,$adjustment_date);
    }

    public function fetch_ending_date()
    {
        if($this->input->post('chart_of_accounts_id'))
        {
            echo $this->reconcile_model->fetch_ending_date($this->input->post('chart_of_accounts_id'));
        }
    }

    public function reportajax($id)
    {
        $rows  =  $this->reconcile_model->selectonwhere($id);
        $html = "";
        foreach ($rows as $row) {
        $accBalance = $this->chart_of_accounts_model->getBalance($row->chart_of_accounts_id);
        $adjustment = $row->ending_balance-(($accBalance-$row->service_charge)+$row->interest_earned);
        $html .= "<div class='row'><div class='col-xl-12'><div class='card'><div class='card-body'><div class='row'><div class='col-md-4'></div><div class='col-md-4'></div><div class='col-md-3'></div><div class='col-md-1 form-group'><div class='dropdown'><a href='#' onclick = 'window.print()'><i class='fa fa-print'></i></a></div></div></div><div style='text-align: center;margin-bottom: 10px;'><div class='row'><div class='col-md-12'>ADI</div></div><div class='row'><div class='col-md-12'>".$this->chart_of_accounts_model->getName($row->chart_of_accounts_id).",Period Ending ".$row->ending_date."</div></div><div class='row'><div class='col-md-12'>RCONCILATION REPORT</div></div><div class='row'><div class='col-md-12'>Reconciled on : ".$row->adjustment_date."</div></div><div class='row'><div class='col-md-12'>Reconciled by : -</div></div></div>Any changes made to transactions after this date aren't included in this report. <div class='line'></div><div class='row' style='margin-top: 10px;'><div class='col-md-2'>Summary</div><div class='col-md-9'></div><div class='col-md-1'>USD</div></div><div class='row'><div class='col-md-3'>Statement beginning balance</div><div class='col-md-8 dott'></div><div class='col-md-1'>".number_format($accBalance,1)."</div></div><div class='row'> <div class='col-md-2'>Service Charge</div><div class='col-md-9 dott'></div><div class='col-md-1'>-".number_format($row->service_charge,1)."</div></div><div class='row'><div class='col-md-2'>Interest Earned</div><div class='col-md-9 dott'></div><div class='col-md-1'>".number_format($row->interest_earned,1)."</div></div><div class='row'>    <div class='col-md-3'>Checks & payment cleared(0)</div><div class='col-md-8 dott'></div><div class='col-md-1'>0.00</div></div><div class='row'><div class='col-md-3'>Deposit & other credit cleared(0)</div><div class='col-md-8 dott'></div><div class='col-md-1'>0.00</div></div><div class='row'><div class='col-md-2'>Adjustment</div><div class='col-md-9 dott'></div><div class='col-md-1'>".number_format($adjustment, 1)."</div></div><div class='row'><div class='col-md-3'>Statement ending balance</div><div class='col-md-8 dott'></div><div class='col-md-1'>".number_format($row->ending_balance, 1)."</div></div><div class='row'><div class='col-md-11'></div><div class='col-md-1'>======</div></div><div class='row'><div class='col-md-3'>Register balance as of ".$row->ending_date."</div><div class='col-md-8 dott'></div><div class='col-md-1'>".number_format($row->ending_balance, 1)."</div></div></div></div></div></div>";
        }
        echo $html;
    }
}