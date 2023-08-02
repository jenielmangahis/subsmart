<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Reports extends MY_Controller {



	public function __construct()

	{
		parent::__construct();
        $this->checkLogin();

		$this->page_data['page']->title = 'Reports';

		$this->page_data['page']->menu = 'reports';	
		$this->load->model('Estimate_model', 'estimate_model');
		$this->load->model('Invoice_model', 'invoice_model');
        $this->load->model('Accounting_receive_payment_model', 'Accounting_receive_payment_model');
        $this->load->model('Customer_model', 'customer_model');

        $user_id = getLoggedUserID();
        
                // add css and js file path so that they can be attached on this page dynamically
        // add_css and add_footer_js are the helper function defined in the helpers/basic_helper.php
        add_css(array(
            'https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css',
            'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css',
            'https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css',
            'https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css',
            'assets/frontend/css/report/main.css',
        ));


        // JS to add only Customer module
        add_footer_js(array(
            'https://cdn.jsdelivr.net/jquery/latest/jquery.min.js',
            'https://cdn.jsdelivr.net/momentjs/latest/moment.min.js',
            'https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js',
            'https://canvasjs.com/assets/script/jquery.canvasjs.min.js',
            'assets/frontend/js/report/main.js',
        ));
	}

	public function workorder()
	{

        $this->getUsers();      
        $this->page_data['workorders'] = $this->workorder_model->getAllByUserId();           
   		$this->load->view('report/workorder/view', $this->page_data);

    }

    public function main()
	{
        $this->getUsers();      
   		$this->load->view('report/main/main', $this->page_data);

    }

    public function summary()
	{
        $this->getUsers();      
   		$this->load->view('report/analytics/main', $this->page_data);

    }

    public function report($id)
	{
        $this->getUsers();    
        $company_id = logged('company_id');  
        $this->page_data['type'] = $id;           
        $this->page_data['estimates'] = $this->estimate_model->getAllByCompany($company_id);           
        $this->page_data['invoices'] = $this->invoice_model->getAllByCompany($company_id, 0);    
        $this->page_data['invoicesItems'] = $this->invoice_model->getInvoicesItems(logged('company_id'));  
        $this->page_data['receivedPayments'] = $this->Accounting_receive_payment_model->getReceivePaymentsByComp(logged('company_id'));      
        $this->page_data['customers'] = $this->customer_model->getAllByCompany(logged('company_id'));
        $this->page_data['invoices'] = $this->invoice_model->get_company_open_invoices(logged('company_id'));
        
        $this->page_data['page']->title = 'Activities Reports';
        $this->page_data['page']->parent = 'Reports';
        $this->load->view('report/main/popular_reports', $this->page_data);
    }
    public function preview()
	{
        $format = $this->input->get('format');
        $type = $this->input->get('type');
        $start_time = $this->input->get('start_time');
        $end_time = $this->input->get('end_time');
        $formattedStartDate = $this->input->get('format_start_time');
        $formattedEndDate = $this->input->get('format_end_time');

        if ($format === "pdf") {
            $img = explode("/", parse_url((companyProfileImage(logged('company_id'))) ? companyProfileImage(logged('company_id')) : $url->assets)['path']);

            if ($type == "commercial_vs_residential") {
                $orientation = "landscape";
            } else {
                $orientation = "portrait";
            }

            $this->page_data['profile'] = $img[2] . "/" . $img[3] . "/" . $img[4];
            $this->page_data['startDate'] = $formattedStartDate;
            $this->page_data['endDate'] = $formattedEndDate;
            $this->page_data['type'] = $type;
            $this->page_data['orientation'] = $orientation;
            $this->page_data['data'] = $this->setAction($type, $start_time, $end_time);

            $filename = $type."_".date("Ymd");
            $this->load->library('pdf');
            $this->pdf->load_view('report/main/pdf/template', $this->page_data, $filename, $orientation);
        } else{
            $data = $this->setAction($type, $start_time, $end_time);
            $this->report_to_csv($type, $data, $formattedStartDate, $formattedEndDate);
        }
    }

    public function setAction($type, $startDate, $endDate) {
        switch($type) {
            case "monthly_closeout":
                return $this->setFilterByMonths($startDate, $endDate);

            case "yearly_closeout":
                return $this->setFilterByMonths($startDate, $endDate);

            case "profit_loss":
                return $this->setProfitLoss($startDate, $endDate);

            case "payments_type_summary":
                return $this->setPaymentTypeSummary($startDate, $endDate);

            case "payments_received":
                return $this->setPaymentReceived($startDate, $endDate);
            
            case "account_receivable":
                return $this->setAccountReceivable($startDate, $endDate);

            case "commercial_vs_residential":
                return $this->setAccountReceivableResCom($startDate, $endDate);

            case "sales_summary_by_customer":
                return $this->setPaymentByCustomer($startDate, $endDate);

            case "invoice_by_date":
                return $this->setInvoiceByDate($startDate, $endDate);

            case "sales_by_customer_groups":
                return $this->setPaymentByCustomerGroup($startDate, $endDate);

            case "sales_by_customer_source":
                return $this->setCustomerSource($startDate, $endDate);

            case "customer_source":
                return $this->setCustomerBySource();

            case "estimates_summary":
                return $this->setEstimates();
        }
    }

    public function getUsers() {

        $user_id =  logged('id');
        $comp_id = logged('company_id');			
    
        $this->page_data['users'] = $this->users_model->getAllUsersByCompany($comp_id, $user_id);			     

    }

    public function setEstimates()
    {
        $this->page_data['estimates'] = $this->estimate_model->getAllByCompanynDraft(logged('company_id'));

        // return $this->page_data;
        echo json_encode($this->page_data);
        
    }

    public function filterReports() {
        $startDate = $this->input->get('startDate');
        $endDate = $this->input->get('endDate');    

        $data['monthly'] = $this->setFilterByMonths($startDate, $endDate); 
        echo json_encode($data);
    }
    

    public function getDateInterval($startDate, $endDate) {
        $start    = (new DateTime($startDate))->modify('first day of this month');
        $end      = (new DateTime($endDate))->modify('first day of next month');
        $interval = DateInterval::createFromDateString('1 month');
        $period   = new DatePeriod($start, $interval, $end);

        return $period;
    }

    public function setFilterByMonths($startDate, $endDate) {
        $months = [];
        $period = $this->getDateInterval($startDate, $endDate);

        foreach ($period as $dt) {
            $num_estimate = get_reports_by_date($startDate, $endDate, $dt->format("m"), 'num_estimate');
            $amount_estimate = dollar_format(get_reports_by_date($startDate, $endDate, $dt->format("m"), 'estimate_amount'));
            $num_invoice = get_reports_by_date($startDate, $endDate, $dt->format("m"), 'num_invoice');
            $amount_invoice = dollar_format(get_reports_by_date($startDate, $endDate, $dt->format("m"), 'invoice_amount'));
            $paid_invoice = dollar_format(get_reports_by_date($startDate, $endDate, $dt->format("m"), 'paid_invoice'));
            $due_invoice = dollar_format(get_reports_by_date($startDate, $endDate, $dt->format("m"), 'due_invoice'));

            array_push($months, array($dt->format("M, Y"), $num_estimate, $amount_estimate, '$0.00', $num_invoice, $amount_invoice, $paid_invoice, $due_invoice, '0', '$0.00'));
        }

        return $months;
    }

    public function setProfitLoss($startDate, $endDate) {
        $invoice = get_invoice_amount_by_date('Paid', $startDate, $endDate);
        $expenses = 0;
        $revenue = $invoice;  
        $net_profit = floatval($invoice) - floatval($expenses);

        $data = [dollar_format($revenue), dollar_format($invoice), dollar_format($expenses), dollar_format($net_profit)];

        return $data;
    }

    public function setPaymentTypeSummary($startDate, $endDate) {
        $months = [];
        $month_counter = false;
        $grand_total = 0;
        $period = $this->getDateInterval($startDate, $endDate);

        foreach ($period as $dt) {
            $payments = getPaymentByMethod($startDate, $endDate, $dt->format("m"));
            $month_counter = false;

            foreach ($payments as $payment) {
                if (!$month_counter) {
                    $month_counter = true;
                    $grand_total += floatval($payment[0]);
                    array_push($months, array_merge(array($dt->format("M, Y")), array(dollar_format($payment[0]))));
                } else {
                    array_push($months, $payment);
                }
            }
        }
        array_push($months, array("Total", dollar_format($grand_total)));

        return $months;
    }

    public function profitLoss() {
        $startDate = $this->input->get('startDate');
        $endDate = $this->input->get('endDate');

        $invoice = get_invoice_amount_by_date('Paid', $startDate, $endDate);
        $expenses = 0;
        $revenue = $invoice;  
        $net_profit = floatval($invoice) - floatval($expenses);

        $data = $this->setProfitLoss($startDate, $endDate);

        echo json_encode($data);
    }

    public function paymentByMethod() {
        $startDate = $this->input->get('startDate');
        $endDate = $this->input->get('endDate');

        $months = [];
        $month_counter = false;
        $grand_total = 0;
        $period = $this->getDateInterval($startDate, $endDate);

        foreach ($period as $dt) {
            $payments = getPaymentByMethod($startDate, $endDate, $dt->format("m"));
            $month_counter = false;

            foreach ($payments as $payment) {
                if (!$month_counter) {
                    $month_counter = true;
                    $grand_total += floatval($payment[0]);
                    array_push($months, array_merge(array($dt->format("M, Y")), array(dollar_format($payment[0]))));
                } else {
                    array_push($months, $payment);
                }
            }
        }
        array_push($months, array("Total", dollar_format($grand_total)));

        echo json_encode($months);
    }

    public function paymentByMonth() {
        $startDate = $this->input->get('startDate');
        $endDate = $this->input->get('endDate');

        $months = [];
        $month_counter = 0;
        $grand_total = 0;
        $period = $this->getDateInterval($startDate, $endDate);

        foreach ($period as $dt) {
            $payments = getPaymentByMonth($startDate, $endDate, $dt->format("m"));
            $month_counter = false;

            foreach ($payments as $payment) {
                if (!$month_counter) {
                    $month_counter = true;
                    $grand_total += floatval($payment[6]);
                    array_push($months, array($dt->format("M, Y"), '', '', '', ''));
                    array_push($months, $payment);
                } else {
                    array_push($months, $payment);
                }
            }
        }
        array_push($months, array("Total", '', '', '', dollar_format($grand_total)));

        echo json_encode($months);
    }

    public function setPaymentReceived($startDate, $endDate) {
        $months = [];
        $month_counter = 0;
        $grand_total = 0;
        $period = $this->getDateInterval($startDate, $endDate);

        foreach ($period as $dt) {
            $payments = getPaymentByMonth($startDate, $endDate, $dt->format("m"));
            $month_counter = false;


            foreach ($payments as $payment) {
                if (!$month_counter) {
                    $month_counter = true;
                    $grand_total += floatval($payment[5]);
                    array_push($months, array($dt->format("M, Y"), '', '', '', ''));
                    array_push($months, $payment);
                } else {
                    array_push($months, $payment);
                }
            }
        }
        array_push($months, array("Total", '', '', '', dollar_format($grand_total)));

        return $months;
    }

    public function setAccountReceivable($startDate, $endDate) {
        $months = [];
        $month_counter = 0;

        $period = $this->getDateInterval($startDate, $endDate);
        $i = 0;
        foreach ($period as $dt) {
            $payments = getAccountReceivable($startDate, $endDate, $dt->format("m"));
            $month_counter = false;

            foreach ($payments as $payment) {
                if (!$month_counter) {
                    $month_counter = true;
                    array_push($months, array_merge(array($dt->format("M, Y")), $payment));
                } else {
                    array_push($months, $payment);
                }
            }
        }

        return $months;
    }

    public function setAccountReceivableResCom($startDate, $endDate) {
        $months = [];
        $month_counter = 0;

        $period = $this->getDateInterval($startDate, $endDate);
        $i = 0;
        foreach ($period as $dt) {
            $payments = getAccountReceivableResCom($startDate, $endDate, $dt->format("m"));
            $month_counter = false;

            foreach ($payments as $payment) {
                if (!$month_counter) {
                    $month_counter = true;
                    array_push($months, array_merge(array($dt->format("M, Y")), $payment));
                } else {
                    array_push($months, $payment);
                }
            }
        }

        return $months;
    }

    public function setPaymentByCustomer($startDate, $endDate) {
        $payments = getPaymentByCustomer($startDate, $endDate);

        return $payments;
    }

    public function paymentByCustomer() {
        $startDate = $this->input->get('startDate');
        $endDate = $this->input->get('endDate');

        $payments = getPaymentByCustomer($startDate, $endDate);

        echo json_encode($payments);
    }

    public function expenseByCategory() {
        $startDate = $this->input->get('startDate');
        $endDate = $this->input->get('endDate');

        $payments = getExpenseCategory($startDate, $endDate);

        echo json_encode($payments);
    }

    public function expenseByCategoryMonth() {
        $startDate = $this->input->get('startDate');
        $endDate = $this->input->get('endDate');

        $payments = getExpense($startDate, $endDate);

        echo json_encode($payments);
    }

    public function expenseByCategoryMonthVendor() {
        $startDate = $this->input->get('startDate');
        $endDate = $this->input->get('endDate');

        $payments = getExpenseVendor($startDate, $endDate);

        echo json_encode($payments);
    }

    public function paymentByItem() {
        $startDate = $this->input->get('startDate');
        $endDate = $this->input->get('endDate');

        $payments = getPaymentByItem($startDate, $endDate);

        echo json_encode($payments);
    }

    public function paymentByCustomerGroup() {
        $startDate = $this->input->get('startDate');
        $endDate = $this->input->get('endDate');

        $payments = getPaymentByCustomerGroup($startDate, $endDate);

        echo json_encode($payments);
    }

    public function setCustomerSource($startDate, $endDate) {
        $payments = getCustomerSource($startDate, $endDate);

        return $payments;
    }

    public function customerSource() {
        $startDate = $this->input->get('startDate');
        $endDate = $this->input->get('endDate');

        $payments = getCustomerSource($startDate, $endDate);

        echo json_encode($payments);
    }

    public function customerBySource() {
        $payments = getCustomerBySource();

        echo json_encode($payments);
    }

    public function setCustomerBySource() {
        $payments = getCustomerBySource();

        return $payments;
    }

    public function setPaymentByCustomerGroup($startDate, $endDate) {
        $payments = getPaymentByCustomerGroup($startDate, $endDate);

        return $payments;
    }

    public function accountReceivable() {
        $startDate = $this->input->get('startDate');
        $endDate = $this->input->get('endDate');

        $months = [];
        $month_counter = 0;

        $period = $this->getDateInterval($startDate, $endDate);
        $i = 0;
        foreach ($period as $dt) {
            $payments = getAccountReceivable($startDate, $endDate, $dt->format("m"));
            $month_counter = false;

            foreach ($payments as $payment) {
                if (!$month_counter) {
                    $month_counter = true;
                    array_push($months, array_merge(array($dt->format("M, Y")), $payment));
                } else {
                    array_push($months, $payment);
                }
            }
        }

        echo json_encode($months);
    }

    public function accountReceivableResCom() {
        $startDate = $this->input->get('startDate');
        $endDate = $this->input->get('endDate');

        $months = [];
        $month_counter = 0;

        $period = $this->getDateInterval($startDate, $endDate);
        $i = 0;
        foreach ($period as $dt) {
            $payments = getAccountReceivableResCom($startDate, $endDate, $dt->format("m"));
            $month_counter = false;

            foreach ($payments as $payment) {
                if (!$month_counter) {
                    $month_counter = true;
                    array_push($months, array_merge(array($dt->format("M, Y")), $payment));
                } else {
                    array_push($months, $payment);
                }
            }
        }

        echo json_encode($months);
    }

    public function setInvoiceByDate($startDate, $endDate) {
        $months = [];
        $month_counter = 0;

        $period = $this->getDateInterval($startDate, $endDate);
        $i = 0;
        foreach ($period as $dt) {
            $payments = getInvoiceByDate($startDate, $endDate, $dt->format("m"));
            $month_counter = false;

            foreach ($payments as $payment) {
                array_push($months, $payment);
            }
        }

        return $months;
    }

    public function invoiceByDate() {
        $startDate = $this->input->get('startDate');
        $endDate = $this->input->get('endDate');

        $months = [];
        $month_counter = 0;

        $period = $this->getDateInterval($startDate, $endDate);
        $i = 0;
        foreach ($period as $dt) {
            $payments = getInvoiceByDate($startDate, $endDate, $dt->format("m"));
            $month_counter = false;

            foreach ($payments as $payment) {
                array_push($months, $payment);
            }
        }

        echo json_encode($months);
    }

    public function workOrderByEmployee() {
        $startDate = $this->input->get('startDate');
        $endDate = $this->input->get('endDate');

        $months = [];
        $month_counter = 0;

        $period = $this->getDateInterval($startDate, $endDate);
        $i = 0;
        // foreach ($period as $dt) {
            $payments = getworkOrderByEmployee($startDate, $endDate);
            $month_counter = false;

            foreach ($payments as $payment) {
                array_push($months, $payment);
            }
        // }

        echo json_encode($months);
    }
    
    public function workOrderByStatus() {
        $startDate = $this->input->get('startDate');
        $endDate = $this->input->get('endDate');

        $months = [];
        $month_counter = 0;

        $period = $this->getDateInterval($startDate, $endDate);
        $i = 0;
        // foreach ($period as $dt) {
            $payments = getworkOrderByStatus($startDate, $endDate);
            $month_counter = false;

            foreach ($payments as $payment) {
                array_push($months, $payment);
            }
        // }

        echo json_encode($months);
    }

    public function customerTaxByMonth()
    {
        $startDate = $this->input->get('startDate');
        $endDate = $this->input->get('endDate');

        $months = [];
        $month_counter = 0;

        $period = $this->getDateInterval($startDate, $endDate);
        $i = 0;
        foreach ($period as $dt) {
            $payments = getcustomerTaxByMonth($startDate, $endDate, $dt->format("m"));
            $month_counter = false;

            foreach ($payments as $payment) {
                array_push($months, $payment);
            }
        }

        echo json_encode($months);
    }

    public function searchByKeyword($type='', $status='', $emp_id=0) {

        $this->getUsers();

       // echo $this->uri->segment(5);die;
        $this->page_data['workorders'] = $this->workorder_model->getAllByUserId($type, $status, $emp_id);           
        $this->load->view('report/workorder/view', $this->page_data);
    }

    public function report_to_csv($type, $datas, $startDate, $endStart)
    {
        $delimiter = ",";
        $filename = $type."_".date('Ymd'). ".csv";

        //create a file pointer
        $f = fopen('php://memory', 'w');

        //set column headers->fullname,1);
        $head = array(ucwords(str_replace('_', ' ', $type)));
        if ($type != 'customer_source') {
            $date = array($startDate ." to ". $endStart);
        }  
        $generated = array("Report generated on: ". date('d M Y'));   
        if ($type === "monthly_closeout" || $type === "yearly_closeout") {    
            $fields = array('Month', '# of Estimates', 'Estimated', 'Accepted', '# of Invoices', 'Invoiced', 'Paid', 'Due', '# of Expenses', 'Total Expense');
        } else if($type === "profit_loss") {
            $fields = array('Name', 'Balance');
        } else if($type === "payments_type_summary") {
            $fields = array('Month', 'Total Sales');
        } else if($type === "payments_received") {
            $fields = array('Month / Customer', 'Paid Date', 'Details', 'Payment Method', 'Total Sales');
        } else if($type === "account_receivable") {
            $fields = array('Month', '# of Invoices', 'Invoiced', 'Paid', 'Due', 'Tip', 'Fees');
        } else if($type === "commercial_vs_residential") {
            $fields_header = array('', '', '', '', '', 'Commercial', '', '', '', '', 'Residential');
            $fields = array('Month', '', '#Inv', 'Invoiced', 'Paid', 'Due', 'Tip', 'Fees', '#Inv', 'Invoiced', 'Paid', 'Due', 'Tip', 'Fees');
        } else if($type === "sales_summary_by_customer") {
            $fields = array('Customer', 'Type', 'Invoices Paid #', 'Payments #', 'Total Sales');
        } else if($type === "sales_by_customer_groups") {
            $fields = array('Customer Group', 'Payments #', 'Total Sales');
        } else if($type === "sales_by_customer_source") {
            $fields = array('Source', 'Residential #', 'Residential Invoiced', 'Commercial #', 'Commercial Invoiced');
        } else if($type === "customer_source") {
            $fields = array('Source', 'Customer Count (total)', 'Residential Count', 'Commercial Count');
        }
        
        fputcsv($f, $head, $delimiter);
        if ($type != 'customer_source') {
            fputcsv($f, $date, $delimiter);
        }
        fputcsv($f, $generated, $delimiter);
        ($type === "commercial_vs_residential") ? fputcsv($f, $fields_header, $delimiter) : '';
        fputcsv($f, $fields, $delimiter);

        //output each row of the data, format line as csv and write to file pointer
        //echo "<pre>";print_r($all);die;
     
        if(!empty($datas)){  
            if ($type === "monthly_closeout" || $type === "yearly_closeout") {        
                foreach ($datas as $data) {
                    $csvData = array($data[0], $data[1], $data[2], $data[3], $data[4], $data[5], $data[6], $data[7], $data[8], $data[9]);
                    fputcsv($f, $csvData, $delimiter);
                }
            } else if($type === "profit_loss") {
                $revenue = array('Revenue', $datas[0]);
                $invoice = array('Invoices Paid', $datas[1]);
                $expenses = array('Expenses', $datas[2]);
                $net_profit = array('Net Profit', $datas[3]);
                fputcsv($f, $revenue, $delimiter);
                fputcsv($f, $invoice, $delimiter);
                fputcsv($f, $expenses, $delimiter);
                fputcsv($f, $net_profit, $delimiter);
            } else if($type === "payments_type_summary") {
                foreach ($datas as $data) {
                    $csvData = array($data[0], $data[1]);
                    fputcsv($f, $csvData, $delimiter);
                }
            } else if($type === "payments_received") {
                foreach ($datas as $data) {
                    $csvData = array($data[0], $data[1], $data[2], $data[3], $data[4]);
                    fputcsv($f, $csvData, $delimiter);
                }
            } else if($type === "account_receivable") {
                foreach ($datas as $data) {
                    if (substr($data[0], -6, 1) == ',') {
                        $csvData = array($data[0], $data[1], $data[2], $data[3], $data[4], $data[5], $data[6]);
                    } else {
                        $csvData = array($data[0], $data[1] . $data[2], $data[3], $data[4], $data[5], $data[6], $data[7]);
                    }
                    fputcsv($f, $csvData, $delimiter);
                }
            } else if($type === "commercial_vs_residential") {
                foreach ($datas as $data) {
                    if (substr($data[0], -6, 1) == ',') {
                        $csvData = array($data[0], '', $data[1], $data[2], $data[3], $data[4], $data[5], $data[6], $data[7], $data[8], $data[9], $data[10], $data[11], $data[12]);
                    } else {
                        $csvData = array($data[0], $data[1] . $data[2], $data[3], $data[4], $data[5], $data[6], $data[7], $data[8], $data[9], $data[10], $data[11], $data[12], $data[13], $data[14]);
                    }
                    fputcsv($f, $csvData, $delimiter);
                }
            } else if($type === "sales_summary_by_customer") {
                foreach ($datas as $data) {
                    $csvData = array($data[0], $data[1], $data[2], $data[3], $data[4]);
                    fputcsv($f, $csvData, $delimiter);
                }
            } else if($type === "sales_by_customer_groups") {
                foreach ($datas as $data) {
                    $csvData = array($data[0], $data[1], $data[2]);
                    fputcsv($f, $csvData, $delimiter);
                }
            } else if($type === "sales_by_customer_source") {
                foreach ($datas as $data) {
                    $csvData = array($data[0], $data[1], $data[2], $data[3], $data[4]);
                    fputcsv($f, $csvData, $delimiter);
                }
            } else if($type === "customer_source") {
                foreach ($datas as $data) {
                    $csvData = array($data[0], $data[1], $data[2], $data[3]);
                    fputcsv($f, $csvData, $delimiter);
                }
            }
        }
        else
        {
            $csvData = array('');
            fputcsv($f, $csvData, $delimiter);
        }

        fseek($f, 0);

        //set headers to download file rather than displayed
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '";');

        //output all remaining data on a file pointer
        fpassthru($f);
    }


}

/* End of file Comapny.php */

/* Location: ./application/controllers/Users.php */