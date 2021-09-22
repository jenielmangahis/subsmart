<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reconcile extends MY_Controller {

	public function __construct()
    {
		parent::__construct();
		$this->checkLogin();
        $this->hasAccessModule(45);
        $this->load->model('accounting_customers_model');
        $this->load->model('accounting_invoices_model');
        add_css(array(
            "assets/css/accounting/banking.css?v=".rand(),
            "assets/css/accounting/accounting.css",
            "assets/css/accounting/accounting.modal.css?v=".rand(),
            "assets/css/accounting/sidebar.css",
            "assets/css/accounting/sales.css",
            "assets/plugins/dropzone/dist/dropzone.css",
            "assets/css/accounting/accounting-modal-forms.css",
            "assets/plugins/jquery-toast-plugin-master/dist/jquery.toast.min.css",
            "assets/css/accounting/accounting_includes/receive_payment.css",
            "assets/css/accounting/accounting_includes/customer_sales_receipt_modal.css",
            "assets/css/accounting/accounting_includes/create_charge.css",
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
        ));

		$this->page_data['menu_name'] =
            array(
                // array("Dashboard",	array()),
                // array("Banking", 	array('Link Bank','Rules','Receipts','Tags')),
                array("Cash Flow",   array()),
                array("Expenses",   array('Expenses','Vendors')),
                array("Sales",      array('Overview','All Sales','Estimates','Customers','Deposits','Work Order','Invoice','Jobs')),
                array("Payroll",    array('Overview','Employees','Contractors',"Workers' Comp",'Benifits')),
                array("Reports",    array()),
                array("Taxes",      array("Sales Tax","Payroll Tax")),
                // array("Mileage",    array()),
                array("Accounting", array("Chart of Accounts","Reconcile"))
            );
        $this->page_data['menu_link'] =
            array(
                // array('/accounting/banking',array()),
                // array("",	array('/accounting/link_bank','/accounting/rules','/accounting/receipts','/accounting/tags')),
                array('/accounting/cashflowplanner',array()),
                array("",	array('/accounting/expenses','/accounting/vendors')),
                array("",	array('/accounting/sales-overview','/accounting/all-sales','/accounting/newEstimateList','/accounting/customers','/accounting/deposits','/accounting/listworkOrder','/accounting/invoices', '/accounting/jobs')),
                array("",	array('/accounting/payroll-overview','/accounting/employees','/accounting/contractors','/accounting/workers-comp','#')),
                array('/accounting/reports',array()),
                array("",   array('/accounting/salesTax','/accounting/payrollTax')),
                // array('#',  array()),
                array("",   array('/accounting/chart-of-accounts','/accounting/reconcile')),
            );
        $this->page_data['menu_icon'] = array("fa-credit-card","fa-money","fa-dollar","fa-bar-chart","fa-minus-circle","fa-file","fa-calculator");
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

    public function update_pg($id)
    {
        $id=$id;
        $first_date=$this->input->post('first_date');
        $CHRG=$this->input->post('SVCCHRG');
        $service_charge=$this->input->post('service_charge');
        $payee_name=$this->input->post('payee_name');
        $memo_sc=$this->input->post('memo_sc');
        $expense_account=$this->input->post('expense_account');

        $this->reconcile_model->updatepgrecords($id,$first_date,$service_charge,$expense_account,$CHRG,$memo_sc);
        
    }

    public function update_pg2($id)
    {
        $id=$id;
        $second_date=$this->input->post('second_date');
        $interest_earned=$this->input->post('interest_earned');
        $memo_it=$this->input->post('memo_it');
        $income_account=$this->input->post('income_account');

        $this->reconcile_model->updatepg2records($id,$second_date,$interest_earned,$income_account,$memo_it);
        
    }

    public function do_upload($id)
    {
            $config['upload_path']          = './uploads/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg|jpe|pdf|doc|docx|rtf|text|txt';
            $config['max_size'] = 1024 * 8;
            $config['encrypt_name'] = TRUE;
            $config['max_width'] = '1024';
            $config['max_height'] = '1024';

            
            $reconcile_id=$this->input->post('reconcile_id');
            $subfix=$this->input->post('subfix');
            $filepath = $config['upload_path'];

            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('userfile_'.$subfix))
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
            $upload_data = $this->upload->data(); 
            $filename = $upload_data['file_name'];
            $fileexe = pathinfo($filename, PATHINFO_EXTENSION);
            $filedate = date('Y-d-m');

            $this->reconcile_model->uploadfile($reconcile_id,$id,$filename,$filepath,$fileexe,$filedate);

            $this->index($id);
    }

	public function do_upload2($id)
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
            redirect('accounting/reconcile/view/history');
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
        $this->page_data['rows']  =  $this->reconcile_model->selectonwherewithinactive($id);
		$this->load->view('accounting/reconcile/report', $this->page_data);
    }

    public function report_print($id)
    {
        $this->page_data['alert'] = 'accounting/alert_promt';
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['rows']  =  $this->reconcile_model->selectonwherewithinactive($id);
        $this->load->view('accounting/reconcile/report_print', $this->page_data);
    }

    public function summary()
    {
        $this->page_data['alert'] = 'accounting/alert_promt';
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['rows']  =  $this->reconcile_model->selectsummary();
        $this->load->view('accounting/reconcile/summary', $this->page_data);
    }
    
    public function history_by_account()
    {
        $this->page_data['alert'] = 'accounting/alert_promt';
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->load->view('accounting/reconcile/history_by_account', $this->page_data);
    }

    public function export_csv(){ 
        // file name 
        $filename = 'summary_'.date('Ymd').'.csv'; 
        header("Content-Description: File Transfer"); 
        header("Content-Disposition: attachment; filename=$filename"); 
        header("Content-Type: application/csv; ");
       // get data 
        $rows = $this->reconcile_model->selectsummary();
        // file creation 
        $file = fopen('php://output','w');
        $header = array("ACCOUNT","TYPE","STATEMENT ENDING DATE","RECONCILED ON"); 
        fputcsv($file, $header);
        foreach ($rows as $row){ 
            $array=[];
            array_push($array, $this->chart_of_accounts_model->getName($row->chart_of_accounts_id),$this->chart_of_accounts_model->getName($row->chart_of_accounts_id),$row->ending_date,$row->adjustment_date);
            fputcsv($file, $array);
        }
        
        fclose($file); 
        exit; 
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
        $rows  =  $this->reconcile_model->selectonwherewithinactive($id);
        $html = "";
        foreach ($rows as $row) {
        $accBalance = $this->chart_of_accounts_model->getBalance($row->chart_of_accounts_id);
        $adjustment = $row->ending_balance-(($accBalance-$row->service_charge)+$row->interest_earned);
        $html .= "<div class='row'><div class='col-xl-12'><div class='card'><div class='card-body'><div class='row'><div class='col-md-4'></div><div class='col-md-4'></div><div class='col-md-3'></div><div class='col-md-1 form-group'><div class='dropdown'><a href='#' onclick = 'window.print()'><i class='fa fa-print'></i></a></div></div></div><div style='text-align: center;margin-bottom: 10px;'><div class='row'><div class='col-md-12'>ADI</div></div><div class='row'><div class='col-md-12'>".$this->chart_of_accounts_model->getName($row->chart_of_accounts_id).",Period Ending ".$row->ending_date."</div></div><div class='row'><div class='col-md-12'>RCONCILATION REPORT</div></div><div class='row'><div class='col-md-12'>Reconciled on : ".$row->adjustment_date."</div></div><div class='row'><div class='col-md-12'>Reconciled by : -</div></div></div>Any changes made to transactions after this date aren't included in this report. <div class='line'></div><div class='row' style='margin-top: 10px;'><div class='col-md-2'>Summary</div><div class='col-md-9'></div><div class='col-md-1'>USD</div></div><div class='row'><div class='col-md-3'>Statement beginning balance</div><div class='col-md-8 dott'></div><div class='col-md-1'>".number_format($accBalance,1)."</div></div><div class='row'> <div class='col-md-2'>Service Charge</div><div class='col-md-9 dott'></div><div class='col-md-1'>-".number_format($row->service_charge,1)."</div></div><div class='row'><div class='col-md-2'>Interest Earned</div><div class='col-md-9 dott'></div><div class='col-md-1'>".number_format($row->interest_earned,1)."</div></div><div class='row'>    <div class='col-md-3'>Checks & payment cleared(0)</div><div class='col-md-8 dott'></div><div class='col-md-1'>0.00</div></div><div class='row'><div class='col-md-3'>Deposit & other credit cleared(0)</div><div class='col-md-8 dott'></div><div class='col-md-1'>0.00</div></div><div class='row'><div class='col-md-2'>Adjustment</div><div class='col-md-9 dott'></div><div class='col-md-1'>".number_format($adjustment, 1)."</div></div><div class='row'><div class='col-md-3'>Statement ending balance</div><div class='col-md-8 dott'></div><div class='col-md-1'>".number_format($row->ending_balance, 1)."</div></div><div class='row'><div class='col-md-11'></div><div class='col-md-1'>======</div></div><div class='row'><div class='col-md-3'>Register balance as of ".$row->ending_date."</div><div class='col-md-8 dott'></div><div class='col-md-1'>".number_format($row->ending_balance, 1)."</div></div></div></div></div></div>";
        }
        echo $html;
    }

    public function history()
    {
        $this->page_data['alert'] = 'accounting/alert_promt';
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['rows']  =  $this->reconcile_model->selectsummary();
        $this->load->view('accounting/reconcile/history', $this->page_data);
    }

    public function historyajax($chart_of_accounts_id)
    {
        $rows  =  $this->reconcile_model->selecthistorywhere($chart_of_accounts_id);
        $html = "";
        $i=0;
        foreach ($rows as $row) {

        $accBalance = $this->chart_of_accounts_model->getBalance($row->chart_of_accounts_id);
        $adjustment = $row->ending_balance-(($accBalance-$row->service_charge)+$row->interest_earned);
        $name=$this->chart_of_accounts_model->getName($row->chart_of_accounts_id);

        $html .= "<tr><td>".$row->ending_date."</td><td>".$row->adjustment_date."</td><td>".$row->ending_balance."</td><td>0.00</td><td>".number_format($adjustment,2)."</td><td><a href='#' onclick='openSideNav3('".$name."')'>Attach</a></td><td><div class='dropdown show'><a class='dropdown-toggle' href=".url('accounting/reconcile/view/report/').$row->chart_of_accounts_id." id='dropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><a href=".url('accounting/reconcile/view/report/').$row->chart_of_accounts_id.">View Report</a></a><div class='dropdown-menu' aria-labelledby='dropdownMenuLink'><a class='dropdown-item' href=".url('accounting/reconcile/view/report_print/').$row->chart_of_accounts_id." >Print</a></div></div></td></tr>";
        $i++;
        }
        echo $html;
    }

    public function showData()
    {
        $datas = array();
        
        //get files from database
        $datas['files'] = $this->reconcile_model->getUploads();
        
        //load the view
        $html = "";
        //print_r($datas);die();
        foreach ($datas['files'] as $data) {

        $html .= "<div class='existing-box'>
                    <h4>".$data['filename']." <span>".$data['filedate']."</span></h4>";
                    if($data['fileexe']=='jpg' || $data['fileexe']=='jpeg' || $data['fileexe']=='png'){
                    $html .="<div class='priview-img'>
                        <img src='". base_url().'uploads/'.$data['filename']."' alt='' style='    max-height: 64px;max-width: 64px;'>
                    </div>";
                    }else{
                    $html .="<div class='priview-img'>
                        <img src='". base_url().'uploads/'.$data['filename']."' alt='' style='    max-height: 64px;max-width: 64px;'>
                    </div>";
                    }
                    $html .="<div class='act-br'>";
                        if($data['fileexe']=='jpg' || $data['fileexe']=='jpeg' || $data['fileexe']=='png'){
                            //$html .="<a href='". base_url().'accounting/reconcile/view/download/'.$data['id']."' class='txbtn previewbtn'>Preview</a>";
                             $html .="<a href='#preview' onClick='show_preview(".$data['id'].")' class='txbtn previewbtn' data-toggle='modal' data-target='#previewModal' data-image='".$data['filename']."' id='previewid_".$data['id']."'>Preview</a>";
                            }else{
                                $html .="<a href='". base_url().'accounting/reconcile/view/download/'.$data['id']."' class='txbtn previewbtn'>Download</a>";
                                }
                                $html .="</div>
                </div>";
        }
        echo $html;

    }

    public function download($id){
        if(!empty($id)){
            //load download helper
            $this->load->helper('download');
            
            //get file info from database
            $fileInfo = $this->reconcile_model->getUploads(array('id' => $id));
            
            //file path
            $file = 'uploads/'.$fileInfo['filename'];
            
            //download file from directory
            force_download($file, NULL);
        }
    }

    public function insert_servicecharge()
    {
        $reconcile_id=$this->input->post('reconcile_id');
        $chart_of_accounts_id=$this->input->post('chart_of_accounts_id');
        $expense_account_sub=$this->input->post('expense_account_sub');
        $service_charge_sub=$this->input->post('service_charge_sub');
        $descp_sc_sub=$this->input->post('descp_sc_sub');
        $this->reconcile_model->save_service($reconcile_id,$chart_of_accounts_id,$expense_account_sub,$service_charge_sub,$descp_sc_sub);
        /*$data_tab=$this->input->post('data_tab');
        $myArray = json_decode(json_encode($data_tab), true);
        foreach ($myArray as $key => $val) {
          $this->reconcile_model->save_service();
        }*/
    }

    public function update_servicecharge()
    {
        $id=$this->input->post('id');
        $reconcile_id=$this->input->post('reconcile_id');
        $chart_of_accounts_id=$this->input->post('chart_of_accounts_id');
        $expense_account_sub=$this->input->post('expense_account_sub');
        $service_charge_sub=$this->input->post('service_charge_sub');
        $descp_sc_sub=$this->input->post('descp_sc_sub');
        $this->reconcile_model->update_service($id,$expense_account_sub,$service_charge_sub,$descp_sc_sub);
    }

    public function update_sc()
    {
        $reconcile_id=$this->input->post('reconcile_id');
        $mailing_address=$this->input->post('mailing_address');
        $first_date=$this->input->post('date_popup');
        $checkno=$this->input->post('checkno');
        $memo_sc=$this->input->post('memo_sc');
        $descp_sc=$this->input->post('descp_sc');
        $expense_account=$this->input->post('expense_account');
        $service_charge=$this->input->post('service_charge');
        $this->reconcile_model->update_sc_records($reconcile_id,$mailing_address,$first_date,$checkno,$memo_sc,$descp_sc,$expense_account,$service_charge);
        
    }

    public function remove_sc()
    {
        $id=$this->input->post('id');

        $this->reconcile_model->remove_sc_records($id);
        
    }

    public function update_pg_sc($id)
    {
        $id=$id;
        $scid=$this->input->post('scid');
        $first_date=$this->input->post('first_date');
        $checkno=$this->input->post('checkno');
        $payee_name=$this->input->post('payee_name');
        $service_charge_sub=$this->input->post('service_charge_sub');
        $descp_sc_sub=$this->input->post('descp_sc_sub');
        $expense_account_sub=$this->input->post('expense_account_sub');

        $this->reconcile_model->updatepgscrecords($id,$scid,$first_date,$checkno,$service_charge_sub,$expense_account_sub,$descp_sc_sub);
        
    }

    public function recurr_save()
    {
        $reconcile_id=$this->input->post('reconcile_id');
        $chart_of_accounts_id=$this->input->post('chart_of_accounts_id');
        $template_name=$this->input->post('template_name');
        $template_type=$this->input->post('template_type');
        $template_interval=$this->input->post('template_interval');
        $advanced_day=$this->input->post('advanced_day');
        $day=$this->input->post('day');
        $dayname=$this->input->post('dayname');
        $daynum=$this->input->post('daynum');
        $weekday=$this->input->post('weekday');
        $weekname=$this->input->post('weekname');
        $monthday=$this->input->post('monthday');
        $monthname=$this->input->post('monthname');
        $startdate=$this->input->post('startdate');
        $endtype=$this->input->post('endtype');
        $enddate=$this->input->post('enddate');
        $occurrence=$this->input->post('occurrence');
        $payeename=$this->input->post('payeename');
        $account_type=$this->input->post('account_type');
        $payment_date=$this->input->post('payment_date');
        $mailing_address=$this->input->post('mailing_address');
        $checkno=$this->input->post('checkno');
        $permitno=$this->input->post('permitno');
        $memo_recurr_sc=$this->input->post('memo_recurr_sc');

        echo $this->reconcile_model->recurr_save($reconcile_id,$chart_of_accounts_id,$template_name,$template_type,$template_interval,$advanced_day,$day,$dayname,$daynum,$weekday,$weekname,$monthday,$monthname,$startdate,$endtype,$enddate,$occurrence,$payeename,$account_type,$payment_date,$mailing_address,$checkno,$permitno,$memo_recurr_sc);
    }

    public function insert_recurr_servicecharge()
    {
        $mainid=$this->input->post('mainid');
        $reconcile_id=$this->input->post('reconcile_id');
        $chart_of_accounts_id=$this->input->post('chart_of_accounts_id');
        $expense_account_sub=$this->input->post('expense_account_sub');
        $service_charge_sub=$this->input->post('service_charge_sub');
        $descp_sc_sub=$this->input->post('descp_sc_sub');
        $this->reconcile_model->save_recurr_service($mainid,$reconcile_id,$chart_of_accounts_id,$expense_account_sub,$service_charge_sub,$descp_sc_sub);
        
    }

    public function update_recurr_servicecharge()
    {
        $id=$this->input->post('id');
        $reconcile_id=$this->input->post('reconcile_id');
        $chart_of_accounts_id=$this->input->post('chart_of_accounts_id');
        $expense_account_sub=$this->input->post('expense_account_sub');
        $service_charge_sub=$this->input->post('service_charge_sub');
        $descp_sc_sub=$this->input->post('descp_sc_sub');
        $this->reconcile_model->update_recurr_service($id,$expense_account_sub,$service_charge_sub,$descp_sc_sub);
    }

    public function remove_sc_recurr()
    {
        $id=$this->input->post('id');

        $this->reconcile_model->remove_sc_recurr_records($id);
        
    }

    public function check_save()
    {
        $reconcile_id=$this->input->post('reconcile_id');
        $chart_of_accounts_id=$this->input->post('chart_of_accounts_id');
        $check_payee_popup=$this->input->post('check_payee_popup');
        $check_account_popup=$this->input->post('check_account_popup');
        $mailing_address=$this->input->post('mailing_address');
        $date_popup=$this->input->post('date_popup');
        $checkno=$this->input->post('checkno');
        $permitno=$this->input->post('permitno');
        $memo_sc=$this->input->post('memo_sc');
        

        echo $this->reconcile_model->check_save($reconcile_id,$chart_of_accounts_id,$check_payee_popup,$check_account_popup,$mailing_address,$checkno,$permitno,$memo_sc);
    }

    public function insert_check_servicecharge()
    {
        $mainid=$this->input->post('mainid');
        $reconcile_id=$this->input->post('reconcile_id');
        $chart_of_accounts_id=$this->input->post('chart_of_accounts_id');
        $expense_account_sub=$this->input->post('expense_account_sub');
        $service_charge_sub=$this->input->post('service_charge_sub');
        $descp_sc_sub=$this->input->post('descp_sc_sub');
        $this->reconcile_model->save_check_service($mainid,$reconcile_id,$chart_of_accounts_id,$expense_account_sub,$service_charge_sub,$descp_sc_sub);
        
    }

    public function remove_sc_check()
    {
        $id=$this->input->post('id');

        $this->reconcile_model->remove_sc_check_records($id);
        
    }

    public function insert_interestearned()
    {
        $reconcile_id=$this->input->post('reconcile_id');
        $chart_of_accounts_id=$this->input->post('chart_of_accounts_id');
        $income_account_sub=$this->input->post('income_account_sub');
        $interest_earned_sub=$this->input->post('interest_earned_sub');
        $descp_it_sub=$this->input->post('descp_it_sub');
        $this->reconcile_model->save_interest($reconcile_id,$chart_of_accounts_id,$income_account_sub,$interest_earned_sub,$descp_it_sub);
    }

    public function update_interestearned()
    {
        $id=$this->input->post('id');
        $reconcile_id=$this->input->post('reconcile_id');
        $chart_of_accounts_id=$this->input->post('chart_of_accounts_id');
        $income_account_sub=$this->input->post('income_account_sub');
        $interest_earned_sub=$this->input->post('interest_earned_sub');
        $descp_it_sub=$this->input->post('descp_it_sub');
        $this->reconcile_model->update_interest($id,$income_account_sub,$interest_earned_sub,$descp_it_sub);
    }

    public function update_it()
    {
        $reconcile_id=$this->input->post('reconcile_id');
        $second_date=$this->input->post('date_popup');
        $memo_it=$this->input->post('memo_it');
        $descp_it=$this->input->post('descp_it');
        $income_account=$this->input->post('income_account');
        $interest_earned=$this->input->post('interest_earned');
        $cash_back_account=$this->input->post('cash_back_account');
        $cash_back_memo=$this->input->post('cash_back_memo');
        $cash_back_amount=$this->input->post('cash_back_amount');
        $this->reconcile_model->update_it_records($reconcile_id,$second_date,$memo_it,$descp_it,$income_account,$interest_earned,$cash_back_account,$cash_back_memo,$cash_back_amount);
        
    }

    public function remove_it()
    {
        $id=$this->input->post('id');

        $this->reconcile_model->remove_it_records($id);
        
    }

    public function recurrint_save()
    {
        $reconcile_id=$this->input->post('reconcile_id');
        $chart_of_accounts_id=$this->input->post('chart_of_accounts_id');
        $template_name_int=$this->input->post('template_name_int');
        $template_type_int=$this->input->post('template_type_int');
        $template_interval_int=$this->input->post('template_interval_int');
        $advanced_day_int=$this->input->post('advanced_day_int');
        $day_int=$this->input->post('day_int');
        $dayname_int=$this->input->post('dayname_int');
        $daynum_int=$this->input->post('daynum_int');
        $weekday_int=$this->input->post('weekday_int');
        $weekname_int=$this->input->post('weekname_int');
        $monthday_int=$this->input->post('monthday_int');
        $monthname_int=$this->input->post('monthname_int');
        $startdate_int=$this->input->post('startdate_int');
        $endtype_int=$this->input->post('endtype_int');
        $enddate_int=$this->input->post('enddate_int');
        $occurrence_int=$this->input->post('occurrence_int');
        $account_type_int=$this->input->post('account_type_int');
        $memo_recurr_it=$this->input->post('memo_recurr_it');
        
        $cash_back_account_recurr=$this->input->post('cash_back_account_recurr');
        $cash_back_amount_recurr=$this->input->post('cash_back_amount_recurr');
        $cash_back_memo_recurr=$this->input->post('cash_back_memo_recurr');

        echo $this->reconcile_model->recurrint_save($reconcile_id,$chart_of_accounts_id,$template_name_int,$template_type_int,$template_interval_int,$advanced_day_int,$day_int,$dayname_int,$daynum_int,$weekday_int,$weekname_int,$monthday_int,$monthname_int,$startdate_int,$endtype_int,$enddate_int,$occurrence_int,$account_type_int,$memo_recurr_it,$cash_back_account_recurr,$cash_back_amount_recurr,$cash_back_memo_recurr);
    }

    public function insert_recurr_interestearned()
    {
        $mainid=$this->input->post('mainid');
        $reconcile_id=$this->input->post('reconcile_id');
        $chart_of_accounts_id=$this->input->post('chart_of_accounts_id');
        $income_account_sub=$this->input->post('income_account_sub');
        $interest_earned_sub=$this->input->post('interest_earned_sub');
        $descp_it_sub=$this->input->post('descp_it_sub');
        $this->reconcile_model->save_recurr_interest($mainid,$reconcile_id,$chart_of_accounts_id,$income_account_sub,$interest_earned_sub,$descp_it_sub);
        
    }

    public function update_recurr_interestearned()
    {
        $id=$this->input->post('id');
        $reconcile_id=$this->input->post('reconcile_id');
        $chart_of_accounts_id=$this->input->post('chart_of_accounts_id');
        $income_account_sub=$this->input->post('income_account_sub');
        $interest_earned_sub=$this->input->post('interest_earned_sub');
        $descp_it_sub=$this->input->post('descp_it_sub');
        $this->reconcile_model->update_recurr_interest($id,$income_account_sub,$interest_earned_sub,$descp_it_sub);
    }

    public function remove_it_recurr()
    {
        $id=$this->input->post('id');

        $this->reconcile_model->remove_sc_recurr_records($id);
        
    }

    public function delete_int()
    {
        $id = $this->input->post('id');
        $this->reconcile_model->delete_int($id);
    }
    public function delete_sc()
    {
        $id = $this->input->post('id');
        $this->reconcile_model->delete_sc($id);
    }

    public function journal_report($id,$type)
    {
        $this->page_data['alert'] = 'accounting/alert_promt';
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['rows'] =  $this->reconcile_model->getById($id);
        if($type=='sc')
        {
            $subrows = $this->reconcile_model->select_service($this->page_data['rows']->id,$this->page_data['rows']->chart_of_accounts_id);
        }
        else
        {
            $subrows = $this->reconcile_model->select_interest($this->page_data['rows']->id,$this->page_data['rows']->chart_of_accounts_id);
        }
        $this->page_data['subrows']= $subrows;
        $this->page_data['type']= $type;
        $this->load->view('accounting/reconcile/journalreport',$this->page_data);
    }

     public function journal_report_ajax($id,$type)
    {
        $this->page_data['alert'] = 'accounting/alert_promt';
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['rows'] =  $this->reconcile_model->getById($id);
        if($type=='sc')
        {
            $subrows = $this->reconcile_model->select_service($this->page_data['rows']->id,$this->page_data['rows']->chart_of_accounts_id);
        }
        else
        {
            $subrows = $this->reconcile_model->select_interest($this->page_data['rows']->id,$this->page_data['rows']->chart_of_accounts_id);
        }
        $this->page_data['subrows']= $subrows;
        $this->page_data['type']= $type;
        $rows  =  $this->reconcile_model->selectonwherewithinactive($id);
        $html = "";
        foreach ($rows as $row) {
      
        }
        echo $html;
    }

    public function audit_history($chart_of_accounts_id,$type)
    {
        $id=$chart_of_accounts_id;
        $this->page_data['alert'] = 'accounting/alert_promt';
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['rows']  =  $this->reconcile_model->selectonwherehistory($id);
        $this->page_data['type']  =  $type;
        $this->load->view('accounting/reconcile/audit_history',$this->page_data);
    }

    public function addReconcile_history()
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
        $memo_sc=$this->input->post('memo_sc');
        $memo_it=$this->input->post('memo_it');
        $mailing_address=$this->input->post('mailing_address');
        $checkno=$this->input->post('checkno');
        $descp_sc=$this->input->post('descp_sc');
        $descp_it=$this->input->post('descp_it');
        $cash_back_account=$this->input->post('cash_back_account');
        $cash_back_memo=$this->input->post('cash_back_memo');
        $cash_back_amount=$this->input->post('cash_back_amount');
        $action=$this->input->post('action');

        echo $this->reconcile_model->saverecords_history($chart_of_accounts_id,$ending_balance,$ending_date,$first_date,$service_charge,$expense_account,$second_date,$interest_earned,$income_account,$memo_sc,$memo_it,$mailing_address,$checkno,$descp_sc,$descp_it,$cash_back_account,$cash_back_memo,$cash_back_amount,$action);
    }

    public function insert_servicecharge_history()
    {
        $reconcile_id=$this->input->post('reconcile_id');
        $chart_of_accounts_id=$this->input->post('chart_of_accounts_id');
        $expense_account_sub=$this->input->post('expense_account_sub');
        $service_charge_sub=$this->input->post('service_charge_sub');
        $descp_sc_sub=$this->input->post('descp_sc_sub');
        $this->reconcile_model->save_service_history($reconcile_id,$chart_of_accounts_id,$expense_account_sub,$service_charge_sub,$descp_sc_sub);
    }

    public function insert_interestearned_history()
    {
        $reconcile_id=$this->input->post('reconcile_id');
        $chart_of_accounts_id=$this->input->post('chart_of_accounts_id');
        $income_account_sub=$this->input->post('income_account_sub');
        $interest_earned_sub=$this->input->post('interest_earned_sub');
        $descp_it_sub=$this->input->post('descp_it_sub');
        $this->reconcile_model->save_interest_history($reconcile_id,$chart_of_accounts_id,$income_account_sub,$interest_earned_sub,$descp_it_sub);
    }

}