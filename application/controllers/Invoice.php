<?php
defined('BASEPATH') or exit('No direct script access allowed');

include_once 'application/services/InvoiceCustomer.php';

class Invoice extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->checkLogin();
        $this->hasAccessModule(35);

        $this->page_data['page']->title = 'Invoice Management';

        $this->page_data['page']->menu = (!empty($this->uri->segment(2))) ? $this->uri->segment(2) : 'invoice';
        $this->load->model('Invoice_model', 'invoice_model');
        $this->load->model('Invoice_settings_model', 'invoice_settings_model');
        $this->load->model('Payment_records_model', 'payment_records_model');
        $this->load->model('AcsProfile_model', 'AcsProfile_model');
        $this->load->model('Accounting_terms_model', 'accounting_terms_model');
        $this->load->model('Accounting_invoices_model', 'accounting_invoices_model');
        $this->load->model('Estimate_model', 'estimate_model');
        $this->load->model('accounting_receive_payment_model');
        $this->load->model('Workorder_model', 'workorder_model');

        // add css and js file path so that they can be attached on this page dynamically
        // add_css and add_footer_js are the helper function defined in the helpers/basic_helper.php
        add_css(array(            
            'assets/css/v2/bootstrap-datepicker.min.css',
            'assets/frontend/css/invoice/main.css',
        ));

        add_footer_js(array(        
            'assets/js/v2/bootstrap-datetimepicker.min.js',    
            'assets/frontend/js/invoice/add.js',
            //'assets/js/invoice.js'
        ));
    }

    public function index($tab = '')
    {   
        add_css(array(
            'https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css',
            "assets/css/accounting/customers.css",
        ));
        add_footer_js(array(
            "assets/js/accounting/sales/customers.js",
            'https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js'
        ));

        $company_id = getLoggedCompanyID();
        $start_date = date('Y-m-d', strtotime(date("Y-m-d") . ' - 365 days'));
        $end_date = date('Y-m-d');
        $invoices = $this->accounting_invoices_model->get_ranged_invoices_by_company_id($company_id, $start_date, $end_date);
        $receivable_payment = 0;
        $total_amount_received = 0;
        $receivable_last30_days = 0;
        $total_amount_received_last30_days = 0;
        $total_overdue = 0;
        $total_not_due = 0;
        $deposited_last30_days = 0;

        foreach ($invoices as $inv) {
            if (is_numeric($inv->grand_total)) {
                $receivable_payment += $inv->grand_total;
                if ($this->get_date_difference_indays($inv->date_issued, date("Y-m-d")) <= 30) {
                    $receivable_last30_days += $inv->grand_total;
                }
            }
            $receive_payment = $this->accounting_invoices_model->get_payements_by_invoice($inv->id);
            $amount_payment = 0;
            foreach ($receive_payment as $payment) {
                $total_amount_received += $payment->payment_amount;
                $amount_payment += $payment->payment_amount;
                if ($this->get_date_difference_indays($inv->date_issued, date("Y-m-d")) <= 30) {
                    $total_amount_received_last30_days += $payment->payment_amount;
                    $deposited_last30_days += $payment->payment_amount;
                }
            }
            if (date("Y-m-d", strtotime($inv->due_date)) <= date("Y-m-d")) {
                $total_overdue += (float)$inv->grand_total - (float)$amount_payment;
            } else {
                $total_not_due += $inv->grand_total - $amount_payment;
            }
        }

        //caculating this month overall income
        $receive_payments = $this->accounting_receive_payment_model->get_ranged_received_payment_by_company_id($company_id, date("Y-m-d", strtotime("first day of this month")), date("Y-m-d"));
        $income_this_month = 0;
        $income_last_month = 0;
        $income_per_day = array();

        $graph_data = array();
        $graph_data["type"] = "line";
        $graph_data["indexLabelFontSize"] = "12";
        $dataPoints = array();
        foreach ($receive_payments as $payment) {
            if (date("Y-m-d", strtotime($payment->payment_date)) >= date("Y-m-01") && date("Y-m-d", strtotime($payment->payment_date)) <= date("Y-m-d")) {
                $income_this_month += $payment->amount;
                $per_day_index = date("d", strtotime($payment->payment_date));
                $income_per_day[$per_day_index] += $payment->amount;
                $dataPoints["y"][] = $payment->amount;
            } else {
                $income_last_month += $payment->amount;
            }
        }
        $dataPoints["y"][] = 100;
        $graph_data["dataPoints"] = $dataPoints;
        // var_dump($receive_payments);

        //script for deposit widget
        $invoices_this_week = $this->invoice_model->get_ranged_PaidInv($company_id, date("Y-m-d", strtotime('monday this week')), date("Y-m-d", strtotime('sunday this week')));
        $total_deposit = 0;
        $statuses = array(0, 0, 0, 0);
        $deposit_transaction_count = 0;
        foreach ($invoices_this_week as $inv) {
            $total_deposit += $inv->grand_total;
            $deposit_transaction_count++;
            if ($inv->status == 'Submitted') {
                $statuses[0] += 1;
            } elseif ($inv->status == 'Approved') {
                $statuses[1] += 1;
            } elseif ($inv->status == 'Partially Paid') {
                $statuses[2] += 1;
            } elseif ($inv->status == 'Paid') {
                $statuses[3] += 1;
            }
        }
        $current_status = -1;
        $largest_status = 0;
        for ($i = 0; $i < count($statuses); $i++) {
            if ($statuses[$i] > $largest_status) {
                $current_status = $i;
                $largest_status = $statuses[$i];
                $i = -1;
            }
        }

        $role = logged('role');
        $type = 0;
        $comp_id = logged('company_id');
        $sort_by = 'Newest First';
        if (!empty($tab)) {
            $this->page_data['tab'] = $tab;
            $this->page_data['invoices'] = $this->invoice_model->filterBy(array('status' => $tab), $comp_id, $type);
        } else {
            // search
            if (!empty(get('search'))) {
                $this->page_data['search'] = trim(get('search'));
                $this->page_data['invoices'] = $this->invoice_model->filterBy(array('search' => trim(get('search'))), $comp_id, $type);
            } elseif (!empty(get('order'))) {  
                $sort_by = get('order');    
                switch (get('order')) {
                    case 'date_created-desc':
                        $sort_by = 'Newest First';
                        break;
                    case 'date_created-asc':
                        $sort_by = 'Oldest First';
                        break;
                    case 'invoice_number-asc':
                        $sort_by = 'Invoice Number: Asc';
                        break;
                    case 'invoice_number-desc':
                        $sort_by = 'Invoice Number: Desc';
                        break;
                    case 'grand_total-asc':
                        $sort_by = 'Amount: Lowest';
                        break;
                    case 'grand_total-desc':
                        $sort_by = 'Amount: Highest';
                        break;
                    default:
                        $sort_by = 'Newest First';
                        break;
                }
                $this->page_data['search'] = get('search');
                $this->page_data['invoices'] = $this->invoice_model->filterBy(array('order' => get('order')), $comp_id, $type);
            } else {                
                //$this->page_data['invoices'] = $this->invoice_model->getAllData();
                $this->page_data['invoices'] = $this->invoice_model->getAllActiveByCompanyId($comp_id, $type);
            }
        }

        $this->page_data['unpaid_last_365'] = $receivable_payment - $total_amount_received;
        $this->page_data['unpaid_last_30'] = $receivable_last30_days - $total_amount_received_last30_days;
        $this->page_data['due_last_365'] = $total_overdue;
        $this->page_data['not_due_last_365'] = $total_not_due;
        $this->page_data['deposited_last30_days'] = $deposited_last30_days;
        $this->page_data['not_deposited_last30_days'] = $receivable_last30_days - $deposited_last30_days;
        $this->page_data['invoice_needs_attention'] = false;
        $this->page_data['income_this_month'] = $income_this_month;
        $this->page_data['income_last_month'] = $income_last_month;
        $this->page_data['deposit_current_status'] = $current_status;
        $this->page_data['deposit_total_amount'] = $total_deposit;
        $this->page_data['deposit_transaction_count'] = $deposit_transaction_count;
        $this->page_data['graph_data'] = "[" . $this->graph_data_to_text($graph_data) . "]";

        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        // $this->page_data['invoices'] = $this->invoice_model->getAllData($company_id);
        $this->page_data['page_title'] = "Invoices & Payments";
        $this->page_data['page']->title = 'Invoices & Payments';
        $this->page_data['page']->parent = 'Sales';
        $this->page_data['sort_by'] = $sort_by;
        $this->load->view('v2/pages/invoice/invoice_new', $this->page_data);
    }

    public function get_date_difference_indays($date_from = "", $date_to = "")
    {
        $date_1 = strtotime($date_to); // or your date as well
        $date_2 = strtotime($date_from);
        $datediff = $date_1 - $date_2;
        return round($datediff / (60 * 60 * 24));
    }

    public function graph_data_to_text($graph_data = array())
    {
        $the_text = "{";
        $data_keys = array_keys($graph_data);
        for ($i = 0; $i < count($data_keys); $i++) {
            $the_text .= $data_keys[$i] . ":";
            if (is_array($graph_data[$data_keys[$i]])) {
                $the_text .= "[" . $this->graph_data_to_text($graph_data[$data_keys[$i]]) . "]";
            } else {
                $the_text .= $graph_data[$data_keys[$i]];
            }
            $the_text .= ",";
        }
        $the_text .= "}";
        return $the_text;
    }

    public function recurring($tab = '')
    {
		$this->page_data['page']->title = 'Recurring Invoices';
        $this->page_data['page']->parent = 'Sales';
        $this->page_data['page']->tab = $tab;

        $is_allowed = $this->isAllowedModuleAccess(37);
        if (!$is_allowed) {
            $this->page_data['module'] = 'recurring_invoices';
            echo $this->load->view('no_access_module', $this->page_data, true);
            die();
        }

        $role = logged('role');
        $type = 1;
        if ($role == 2 || $role == 3) {
            $comp_id = logged('company_id');

            if (!empty($tab)) {
                $this->page_data['tab'] = $tab;
                $this->page_data['invoices'] = $this->invoice_model->filterBy(array('status' => $tab), $comp_id, $type);
            } else {

                // search
                if (!empty(get('search'))) {
                    $this->page_data['search'] = get('search');
                    $this->page_data['invoices'] = $this->invoice_model->filterBy(array('search' => get('search')), $comp_id, $type);
                } elseif (!empty(get('order'))) {
                    $this->page_data['search'] = get('search');
                    $this->page_data['invoices'] = $this->invoice_model->filterBy(array('order' => get('order')), $comp_id, $type);
                } else {
                    $this->page_data['invoices'] = $this->invoice_model->getAllByCompany($comp_id, $type);
                }
            }
        }

        $this->load->view('v2/pages/invoice/recurring', $this->page_data);
    }

    public function add()
    {
        $this->load->helper('functions');
        $this->load->model('JobTags_model');
        $this->load->model('TaxRates_model');

        add_footer_js(array(        
            'assets/js/v2/add_items.js',                
        ));

        $query       = $this->input->get();        
        $workorder   = array();
        $w_customer  = array();
        $w_items     = array();
        if( isset($query['workorder']) ){            
            $this->load->model('Workorder_model');
            $this->load->model('AcsProfile_model');
            $workorder   = $this->Workorder_model->getByWhere(['work_order_number' => $query['workorder']]);
            $w_items     = $this->Workorder_model->getworkorderItems($workorder[0]->id);
            $w_customer  = $this->AcsProfile_model->getByProfId($workorder[0]->customer_id);
        }

        $user_id = logged('id');
        $this->page_data['users'] = $this->users_model->getAllUsersByCompany($user_id);
        $company_id = logged('company_id');
        $role = logged('role');
        if ($role == 1 || $role == 2) {            
            $this->page_data['customers'] = $this->AcsProfile_model->getAll();
        } else {            
            $this->page_data['customers'] = $this->AcsProfile_model->getAllByCompanyId($company_id);
        }


        $setting = $this->invoice_settings_model->getAllByCompany(logged('company_id'));
        $terms = $this->accounting_terms_model->getCompanyTerms_a($company_id);
        $this->page_data['number'] = $this->invoice_model->getlastInsert();

        if (!empty($setting)) {
            foreach ($setting as $key => $value) {
                if (is_serialized($value)) {
                    $setting->{$key} = unserialize($value);
                }
            }
            $this->page_data['setting'] = $setting;
            $this->page_data['terms'] = $terms;
        }

        $default_cust_id = 0;
        if( $this->input->get('cus_id') ){
            $default_cust_id = $this->input->get('cus_id');
        }
        
        $defaullTaxRate = $this->TaxRates_model->getDefaultTaxRateByCompanyId($company_id);
        if( $defaullTaxRate ){
            $default_tax_percentage = $defaullTaxRate->rate;
        }else{
            $default_tax_percentage = 7.5;
        }

        $this->page_data['default_tax_percentage'] = $default_tax_percentage;
        $this->page_data['clients'] = $this->workorder_model->getclientsById();
        $this->page_data['default_cust_id'] = $default_cust_id;
        $this->page_data['workorder']  = $workorder;
        $this->page_data['w_customer'] = $w_customer;
        $this->page_data['w_items']    = $w_items;
        $this->page_data['page_title'] = "Invoice Add";
        $this->page_data['page']->title = 'Invoices & Payments';
        $this->page_data['page']->parent = 'Sales';
        $this->page_data['tags'] = $this->JobTags_model->getAllByCompanyId($company_id);        
        $this->page_data['items'] = $this->items_model->getAllItemWithLocation();
        $this->page_data['itemsLocation'] = $this->items_model->getLocationStorage();

        $this->load->view('v2/pages/invoice/add', $this->page_data);
    }

    public function standard_invoice_template(){
    $this->load->view('v2/pages/invoice/standard_invoice_template');
   }
    public function estimateConversion($id)
    {
        
        $query       = $this->input->get();        
        $workorder   = array();
        $w_customer  = array();
        $w_items     = array();
        if( isset($query['workorder']) ){            
            $this->load->model('Workorder_model');
            $this->load->model('AcsProfile_model');
            $workorder   = $this->Workorder_model->getByWhere(['work_order_number' => $query['workorder']]);
            $w_items     = $this->Workorder_model->getworkorderItems($workorder[0]->id);
            $w_customer  = $this->AcsProfile_model->getByProfId($workorder[0]->customer_id);
        }

        $user_id = logged('id');
        // $parent_id = $this->db->query("select parent_id from users where id=$user_id")->row();

        // if ($parent_id->parent_id == 1) { // ****** if user is company ******//
        $this->page_data['users'] = $this->users_model->getAllUsersByCompany($user_id);
        // } else {
        //     $this->page_data['users'] = $this->users_model->getAllUsersByCompany($parent_id->parent_id, $user_id);
        // }
        $company_id = logged('company_id');
        $role = logged('role');
        // $this->page_data['workstatus'] = $this->Workstatus_model->getByWhere(['company_id'=>$company_id]);
        if ($role == 1 || $role == 2) {
            // $this->page_data['customers'] = $this->AcsProfile_model->getAllByCompanyId($company_id);
            $this->page_data['customers'] = $this->AcsProfile_model->getAll();
        } else {
            // $this->page_data['customers'] = $this->AcsProfile_model->getAll();
            $this->page_data['customers'] = $this->AcsProfile_model->getAllByCompanyId($company_id);
        }


        $setting = $this->invoice_settings_model->getAllByCompany(logged('company_id'));
        $terms = $this->accounting_terms_model->getCompanyTerms_a($company_id);
        $this->page_data['number'] = $this->invoice_model->getlastInsert();

        if (!empty($setting)) {
            foreach ($setting as $key => $value) {
                if (is_serialized($value)) {
                    $setting->{$key} = unserialize($value);
                }
            }
            $this->page_data['setting'] = $setting;
            $this->page_data['terms'] = $terms;
        }

        $default_cust_id = 0;
        if( $this->input->get('cus_id') ){
            $default_cust_id = $this->input->get('cus_id');
        }

        $this->page_data['default_cust_id'] = $default_cust_id;
        $this->page_data['workorder']  = $workorder;
        $this->page_data['w_customer'] = $w_customer;
        $this->page_data['w_items']    = $w_items;
        $this->page_data['items']      = $this->items_model->getItemlist();
        $this->page_data['estimate'] = $this->estimate_model->getById($id);
        $this->page_data['itemsDetails'] = $this->estimate_model->getItemlistByID($id);

        $this->load->view('invoice/estimateConversion', $this->page_data);
    }

    public function addNewInvoice()
    {
        $comp_id = logged('company_id');
        $user_id = logged('id');
        $post    = $this->input->post();
        
        $invoice_data = array(
            'invoice_number' => $post['invoice_number'],
            'invoice_type' => $post['invoice_type'],
            'purchase_order' => $post['po_number'],
            'date_issued' => date("Y-m-d",strtotime($post['date_issued'])),
            'due_date' => date("Y-m-d",strtotime($post['due_date'])),
            'deposit_request_type' => 1, // 1 = amount / 2 = percentage
            'deposit_request' => $post['deposit_request'],
            'tip' => $post['tip'],
            'message_to_customer' => $post['message_to_customer'],
            'terms_and_conditions' => $post['terms_and_conditions'],
            'date_updated'         => date("Y-m-d H:i:s")
        );

        $invoice = $this->invoice_model->update($post['inid'], $invoice_data);        
        customerAuditLog(logged('id'), $post['customer_id'], $post['inid'], 'Invoice', 'Created invoice #'.$post['invoice_number']);
        if($addQuery > 0){
            $a          = $post['itemid'];
            // $packageID  = $this->input->post('packageID');
            $quantity   = $post['quantity'];
            $price      = $post['price'];
            $h          = $post['tax'];
            $discount   = $post['discount'];
            $total      = $post['total'];

            $i = 0;
            foreach($a as $row){
                $data['items_id']       = $a[$i];
                // $data['package_id ']    = $packageID[$i];
                $data['qty']            = $quantity[$i];
                $data['cost']           = $price[$i];
                $data['tax']            = $h[$i];
                $data['discount']       = $discount[$i];
                $data['total']          = $total[$i];
                $data['invoice_id']     = $post['inid'];
                $addQuery2 = $this->invoice_model->add_invoice_details($data);
                $i++;
            }

            $getname = $this->invoice_model->getname($user_id);
            $notif = array(        
                'user_id'               => $user_id,
                'title'                 => 'New Invoice',
                'content'               => $getname->FName. ' has created new Invoice.'. $this->input->post('invoice_number'),
                'date_created'          => date("Y-m-d H:i:s"),
                'status'                => '1',
                'company_id'            => getLoggedCompanyID()
            );
            $notification = $this->invoice_model->save_notification($notif);


            if (!is_null($this->input->get('json', TRUE))) {
                header('content-type: application/json');
                exit(json_encode(['id' => $addQuery]));
            } else {
                redirect('invoice');
            }
        }
        else{
            echo json_encode(0);
        }
    }

    public function recurring_add()
    {
        $user_id = logged('id');
        $parent_id = $this->db->query("select parent_id from users where id=$user_id")->row();

        if ($parent_id->parent_id == 1) { // ****** if user is company ******//
            $this->page_data['users'] = $this->users_model->getAllUsersByCompany($user_id);
        } else {
            $this->page_data['users'] = $this->users_model->getAllUsersByCompany($parent_id->parent_id, $user_id);
        }

        $setting = $this->invoice_settings_model->getAllByCompany(logged('company_id'));

        if (!empty($setting)) {
            foreach ($setting as $key => $value) {
                if (is_serialized($value)) {
                    $setting->{$key} = unserialize($value);
                }
            }
            $this->page_data['setting'] = $setting;
        }

        $this->load->view('invoice/add_recurring', $this->page_data);
    }


    public function settings()
    {
        $this->page_data['page']->title = 'Invoice Settings';
        $this->page_data['page']->parent = 'Sales';

        $is_allowed = $this->isAllowedModuleAccess(38);
        if (!$is_allowed) {
            $this->page_data['module'] = 'settings3';
            echo $this->load->view('no_access_module', $this->page_data, true);
            die();
        }

        $comp_id = logged('company_id');
        $this->page_data['setting'] = null;
        $setting = $this->invoice_settings_model->getByCompanyId($comp_id);
        $this->page_data['setting'] = $setting;
        $this->load->view('v2/pages/invoice/settings', $this->page_data);
    }


    public function save()
    {
        postAllowed();

        // echo '<pre>'; print_r($this->input->post()); die;

        $user = (object)$this->session->userdata('logged');

        if (count(post('item')) > 0) {
            $items = post('item');
            $quantity = post('quantity');
            $price = post('price');
            $discount = post('discount');
            $type = post('item_type');
            $tax = post('tax');
            $total = post('total');

            foreach (post('item') as $key => $val) {
                $itemArray[] = array(

                    'item' => $items[$key],
                    'item_type' => $type[$key],
                    'quantity' => $quantity[$key],
                    'price' => $price[$key],
                    'discount' => $discount[$key],
                    'tax' => $tax[$key],
                    'total' => $total[$key]
                );
            }

            $invoice_items = serialize($itemArray);
        } else {
            $invoice_items = '';
        }

        $invoice_totals = array(

            'sub_total' => post('sub_total') ? post('sub_total') : 0,
            'adjustment_amount' => post('adjustment_amount') ? post('adjustment_amount') : 0,
            'grand_total' => post('grand_total') ? post('grand_total') : 0
        );

        $comp_id = logged('company_id');

        $id = $this->invoice_model->create([
            'user_id' => $user->id,
            'company_id' => $comp_id,
            'customer_id' => post('customer_id'),
            'job_location' => post('job_location'),
            'job_name' => post('job_name'),
            'date_issued' => date('Y-m-d', strtotime(post('date_issued'))),
            'due_date' => date('Y-m-d', strtotime(post('due_date'))),
            'purchase_order' => post('purchase_order'),
            'work_order_number' => post('work_order'),
            'invoice_number' => post('invoice_number'),
            'invoice_type' => post('invoice_type'),
            'accept_credit_card' => post('credit_card'),
            'accept_check' => post('check'),
            'accept_direct_deposit' => post('deposit'),
            'accept_cash' => post('cash'),
            'status' => 'Draft',
            'invoice_items' => $invoice_items,
            'invoice_totals' => serialize($invoice_totals),
            'deposit_request' => post('deposit_request'),
            'message_to_customer' => post('message'),
            'terms_and_conditions' => post('terms_conditions')
        ]);

        $this->activity_model->add('New Invoice $' . $user->id . ' Created by User:' . logged('name'), logged('id'));
        $this->session->set_flashdata('alert-type', 'success');
        $this->session->set_flashdata('alert', 'New Invoice Created Successfully');

        redirect('invoice');
    }

    public function save_payment_record()
    {
        postAllowed();

        $user = (object)$this->session->userdata('logged');
        $comp_id = logged('company_id');

        $id = $this->payment_records_model->create([
            'user_id' => logged('id'),
            'company_id' => $comp_id,
            'customer_id' => post('customer_id'),
            'invoice_amount' => post('amount'),
            'invoice_tip' => post('amount_tip'),
            'payment_date' => date('Y-m-d', strtotime(post('date_payment'))),
            'payment_method' => post('payment_method'),
            'invoice_number' => post('invoice_number'),
            'reference_number' => post('reference'),
            'notes' => post('notes')
        ]);

        $this->activity_model->add('New Payment Record $' . logged('id') . ' Created by User:' . logged('name'), logged('id'));
        $this->session->set_flashdata('alert-type', 'success');
        $this->session->set_flashdata('alert', 'New Payment Recorded Successfully');

        redirect('invoice/genview/'.post('invoice_id'));
    }

    public function save_recurring()
    {
        postAllowed();

        $user = (object)$this->session->userdata('logged');

        if (count(post('item')) > 0) {
            $items = post('item');
            $quantity = post('quantity');
            $price = post('price');
            $discount = post('discount');
            $type = post('item_type');
            $tax = post('tax');
            $total = post('total');

            foreach (post('item') as $key => $val) {
                $itemArray[] = array(

                    'item' => $items[$key],
                    'item_type' => $type[$key],
                    'quantity' => $quantity[$key],
                    'price' => $price[$key],
                    'discount' => $discount[$key],
                    'tax' => $tax[$key],
                    'total' => $total[$key]
                );
            }

            $invoice_items = serialize($itemArray);
        } else {
            $invoice_items = '';
        }

        $invoice_totals = array(
            'sub_total' => post('sub_total') ? post('sub_total') : 0,
            'adjustment_amount' => post('adjustment_amount') ? post('adjustment_amount') : 0,
            'grand_total' => post('grand_total') ? post('grand_total') : 0
        );

        $repeats = array(
            'repeats' => post('repeats'),
            'repeat_every' => post('recurring_interval'),
            'repeat_on' => post('recurring_frequency_weekday')
        );

        switch (post('recurring_end')) {
            case "on":
                $end_date = post('recurring_until');
                break;
            case "count":
                $end_date = post('recurring_count');
                break;

            default:
                $end_date = post('recurring_end');
                break;
        }

        $comp_id = logged('company_id');

        $id = $this->invoice_model->create([
            'user_id' => $user->id,
            'company_id' => $comp_id,
            'customer_id' => post('customer_id'),
            'job_location' => post('job_location'),
            'job_name' => post('job_name'),
            'purchase_order' => post('purchase_order'),
            'work_order_number' => post('work_order'),
            'invoice_type' => post('invoice_type'),
            'accept_credit_card' => post('credit_card'),
            'accept_check' => post('check'),
            'accept_direct_deposit' => post('deposit'),
            'accept_cash' => post('cash'),
            'start_on' => post('start_on'),
            'end_date' => $end_date,
            'due_terms' => post('due_terms'),
            'sent_time' => post('recurring_scheduled_time'),
            'status' => 'Draft',
            'is_recurring' => 1,
            'repeats' => serialize($repeats),
            'invoice_items' => $invoice_items,
            'invoice_totals' => serialize($invoice_totals),
            'deposit_request' => post('deposit_request'),
            'message_to_customer' => post('message'),
            'terms_and_conditions' => post('terms_conditions')
        ]);

        $this->activity_model->add('New Recurring Invoice $' . $user->id . ' Created by User:' . logged('name'), logged('id'));
        $this->session->set_flashdata('alert-type', 'success');
        $this->session->set_flashdata('alert', 'New Recurring Invoice Created Successfully');

        redirect('invoice/recurring');
    }

    public function save_setting($id = null)
    {
        postAllowed();

        $comp_id = logged('company_id');
        $user = (object)$this->session->userdata('logged');

        $invoiceSettingFolderPath = "./uploads/invoice/settings/".$comp_id."/";            
        if(!file_exists($invoiceSettingFolderPath)) {
            mkdir($invoiceSettingFolderPath, 0777, true);
        }

        $logo = '';
        if(isset($_FILES['userfile']) && $_FILES['userfile']['tmp_name'] != '') {
            $tmp_name   = $_FILES['userfile']['tmp_name'];
            $extension  = strtolower(end(explode('.',$_FILES['userfile']['name'])));
            $logo = "invoice_setting_".time().'.'.$extension;
            move_uploaded_file($tmp_name, $invoiceSettingFolderPath.$logo);
        }else{
            if ($id && post('img_setting') != '') {
                $logo = post('img_setting');
            } 
        }
        
        if (!$id) {
            $this->invoice_settings_model->create([
                'company_id' => $comp_id,
                'logo' => $logo,
                'check_payable_to' => post('payment_to'),
                'due_terms' => post('due_terms'),
                'payment_fee_amount' => serialize($payment_fee),
                'recurring' => post('recurring_on_add_child'),
                'mobile_payment' => post('payment_mobile_status'),
                'accept_tip' => post('tip_status') ? post('tip_status') : 0,
                'auto_convert_completed_work_order' => post('autoconvert_work_order'),
                'residential_message' => post('message') ? post('message') : '',
                'residential_terms_and_conditions' => post('terms') ? post('terms') : '',
                'commercial_message' => post('message_commercial') ? post('message_commercial') : '',
                'commercial_terms_and_conditions' => post('terms_commercial') ? post('terms_commercial') : '',
                'hide_item_price' => post('hide_item_price') ? post('hide_item_price') : 0,
                'hide_item_qty' => post('hide_item_qty') ? post('hide_item_qty') : 0,
                'hide_item_tax' => post('hide_item_tax') ? post('hide_item_tax') : 0,
                'hide_item_discount' => post('hide_item_discount') ? post('hide_item_discount') : 0,
                'hide_item_total' => post('hide_item_total') ? post('hide_item_total') : 0,
                'hide_from_email' => post('hide_from_email') ? post('hide_from_email') : 0,
                'hide_item_subtotal' => post('show_item_type_subtotal') ? post('show_item_type_subtotal') : 0,
                'hide_business_phone' => post('from_phone_show') ? post('from_phone_show') : 0,
                'hide_office_phone' => post('from_office_phone_show') ? post('from_office_phone_show') : 0,
                'payment_fee_percent' => post('payment_fee_percent'),
                'payment_fee_amount' => post('payment_fee_amount')
            ]);
        } else {
            $this->invoice_settings_model->update($id, [
                'logo' => $logo,
                'check_payable_to' => post('payment_to'),
                'due_terms' => post('due_terms'),
                'payment_fee_amount' => serialize($payment_fee),
                'recurring' => post('recurring_on_add_child'),
                'mobile_payment' => post('payment_mobile_status'),
                'accept_tip' => post('tip_status') ? post('tip_status') : 0,
                'auto_convert_completed_work_order' => post('autoconvert_work_order'),
                'residential_message' => post('message') ? post('message') : '',
                'residential_terms_and_conditions' => post('terms') ? post('terms') : '',
                'commercial_message' => post('message_commercial') ? post('message_commercial') : '',
                'commercial_terms_and_conditions' => post('terms_commercial') ? post('terms_commercial') : '',
                'hide_item_price' => post('hide_item_price') ? post('hide_item_price') : 0,
                'hide_item_qty' => post('hide_item_qty') ? post('hide_item_qty') : 0,
                'hide_item_tax' => post('hide_item_tax') ? post('hide_item_tax') : 0,
                'hide_item_discount' => post('hide_item_discount') ? post('hide_item_discount') : 0,
                'hide_item_total' => post('hide_item_total') ? post('hide_item_total') : 0,
                'hide_from_email' => post('hide_from_email') ? post('hide_from_email') : 0,
                'hide_item_subtotal' => post('show_item_type_subtotal') ? post('show_item_type_subtotal') : 0,
                'hide_business_phone' => post('from_phone_show') ? post('from_phone_show') : 0,
                'hide_office_phone' => post('from_office_phone_show') ? post('from_office_phone_show') : 0,
                'payment_fee_percent' => post('payment_fee_percent'),
                'payment_fee_amount' => post('payment_fee_amount')
            ]);
        }

        $this->activity_model->add('Update Invoice Settings $' . $user->id . ' Created by User:' . logged('name'), logged('id'));
        $this->session->set_flashdata('alert-type', 'success');
        $this->session->set_flashdata('alert', 'Invoice Settings Saved Successfully');

        redirect('invoice/settings');
    }

    public function save_new_customer()
    {
        $company_id  = getLoggedCompanyID();
        // $user_id  = getLoggedUserID();
        $user_id    = logged('id');

        if ($this->input->post('notify_by_email') == 1) {
            $notify_by_email = '1';
        } else {
            $notify_by_email = '0';
        }

        if ($this->input->post('notify_by_sms') == 1) {
            $notify_by_sms = '1';
        } else {
            $notify_by_sms = '0';
        }

        if ($this->input->post('street_address') == null) {
            $street_address = '';
        } else {
            $street_address = $this->input->post('street_address');
        }

        if ($this->input->post('suite_unit') == null) {
            $suite_unit = '';
        } else {
            $suite_unit = $this->input->post('suite_unit');
        }

        if ($this->input->post('city') == null) {
            $city = '';
        } else {
            $city = $this->input->post('city');
        }

        if ($this->input->post('postcode') == null) {
            $postcode = '';
        } else {
            $postcode = $this->input->post('postcode');
        }

        if ($this->input->post('state') == null) {
            $state = '';
        } else {
            $state = $this->input->post('state');
        }

        $new_data = array(
            'fk_user_id' => $user_id,
            // 'contact_name' => $this->input->post('contact_name'),
            'first_name'            => $this->input->post('first_name'),
            'last_name'             => $this->input->post('last_name'),
            'middle_name'           => $this->input->post('middle_name'),
            'email'                 => $this->input->post('contact_email'),
            'phone_m'               => $this->input->post('contact_mobile'),
            'phone_h'               => $this->input->post('contact_phone'),
            'business_name'         => $this->input->post('business_name'),
            'customer_type'         => $this->input->post('customer_type'),
            'suffix'                => $this->input->post('suffix_name'),
            'date_of_birth'         => $this->input->post('date_of_birth'),
            'ssn'                   => $this->input->post('social_security_number'),

            'mail_add'              => $street_address,
            'cross_street'          => $street_address,
            'subdivision'           => $suite_unit,
            'city'                  => $city,
            'zip_code'              => $postcode,
            'state'                 => $state,

            'notify_email'          => $notify_by_email,
            'notify_sms'            => $notify_by_sms,
            'company_id'            => $company_id,
        );

        // $new_data = array(
        //     'company_id'                => $company_id,
        //     'fk_user_id'                => $user_id,
        //     'customer_type'             => $this->input->post('customer_type'),
        //     'first_name'                => $this->input->post('first_name'),
        //     'middle_name'               => $this->input->post('middle_name'),
        //     'last_name'                 => $this->input->post('last_name'),
        //     'email'                     => $this->input->post('contact_email'),
        //     'mail_add'                  => $this->input->post('street_address'),
        //     'city'                      => $this->input->post('city'),
        //     'state'                     => $this->input->post('state'),
        //     'zip_code'                  => $this->input->post('postcode'),
        //     'cross_street'              => $this->input->post('street_address'),
        //     'phone_h'                   => $this->input->post('contact_phone'),
        //     'phone_m'                   => $this->input->post('contact_mobile'),
        //     'suffix'                    => $this->input->post('suffix_name'),
        //     'date_of_birth'             => $this->input->post('date_of_birth'),
        //     'ssn'                       => $this->input->post('social_security_number'),
        //     'status'                    => $this->input->post('status')
        // );

        $addQuery = $this->invoice_model->savenewCustomer($new_data);

        if ($addQuery > 0) {
            // echo 'Congrats, new customer added!';
            echo json_encode($addQuery);
        //$this->session->set_flashdata('Method added');
        } else {
            echo json_encode(0);
        }
    }

    public function deleteInvoiceBtnNew()
    {
        $is_success = false;

        $id = $this->input->post('id');

        $invoice = $this->invoice_model->getinvoice($id);
        if($invoice){
            $data = array(
                'id' => $id,
                'view_flag' => '1',
            );

            $is_success = $this->invoice_model->deleteInvoice($data);

            customerAuditLog(logged('id'), $invoice->customer_id, $invoice->id, 'Invoice', 'Deleted invoice #'.$invoice->invoice_number);
        }

        echo json_encode($is_success);
    }
    
    public function void_invoice()
    {
        $id = $this->input->post('id');

        $data = array(
            'id' => $id,
            'voided' => '1',
        );

        $delete = $this->invoice_model->void_invoice($data);

        echo json_encode($delete);
    }

    
    public function getPackageItemsById()
    {
        // $packId = $this->input->post('packId');

        $items = $this->invoice_model->getPackageItemsById();
        $this->page_data['pItems'] = $items;

        echo json_encode($this->page_data);
    }

    public function invoice_edit($id)
    {
        
        $this->load->helper('functions');
        $comp_id = logged('company_id');
        $user_id = logged('id');
        // $parent_id = $this->db->query("select parent_id from users where id=$user_id")->row();

        // if ($parent_id->parent_id == 1) {
        $this->page_data['users'] = $this->users_model->getAllUsersByCompany($user_id);
        // } else {
        // $this->page_data['users'] = $this->users_model->getAllUsersByCompany($parent_id->parent_id, $user_id);
        // }
        $this->page_data['customers'] = $this->accounting_invoices_model->getCustomers();
        $terms = $this->accounting_terms_model->getCompanyTerms_a($comp_id);

        $this->page_data['invoice'] = $this->invoice_model->getinvoice($id);
        // $this->page_data['items'] = $this->items_model->getItemlist();
        $this->page_data['itemsDetails'] = $this->invoice_model->getInvoiceItems($id);
        $this->page_data['terms'] =  $terms;
        // print_r($this->page_data['invoice']);
        
        $this->page_data['items'] = $this->items_model->getAllItemWithLocation();
        $this->page_data['itemsLocation'] = $this->items_model->getLocationStorage();

        $this->load->view('invoice/invoice_edit', $this->page_data);
    }

    public function getPackageById()
    {
        $items = $this->invoice_model->getPackageById();
        $this->page_data['pName'] = $items;

        echo json_encode($this->page_data);
    }

    public function addNewPackageToList()
    {
        $dataQuery = $this->input->post('packId');

        $details = $this->invoice_model->getPackageDetails($dataQuery);
        $pName = $this->invoice_model->getPackageName($dataQuery);

        $this->page_data['details'] = $details;
        $this->page_data['pName'] = $pName;

        // echo json_encode($this->page_data);
        echo json_encode($this->page_data);
    }

    
    public function updateInvoice()
    {
        $id = $this->input->post('invoiceDataID');
        // dd($this->input->post('customer_id'));

        $update_data = array(
            'id'                        => $this->input->post('invoiceDataID'),//
            'customer_id'               => $this->input->post('customer_id'),//
            'job_location'              => $this->input->post('jobs_location'), //
            'job_name'                  => $this->input->post('job_name'),//
            'invoice_type'              => $this->input->post('invoice_type'),//
            'purchase_order'            => $this->input->post('purchase_order'),//
            'date_issued'               => $this->input->post('date_issued'),//
            'due_date'                  => $this->input->post('due_date'),//
            'status'                    => $this->input->post('status'),//
            'customer_email'            => $this->input->post('customer_email'),//
            'online_payments'           => $this->input->post('online_payments'),
            'billing_address'           => $this->input->post('billing_address'),//
            'shipping_to_address'       => $this->input->post('shipping_to_address'),
            'ship_via'                  => $this->input->post('ship_via'),//
            'shipping_date'             => $this->input->post('shipping_date'),
            'tracking_number'           => $this->input->post('tracking_number'),//
            'terms'                     => $this->input->post('terms'),//
            'location_scale'            => $this->input->post('location_scale'),//
            'message_on_invoice'        => $this->input->post('message_on_invoice'),
            'message_on_statement'      => $this->input->post('message_on_statement'),
            'job_number'                => $this->input->post('job_number'), //to add on database
            // 'attachments'            => $this->input->post('attachments'),
            'tags'                      => $this->input->post('tags'),//
            // 'total_due'              => $this->input->post('total_due'),
            // 'balance'                => $this->input->post('balance'),
            'deposit_request_type'      => $this->input->post('deposit_request_type'),
            'deposit_request'           => $this->input->post('deposit_amount'),
            'message_to_customer'       => $this->input->post('message_to_customer'),
            'terms_and_conditions'      => $this->input->post('terms_and_conditions'),
            // 'signature'              => $this->input->post('signature'),
            // 'sign_date'              => $this->input->post('sign_date'),
            // 'is_recurring'           => $this->input->post('is_recurring'),
            // 'invoice_totals'         => $this->input->post('invoice_totals'),
            'phone'                     => $this->input->post('phone'),
            'payment_schedule'          => $this->input->post('payment_schedule'),
            'subtotal'                  => $this->input->post('subtotal'),
            'taxes'                     => $this->input->post('taxes'),
            'adjustment_name'           => $this->input->post('adjustment_name'),
            'adjustment_value'          => $this->input->post('adjustment_value'),
            'monthly_monitoring'        => $this->input->post('monthly_monitoring'),
            'installation_cost'         => $this->input->post('installation_cost'),
            'program_setup'             => $this->input->post('program_setup'),
            'grand_total'               => $this->input->post('grand_total'),
            'date_updated'              => date("Y-m-d H:i:s"),
        );
        $addQuery = $this->invoice_model->update_invoice_data($update_data);
        $objInvoice = $this->invoice_model->getinvoice($this->input->post('invoiceDataID'));

        customerAuditLog(logged('id'), $this->input->post('customer_id'), $this->input->post('invoiceDataID'), 'Invoice', 'Updated invoice #'.$objInvoice->invoice_number);

        $delete2 = $this->invoice_model->delete_items($id);


        // if($addQuery > 0){
        // $a = $this->input->post('items');
        // $b = $this->input->post('item_type');
        // $d = $this->input->post('quantity');
        // $f = $this->input->post('price');
        // $g = $this->input->post('discount');
        // $h = $this->input->post('tax');
        // $ii = $this->input->post('total');

        // $i = 0;
        // foreach($a as $row){
        //     $data['item'] = $a[$i];
        //     $data['item_type'] = $b[$i];
        //     $data['qty'] = $d[$i];
        //     $data['cost'] = $f[$i];
        //     $data['discount'] = $g[$i];
        //     $data['tax'] = $h[$i];
        //     $data['total'] = $ii[$i];
        //     $data['type'] = 'Work Order';
        //     $data['type_id'] = $id;
        //     // $data['status'] = '1';
        //     $data['created_at'] = date("Y-m-d H:i:s");
        //     $data['updated_at'] = date("Y-m-d H:i:s");
        //     $addQuery2 = $this->accounting_invoices_model->additem_details($data);
        //     $i++;
        // }
        // if($addQuery > 0){
        $a          = $this->input->post('itemid');
        $quantity   = $this->input->post('quantity');
        $price      = $this->input->post('price');
        $h          = $this->input->post('tax');
        $total      = $this->input->post('total');
    
        $i = 0;
        $a = is_array($a) ? $a : [];
        foreach ($a as $row) {
            $data['items_id'] = $a[$i];
            $data['qty'] = $quantity[$i];
            $data['cost'] = $price[$i];
            $data['tax'] = $h[$i];
            $data['total'] = $total[$i];
            $data['invoice_id '] = $id;
            $addQuery2 = $this->invoice_model->add_invoice_items($data);
            $i++;
        }

        if (!is_null($this->input->get('json', TRUE))) {
            header('content-type: application/json');
            exit(json_encode(['id' => $addQuery]));
        } else {
            // redirect('accounting/invoices');
            redirect('invoice');
        }
    }

    public function edit($id)
    {
        $comp_id = logged('company_id');
        $user_id = logged('id');
        // $parent_id = $this->db->query("select parent_id from users where id=$user_id")->row();

        // if ($parent_id->parent_id == 1) {
        $this->page_data['users'] = $this->users_model->getAllUsersByCompany($user_id);
        // } else {
        // $this->page_data['users'] = $this->users_model->getAllUsersByCompany($parent_id->parent_id, $user_id);
        // }

        $this->page_data['invoice'] = $this->invoice_model->getById($id);

        $this->load->view('invoice/edit', $this->page_data);
    }

    public function update($id)
    {
        postAllowed();

        // echo '<pre>'; print_r($this->input->post()); die;

        $user = (object)$this->session->userdata('logged');

        if (count(post('item')) > 0) {
            $items = post('item');
            $quantity = post('quantity');
            $price = post('price');
            $discount = post('discount');
            $type = post('item_type');
            $location = post('location');

            foreach (post('item') as $key => $val) {
                $itemArray[] = array(

                    'item' => $items[$key],
                    'item_type' => $type[$key],
                    'quantity' => $quantity[$key],
                    'location' => $location[$key],
                    'discount' => $discount[$key],
                    'price' => $price[$key]
                );
            }

            $invoice_items = serialize($itemArray);
        } else {
            $invoice_items = '';
        }

        $invoice_totals = array(

            'sub_total' => post('sub_total') ? post('sub_total') : 0,
            'adjustment_amount' => post('adjustment_amount') ? post('adjustment_amount') : 0,
            'grand_total' => post('grand_total') ? post('grand_total') : 0
        );

        $comp_id = logged('company_id');

        $id = $this->invoice_model->update($id, [

            'user_id' => $user->id,
            'company_id' => $comp_id,
            'customer_id' => post('customer_id'),
            'job_location' => post('job_location'),
            'job_name' => post('job_name'),
            'date_issued' => date('Y-m-d', strtotime(post('date_issued'))),
            'due_date' => date('Y-m-d', strtotime(post('due_date'))),
            'purchase_order' => post('purchase_order'),
            'work_order_number' => post('work_order'),
            'invoice_number' => post('invoice_number'),
            'invoice_type' => post('invoice_type'),
            'accept_credit_card' => post('credit_card'),
            'accept_check' => post('check'),
            'accept_direct_deposit' => post('deposit'),
            'accept_cash' => post('cash'),
            'invoice_items' => $invoice_items,
            'invoice_totals' => serialize($invoice_totals),
            'deposit_request' => post('deposit_request'),
            'message_to_customer' => post('customer_message'),
            'terms_and_conditions' => post('terms_conditions')
        ]);

        $this->activity_model->add('New User $' . $user->id . ' Created by User:' . logged('name'), logged('id'));
        $this->session->set_flashdata('alert-type', 'success');
        $this->session->set_flashdata('alert', 'Invoice has been Updated Successfully');

        redirect('invoice');
    }

    /**
    * @param $id
    */
    public function genview($id)
    {
        $this->load->model('CustomerAuditLog_model');
        $this->load->model('CompanyOnlinePaymentAccount_model');

        $invoice = get_invoice_by_id($id);

        if( $invoice->view_flag == 1 ){
            redirect('invoice');
        }

        $user = get_user_by_id(logged('id'));
        $cid  = logged('company_id');        
        
        if (!empty($invoice)) {
            foreach ($invoice as $key => $value) {
                if (is_serialized($value)) {
                    $invoice->{$key} = unserialize($value);
                }
            }
            $this->page_data['invoice'] = $invoice;
            $this->page_data['user'] = $user;
        } else {
            redirect('invoice');
        }

        $invoiceLogs = $this->CustomerAuditLog_model->getAllByObjIdAndModule($id, 'Invoice');
        $companyOnlinePaymentAccount = $this->CompanyOnlinePaymentAccount_model->getByCompanyId($cid);

        $this->page_data['record_payment'] = $this->input->get('do');
        $this->page_data['payments'] = $this->payment_records_model->getAllByInvoiceId($invoice->id);
        $this->page_data['items'] = $this->invoice_model->getItemsInv($id);
        $this->page_data['invoice_template'] = $this->generateInvoiceHTML($id);
        $this->page_data['invoiceLogs'] = $invoiceLogs;
        $this->page_data['onlinePaymentAccount'] = $companyOnlinePaymentAccount;
        $this->page_data['page_title'] = "View Invoice";
        $this->page_data['page']->title = 'Invoices & Payments';
        $this->page_data['page']->parent = 'Sales';        

        $this->load->view('v2/pages/invoice/genview', $this->page_data);
        //$this->load->view('invoice/genview', $this->page_data);
    }

    public function print($id)
    {
        $this->page_data['invoice_template'] = $this->generateInvoiceHTML($id);
        $this->load->view('invoice/print', $this->page_data);
    }

    public function invoicePreview($id)
    {
        echo $this->generateInvoiceHTML($id);
    }

    public function generateInvoiceHTML($id, $type = 1)
    {
        $this->load->model('general_model');
        $this->load->model('AcsProfile_model');
        $this->load->model('CompanyOnlinePaymentAccount_model');

        $invoice = get_invoice_by_id($id);

        if (!empty($invoice)) {
            foreach ($invoice as $key => $value) {
                if (is_serialized($value)) {
                    $invoice->{$key} = unserialize($value);
                }
            }
            $this->page_data['invoice'] = $invoice;
        }

        $this->page_data['items'] = $this->invoice_model->getItemsInv($id);

        $get_company_info = array(
            'where' => array(
                'company_id' => $invoice->company_id,
            ),
            'table' => 'business_profile',
            'select' => 'id,business_phone,business_name,business_logo,business_email,street,city,postal_code,state,business_image',
        );

        $this->page_data['company_info'] = $this->general_model->get_data_with_param($get_company_info, false);
        $this->page_data['customer'] = $this->AcsProfile_model->getByProfId($invoice->customer_id);

        if( $type == 1 ){
            return $this->load->view('v2/pages/invoice/back-invoice-template', $this->page_data, true);
        }else{
            $companyOnlinePaymentAccount = $this->CompanyOnlinePaymentAccount_model->getByCompanyId($invoice->company_id);                
            if( $companyOnlinePaymentAccount && ($companyOnlinePaymentAccount->braintree_merchant_id != '' && $companyOnlinePaymentAccount->braintree_public_key != '' && $companyOnlinePaymentAccount->braintree_private_key != '') ){
                $gateway = new Braintree\Gateway([
                    'environment' => BRAINTREE_ENVIRONMENT,
                    'merchantId' => $companyOnlinePaymentAccount->braintree_merchant_id,
                    'publicKey' => $companyOnlinePaymentAccount->braintree_public_key,
                    'privateKey' => $companyOnlinePaymentAccount->braintree_private_key
                ]);

                try {
                    $braintree_token = $gateway->ClientToken()->generate();	
                } catch (Exception $e) {
                    $braintree_token = '';
                }
            }   
            $this->page_data['braintree_token'] = $braintree_token;
            return $this->load->view('v2/pages/invoice/front-invoice-template', $this->page_data, true);
        }        
    }

    /**
     * @param $id
     */
    public function send($id)
    {
        $this->load->model('AcsProfile_model');
        $this->load->model('Business_model');

        $invoice = get_invoice_by_id($id);
        if ($invoice) {
            $customer = $this->AcsProfile_model->getByProfId($invoice->customer_id);
            $company  = $this->Business_model->getByCompanyId($invoice->company_id);
            $this->page_data['invoice']   = $invoice;
            $this->page_data['customer']  = $customer;
            $this->page_data['company']   = $company;
            $this->page_data['scheduled'] = $this->input->get('scheduled');
        }else{

        }

        //$this->load->view('invoice/send', $this->page_data);
        $this->load->view('v2/pages/invoice/send', $this->page_data);
    }

    /**
     * @param $id
     */
    public function mark_as_sent($id)
    {
        $ids = $this->invoice_model->markAsSent($id, logged('company_id'));
        $this->activity_model->add("invoice #$id Mark As Sent by User:" . logged('name'));
        $this->session->set_flashdata('alert-type', 'success');
        $this->session->set_flashdata('alert', 'invoice has been Mark As Sent Successfully');

        redirect('invoice/genview/'.$id);
    }

    /**
     * @param $id
     */
    public function clone($id)
    {
        $invoice = $this->invoice_model->getinvoice($id);  
        $id = $this->invoice_model->duplicateRecord($id, logged('company_id'));

        customerAuditLog(logged('id'), $invoice->customer_id, $invoice->id, 'Invoice', 'Clone invoice #'.$invoice->invoice_number);

        $this->activity_model->add("invoice #$id Clone by User:" . logged('name'));
        $this->session->set_flashdata('alert-type', 'success');
        $this->session->set_flashdata('alert', 'invoice has been Cloned Successfully');

        redirect('invoice');
    }

    /**
     * @param $id
     */
    public function delete($id)
    {
        $id = $this->invoice_model->delete($id);
        $this->activity_model->add("invoice #$id Deleted by User:" . logged('name'));
        $this->session->set_flashdata('alert-type', 'success');
        $this->session->set_flashdata('alert', 'invoice has been Deleted Successfully');

        redirect('invoice');
    }

    public function emailInvoice($invoiceId)
    {
        $this->load->model('AcsProfile_model');

        $invoice = get_invoice_by_id($invoiceId);
        $customer = $this->AcsProfile_model->getByProfId($invoice->customer_id);

        $mail = email__getInstance();
        $mail->FromName = 'NsmarTrac';
        $customerName = $customer->first_name . ' ' . $customer->last_name;
        $mail->addAddress($customer->email, $customerName);
        $mail->isHTML(true);
        $mail->Subject = "nSmartrac: {$invoice->invoice_number} Invoice";
        $mail->Body = $this->generateInvoiceHTML($invoice->id);

        if (!$mail->Send()) {
            $this->session->set_flashdata('alert-type', 'danger');
            $this->session->set_flashdata('alert', 'Cannot send email.');
        } else {
            $this->session->set_flashdata('alert-type', 'success');
            $this->session->set_flashdata('alert', 'Your invoice was successfully sent');
        }

        redirect('invoice/genview/' . $invoiceId);
    }

    /**
     * Sending Invoice Emails
     */
    public function send_email()
    {
        postAllowed();
        // if (!post('scheduled')) {
        // $config = Array(
        //     'protocol'  => 'smtp',
        //     'smtp_host' => 'smtp.gmail.com',
        //     'smtp_port' => 587,
        //     'smtp_user' => 'nsmartrac@gmail.com',
        //     'smtp_pass' => 'nSmarTrac1',
        //     'mailtype'  => 'html',
        //     'charset'   => 'iso-8859-1',
        //     'wordwrap'  => TRUE
        // );

        // $this->load->library('email', $config);

        // $this->email->set_newline("\r\n");
        // $this->email->from(post('from_email'), post('from_name'));
        // // $this->email->to("jeykell125@gmail.com");
        // $this->email->to("emploucelle@gmail.com");
        // $this->email->cc(post('cc[]'));
        // $this->email->bcc(post('bcc[]'));

        // $this->email->subject(post('mail_subject'));
        // $this->email->message(post('mail_msg'));

        // $this->email->send();

        // $this->session->set_flashdata('alert-type', 'success');
        // $this->session->set_flashdata('alert', 'Email has been Sent');

        // $recipient  = "emploucelle@gmail.com";
        $recipient  = post('from_email');
        $message2 = post('mail_msg');
        $subj = post('mail_subject');

        include APPPATH . 'libraries/PHPMailer/PHPMailerAutoload.php';
        $server    = MAIL_SERVER;
        $port      = MAIL_PORT ;
        $username  = MAIL_USERNAME;
        $password  = MAIL_PASSWORD;
        $from      = MAIL_FROM;
        $subject   = $subj;
        $mail = new PHPMailer;
        //$mail->SMTPDebug = 4;
        $mail->isSMTP();
        $mail->Host = $server;
        $mail->SMTPAuth = true;
        $mail->Username   = $username;
        $mail->Password   = $password;
        $mail->getSMTPInstance()->Timelimit = 5;
        $mail->SMTPSecure = 'ssl';
        $mail->Timeout    =   10; // set the timeout (seconds)
        $mail->Port = $port;
        $mail->From = $from;
        $mail->FromName = 'NsmarTrac';

        $mail->addAddress($recipient, $recipient);
        $mail->isHTML(true);
        // $email->attach("/home/yoursite/location-of-file.jpg", "inline");
        $mail->Subject = $subject;
        $mail->Body    = $message2;
        // $cid = $email->attachment_cid($filename);


        $json_data['is_success'] = 1;
        $json_data['error']      = '';

        if (!$mail->Send()) {
            /*echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
            exit;*/
            $json_data['is_success'] = 0;
            $json_data['error']      = 'Mailer Error: ' . $mail->ErrorInfo;
        }

        $this->session->set_flashdata('alert-type', 'success');
        $this->session->set_flashdata('alert', 'Scheduled invoice email has been set');
        // } else {
        //     $this->session->set_flashdata('alert-type', 'success');
        //     $this->session->set_flashdata('alert', 'Scheduled invoice email has been set');
        // }

        redirect('invoice/genview/'.post('invoice_id'));
    }

    public function sendSMS($data)
    {
        // Your Account SID and Auth Token from twilio.com/console
        $sid = 'your_sid';
        $token = 'your_token';
        $client = new Client($sid, $token);

        // Use the client to do fun stuff like send text messages!
        return $client->messages->create(
            // the number you'd like to send the message to
            $data['phone'],
            array(
                // A Twilio phone number you purchased at twilio.com/console
                "from" => "+your Twilio number",
                // the body of the text message you'd like to send
                'body' => $data['text']
            )
        );
    }

    public function tab($index)
    {
        $this->index($index);
    }

    /**
    *
    */
    public function customer()
    {
        // pass the $this so that we can use it to load view, model, library or helper classes
        $invoiceCustomer = new InvoiceCustomer($this);
    }

    public function new_customer_form()
    {
        $get = $this->input->get();

        if (!empty($get)) {
            $this->page_data['action'] = $get['action'];
            $this->page_data['data_index'] = $get['index'];
            $this->page_data['customer'] = $this->customer_model->getCustomer($get['customer_id']);
            $this->page_data['additional_contacts'] = $this->customer_model->getAdditionalContacts(array('id' => $get['customer_id']), $get['index']);
            // print_r($this->page_data['service_address']); die;
        }

        // die($this->load->view('invoice/new_customer_form', $this->page_data, true));
        die($this->load->view('v2/pages/invoice/new_customer_form', $this->page_data, true));
    }

    public function record_payment_form()
    {
        $get = $this->input->get();

        if (!empty($get)) {
            $invoice = get_invoice_by_id($get['invoice_id']);
            $this->page_data['action'] = $get['action'];

            if (!empty($invoice)) {
                foreach ($invoice as $key => $value) {
                    if (is_serialized($value)) {
                        $invoice->{$key} = unserialize($value);
                    }
                }
                $this->page_data['invoice'] = $invoice;
            }
        }

        die($this->load->view('invoice/record_payment_form', $this->page_data, true));
    }

    public function pay_now_form()
    {
        $get = $this->input->get();

        if (!empty($get)) {
            $invoice = get_invoice_by_id($get['invoice_id']);
            $this->page_data['action'] = $get['action'];

            if (!empty($invoice)) {
                foreach ($invoice as $key => $value) {
                    if (is_serialized($value)) {
                        $invoice->{$key} = unserialize($value);
                    }
                }
                $this->page_data['invoice'] = $invoice;
            }
        }

        die($this->load->view('invoice/pay_now_form', $this->page_data, true));
    }

    public function pay_now_form_fr_email($id)
    {
        $get = $this->input->get();

        if (!empty($get)) {
            $invoice = get_invoice_by_id($get['invoice_id']);
            $this->page_data['action'] = $get['action'];

            if (!empty($invoice)) {
                foreach ($invoice as $key => $value) {
                    if (is_serialized($value)) {
                        $invoice->{$key} = unserialize($value);
                    }
                }
                $this->page_data['invoice'] = $invoice;
            }
        }
        
        $this->page_data['invoice'] = $this->invoice_model->getById($id);
        $this->page_data['items'] = $this->invoice_model->getItemsInv($id);

        die($this->load->view('invoice/payNow', $this->page_data, true));
    }

    public function front_pay_now($id)
    {
        include APPPATH . 'libraries/braintree/lib/Braintree.php'; 
        
        $this->load->model('CompanyOnlinePaymentAccount_model');
        $this->load->model('AcsProfile_model');
        $this->load->model('Business_model');
		$this->config->load('api_credentials');

        if ($id > 0) {
            $invoice = $this->invoice_model->getById($id);
            if( $invoice ){
                $company = $this->Business_model->getByCompanyId($invoice->company_id);
                $companyOnlinePaymentAccount = $this->CompanyOnlinePaymentAccount_model->getByCompanyId($invoice->company_id);                
                if( $companyOnlinePaymentAccount && ($companyOnlinePaymentAccount->braintree_merchant_id != '' && $companyOnlinePaymentAccount->braintree_public_key != '' && $companyOnlinePaymentAccount->braintree_private_key != '') ){
                    $gateway = new Braintree\Gateway([
                        'environment' => BRAINTREE_ENVIRONMENT,
                        'merchantId' => $companyOnlinePaymentAccount->braintree_merchant_id,
                        'publicKey' => $companyOnlinePaymentAccount->braintree_public_key,
                        'privateKey' => $companyOnlinePaymentAccount->braintree_private_key
                    ]);
    
                    try {
                        $braintree_token = $gateway->ClientToken()->generate();	
                    } catch (Exception $e) {
                        $braintree_token = '';
                    }
                }         
                
                $this->page_data['onlinePaymentAccount'] = $companyOnlinePaymentAccount;
                $this->page_data['invoice_template']  = $this->generateInvoiceHTML($id, 2);
                $this->page_data['braintree_token'] = $braintree_token;
                $this->page_data['square_client_id'] = $this->config->item('square_client_id');
                $this->page_data['company_info'] = $company;
                $this->load->view('v2/pages/invoice/front_pay_now', $this->page_data);
            }else{
                redirect('/');
            }            
        }else{
            redirect('/');
        }
    }

    public function preview($id)
    {
        $invoice = get_invoice_by_id($id);
        $user = get_user_by_id(logged('id'));
        $company = get_company_by_id(logged('company_id'));
        $this->page_data['invoice'] = $invoice;
        $this->page_data['user'] = $user;
        // $this->page_data['items'] = $user;
        $this->page_data['items'] = $this->invoice_model->getItemsInv($id);
        $this->page_data['users'] = $this->invoice_model->getInvoiceCustomer($id);

        if (!empty($invoice)) {
            foreach ($invoice as $key => $value) {
                if (is_serialized($value)) {
                    $invoice->{$key} = unserialize($value);
                }
            }
            $this->page_data['invoice'] = $invoice;
            $this->page_data['user'] = $user;
        }
        $format = $this->input->get('format');
        $this->page_data['company'] = $company;
        $this->page_data['format'] = $format;
        // print_r($this->page_data['users']);

        if ($format === "pdf") {
            $img = explode("/", parse_url((companyProfileImage(logged('company_id'))) ? companyProfileImage(logged('company_id')) : $url->assets)['path']);
            $this->page_data['profile'] = $img[2] . "/" . $img[3] . "/" . $img[4];
            $filename = "nSmarTrac_invoice_".$id;
            $this->load->library('pdf');
            $this->pdf->load_view('invoice/pdf/template', $this->page_data, $filename, "portrait");
        }elseif($format === "save_pdf"){
            $img = explode("/", parse_url((companyProfileImage(logged('company_id'))) ? companyProfileImage(logged('company_id')) : $url->assets)['path']);
            $this->page_data['profile'] = $img[2] . "/" . $img[3] . "/" . $img[4];
            $filename = "nSmarTrac_invoice_".$id;
            $this->load->library('pdf');
            $this->pdf->save_pdf('invoice/pdf/template', $this->page_data, $filename, "P");
            
        } else {
            $this->page_data['profile'] = (companyProfileImage(logged('company_id'))) ? companyProfileImage(logged('company_id')) : $url->assets;
            $filename = "nSmarTrac_invoice_".$id;
            $this->load->view('invoice/pdf/template', $this->page_data, "portrait");
        }
    }

    /**
     * Get All Data from this method.
     *
     * @return Response
    */

    public function stripePost()
    {
        require_once('application/libraries/stripe-php/init.php');
        \Stripe\Stripe::setApiKey($this->config->item('stripe_secret'));

        \Stripe\Charge::create([
                "amount" => 100 * 100,
                "currency" => "usd",
                "source" => $this->input->post('stripeToken'),
                "description" => "Test payment from nsmartrac.com."
        ]);

        $this->session->set_flashdata('alert-type', 'success');
        $this->session->set_flashdata('alert', 'Payment made successfully');

        redirect('invoice/genview/'.post('invoice_id'));
    }

    public function ajax_save_setting()
    {
        $is_success = 1;
        $msg = 'Cannot find data';

        $comp_id = logged('company_id');
        $user = (object)$this->session->userdata('logged');
        $invoiceSetting = $this->invoice_settings_model->getByCompanyId($comp_id);

        $invoiceSettingFolderPath = "./uploads/invoice/settings/".$comp_id."/";            
        if(!file_exists($invoiceSettingFolderPath)) {
            mkdir($invoiceSettingFolderPath, 0777, true);
        }

        $logo = '';
        if(isset($_FILES['userfile']) && $_FILES['userfile']['tmp_name'] != '') {
            $tmp_name   = $_FILES['userfile']['tmp_name'];
            $extension  = strtolower(end(explode('.',$_FILES['userfile']['name'])));
            $logo = "invoice_setting_".time().'.'.$extension;
            move_uploaded_file($tmp_name, $invoiceSettingFolderPath.$logo);
        }else{            
            if ($invoiceSetting && post('img_setting') != '') {
                $logo = post('img_setting');
            }
        }        
        
        if( $is_success == 1 ){
            if (!$invoiceSetting) {
                $this->invoice_settings_model->create([
                    'company_id' => $comp_id,
                    'logo' => $logo,
                    'invoice_num_prefix' => post('prefix'),
                    'invoice_num_next' => post('base'),
                    'check_payable_to' => post('payment_to'),
                    'due_terms' => post('due_terms'),
                    'payment_fee_amount' => serialize($payment_fee),
                    'recurring' => post('recurring_on_add_child'),
                    'mobile_payment' => post('payment_mobile_status'),
                    'accept_tip' => post('tip_status') ? post('tip_status') : 0,
                    'auto_convert_completed_work_order' => post('autoconvert_work_order'),
                    'residential_message' => post('message') ? post('message') : '',
                    'residential_terms_and_conditions' => post('terms') ? post('terms') : '',
                    'commercial_message' => post('message_commercial') ? post('message_commercial') : '',
                    'commercial_terms_and_conditions' => post('terms_commercial') ? post('terms_commercial') : '',
                    'hide_item_price' => post('hide_item_price') ? post('hide_item_price') : 0,
                    'hide_item_qty' => post('hide_item_qty') ? post('hide_item_qty') : 0,
                    'hide_item_tax' => post('hide_item_tax') ? post('hide_item_tax') : 0,
                    'hide_item_discount' => post('hide_item_discount') ? post('hide_item_discount') : 0,
                    'hide_item_total' => post('hide_item_total') ? post('hide_item_total') : 0,
                    'hide_from_email' => post('hide_from_email') ? post('hide_from_email') : 0,
                    'hide_item_subtotal' => post('show_item_type_subtotal') ? post('show_item_type_subtotal') : 0,
                    'hide_business_phone' => post('from_phone_show') ? post('from_phone_show') : 0,
                    'hide_office_phone' => post('from_office_phone_show') ? post('from_office_phone_show') : 0,
                    'payment_fee_percent' => post('payment_fee_percent'),
                    'payment_fee_amount' => post('payment_fee_amount'),
                    'accept_credit_card' => post('payment_cc') ? post('payment_cc') : 0,
                    'accept_check' => post('payment_check') ? post('payment_check') : 0,
                    'accept_cash' => post('payment_cash') ? post('payment_cash') : 0,
                    'accept_direct_deposit' => post('payment_deposit') ? post('payment_deposit') : 0,
                    'accept_credit' => 0,
                    'mobile_payment' => post('payment_mobile_status') ? post('payment_mobile_status') : 0,
                ]);
    
                $this->activity_model->add('Created Invoice Settings ' . $user->id . ' Created by User:' . logged('name'), logged('id'));
    
            } else {
                $this->invoice_settings_model->update($invoiceSetting->id, [
                    'logo' => $logo,
                    'invoice_num_prefix' => post('prefix'),
                    'invoice_num_next' => post('base'),
                    'check_payable_to' => post('payment_to'),
                    'due_terms' => post('due_terms'),
                    'payment_fee_amount' => serialize($payment_fee),
                    'recurring' => post('recurring_on_add_child'),
                    'mobile_payment' => post('payment_mobile_status'),
                    'accept_tip' => post('tip_status') ? post('tip_status') : 0,
                    'auto_convert_completed_work_order' => post('autoconvert_work_order'),
                    'residential_message' => post('message') ? post('message') : '',
                    'residential_terms_and_conditions' => post('terms') ? post('terms') : '',
                    'commercial_message' => post('message_commercial') ? post('message_commercial') : '',
                    'commercial_terms_and_conditions' => post('terms_commercial') ? post('terms_commercial') : '',
                    'hide_item_price' => post('hide_item_price') ? post('hide_item_price') : 0,
                    'hide_item_qty' => post('hide_item_qty') ? post('hide_item_qty') : 0,
                    'hide_item_tax' => post('hide_item_tax') ? post('hide_item_tax') : 0,
                    'hide_item_discount' => post('hide_item_discount') ? post('hide_item_discount') : 0,
                    'hide_item_total' => post('hide_item_total') ? post('hide_item_total') : 0,
                    'hide_from_email' => post('hide_from_email') ? post('hide_from_email') : 0,
                    'hide_item_subtotal' => post('show_item_type_subtotal') ? post('show_item_type_subtotal') : 0,
                    'hide_business_phone' => post('from_phone_show') ? post('from_phone_show') : 0,
                    'hide_office_phone' => post('from_office_phone_show') ? post('from_office_phone_show') : 0,
                    'payment_fee_percent' => post('payment_fee_percent'),
                    'payment_fee_amount' => post('payment_fee_amount'),
                    'accept_credit_card' => post('payment_cc') ? post('payment_cc') : 0,
                    'accept_check' => post('payment_check') ? post('payment_check') : 0,
                    'accept_cash' => post('payment_cash') ? post('payment_cash') : 0,
                    'accept_direct_deposit' => post('payment_deposit') ? post('payment_deposit') : 0,
                    'accept_credit' => 0,
                    'mobile_payment' => post('payment_mobile_status') ? post('payment_mobile_status') : 0,
                ]);
    
                $this->activity_model->add('Updated Invoice Settings ' . $user->id . ' Updated by User:' . logged('name'), logged('id'));
            }

            $msg = '';
        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg,
        ];
        echo json_encode($return);
    }

    public function ajax_send_invoice_email()
    {
        $this->load->model('AcsProfile_model');

        $is_success = 1;
        $msg = '';

        $post     = $this->input->post();
        $invoice  = get_invoice_by_id($post['invoice_id']);
        $customer = $this->AcsProfile_model->getByProfId($invoice->customer_id);
        if( !$customer ){
            $msg = 'Cannot find customer data';
            $is_success = 0;

        }

        if( !$invoice ){
            $msg = 'Cannot find invoice data';
            $is_success = 0;
        }
        
        if( $is_success == 1 ){
            $mail = email__getInstance();
            $mail->FromName = 'NsmarTrac';
            $customerName = $customer->first_name . ' ' . $customer->last_name;
            $mail->addAddress($customer->email, $customerName);
            //$mail->addAddress('bryann.revina03@gmail.com', $customerName);
            $mail->isHTML(true);
            $mail->Subject = "nSmartrac: {$invoice->invoice_number} Invoice";
            $mail->Body = $this->generateInvoiceHTML($invoice->id);

            if(!$mail->Send()) {
                $is_success = 0;
                $msg = 'Cannot send email';
            }

            customerAuditLog(logged('id'), $invoice->customer_id, $invoice->id, 'Invoice', 'Sent invoice '.$invoice->invoice_number.' to customer');
        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg,
        ];

        echo json_encode($return);    
    }

    public function ajax_delete_invoice()
    {
        $is_success = 0;
        $msg = 'Cannot find invoice data';

        $post    = $this->input->post();
        $invoice = $this->invoice_model->getinvoice($post['invoice_id']);
        if($invoice){
            $data = array(
                'id' => $post['invoice_id'],
                'view_flag' => '1',
            );

            $is_success = $this->invoice_model->deleteInvoice($data);
            customerAuditLog(logged('id'), $invoice->customer_id, $invoice->id, 'Invoice', 'Deleted invoice '.$invoice->invoice_number);

            $is_success = 1;
            $msg = '';
        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg,
        ];

        echo json_encode($return);    
    }

    public function ajax_mark_as_due()
    {
        $is_success = 0;
        $msg = 'Cannot find invoice data';

        $post    = $this->input->post();
        $invoice = $this->invoice_model->getinvoice($post['invoice_id']);
        if( $invoice ){
            $this->invoice_model->markAsSent($post['invoice_id'], logged('company_id'));

            customerAuditLog(logged('id'), $invoice->customer_id, $invoice->id, 'Invoice', 'Updated invoice '.$invoice->invoice_number.' changed status to Due');
            $this->activity_model->add("invoice #". $post['invoice_id'] ." Mark As Due by User:" . logged('name'));

            $is_success = 1;
            $msg = '';
        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg,
        ];

        echo json_encode($return);    
    }

    public function ajax_clone_invoice()
    {
        $this->load->model('Invoice_settings_model');
        $this->load->model('Invoice_items_model');

        $is_success = 0;
        $invoice_id = 0;
        $msg = 'Cannot find invoice data';

        $post    = $this->input->post();
        $company_id = logged('company_id');
        $invoice    = $this->invoice_model->getinvoice($post['invoice_id']);
        if( $invoice ){
            $invoice->status = 'Draft'; 
            $invoice_id = $this->invoice_model->cloneData($invoice);               

            //Generate new invoice number
            $invoiceSettings =  $this->Invoice_settings_model->getByCompanyId($company_id);
            if( $invoiceSettings ){            
                $next_number = (int) $invoiceSettings->invoice_num_next;     
                $prefix      = $invoiceSettings->invoice_num_prefix;        
            }else{
                $lastInsert = $this->Invoice_model->getLastInsertByCompanyId($company_id);
                $prefix     = 'INV-';
                if( $lastInsert ){
                    $next_number   = $lastInsert->id + 1;
                }else{
                    $next_number   = 1;
                }
            }
    
            $invoiceNumber = formatInvoiceNumberV2($prefix, $next_number);
            $this->invoice_model->update($invoice_id,['invoice_number' => $invoiceNumber]);

            //Copy invoice items
            $invoiceItems = $this->Invoice_items_model->getAllByInvoiceId($post['invoice_id']);
            if( $invoiceItems ){
                foreach($invoiceItems as $item){
                    $item->invoice_id = $invoice_id;
                    $this->Invoice_items_model->cloneData($item);
                }
            }

            //Update invoice settings
            if( $invoiceSettings ){
                $invoice_settings_data = ['invoice_num_next' => $next_number + 1];
                $this->Invoice_settings_model->update($invoiceSettings->id, $invoice_settings_data);
            }else{
                $invoice_settings_data = [
                    'invoice_num_prefix' => $prefix,
                    'invoice_num_next' => $next_number,
                    'check_payable_to' => '',
                    'accept_credit_card' => 1,
                    'accept_check' => 0,
                    'accept_cash'  => 1,
                    'accept_direct_deposit' => 0,
                    'accept_credit' => 0,
                    'mobile_payment' => 1,
                    'capture_customer_signature' => 1,
                    'hide_item_price' => 0,
                    'hide_item_qty' => 0,
                    'hide_item_tax' => 0,
                    'hide_item_discount' => 0,
                    'hide_item_total' => 0,
                    'hide_from_email' => 0,
                    'hide_item_subtotal' => 0,
                    'hide_business_phone' => 0,
                    'hide_office_phone' => 0,
                    'accept_tip' => 0,
                    'due_terms' => '',
                    'auto_convert_completed_work_order' => 0,
                    'message' => 'Thank you for your business.',
                    'terms_and_conditions' => 'Thank you for your business.',
                    'company_id' => $company_id,
                    'commercial_message' => 'Thank you for your business.',
                    'commercial_terms_and_conditions' => 'Thank you for your business.',
                    'logo' => '',
                    'payment_fee_percent' => '',
                    'payment_fee_amount' => '',
                    'recurring' => ''
                ];

                $this->Invoice_settings_model->create($invoice_settings_data);
            }

            $newInvoice    = $this->invoice_model->getinvoice($invoice_id);
            customerAuditLog(logged('id'), $invoice->customer_id, $post['invoice_id'], 'Invoice', 'Cloned invoice. New invoice number '.$newInvoice->invoice_number);
            customerAuditLog(logged('id'), $newInvoice->customer_id, $newInvoice->id, 'Invoice', 'Created invoice #'.$newInvoice->invoice_number);

            $is_success = 1;
            $msg = '';
        }

        $return = [
            'is_success' => $is_success,
            'invoice_id' => $invoice_id,
            'msg' => $msg,
        ];

        echo json_encode($return);    
    }

    public function ajax_schedule_email_notification()
    {
        $this->load->model('AcsProfile_model');
        $this->load->model('InvoiceScheduledEmailNotification_model');
        $this->load->model('Users_model');

        $is_success = 0;
        $invoice_id = 0;
        $msg = 'Cannot find invoice data';

        $post       = $this->input->post();
        $company_id = logged('company_id');
        $invoice    = $this->invoice_model->getinvoice($post['invoice_id']);
        if( $invoice ){
            $customer = $this->AcsProfile_model->getByProfId($invoice->customer_id);
            if( $customer && $customer->email != '' ){
                $bccUsers = $this->Users_model->getCompanyUsers($company_id, $post['bcc']); 

                $bcc_emails = array();
                $bcc = '';
                if( $bccUsers ){
                    foreach($bccUsers as $user){
                        $bcc_emails[] = $user->email;
                    }

                    if( !empty($bcc_emails) ){
                        $bcc = implode("," , $bcc_emails);
                    }
                }

                $subject = 'Invoice Reminder : ' . $invoice->invoice_number; 
                $data = [
                    'company_id' => $company_id,
                    'invoice_id' => $invoice->id,
                    'to_email' => $customer->email,
                    'bcc_email' => $bcc,
                    'from_email' => 'NsmarTrac',
                    'subject_email' => $subject,
                    'message_email' => $post['email_body'],
                    'send_date' => date("Y-m-d",strtotime($post['email_scheduled_date'])),
                    'is_sent' => 0,
                    'is_with_error' => 0,
                    'err_message' => '',
                    'created'  => date("Y-m-d H:i:s")
                ];

                $this->InvoiceScheduledEmailNotification_model->create($data);

                customerAuditLog(logged('id'), $invoice->customer_id, $invoice->id, 'Invoice', 'Send email reminder on '.$post['email_scheduled_date'].' for invoice number '.$newInvoice->invoice_number);
                
                $invoice_id = $invoice->id;
                $is_success = 1;
                $msg = '';

            }else{
                $msg = 'Cannot find customer email';
            }            
        }

        $return = [
            'is_success' => $is_success,
            'invoice_id' => $invoice_id,
            'msg' => $msg,
        ];

        echo json_encode($return);    
    }

    public function ajax_load_record_payment_form()
    {
        $post = $this->input->post();
        $invoice = get_invoice_by_id($post['invoice_id']);
        $payments = $this->payment_records_model->getAllByInvoiceId($invoice->id);

        $balance = $invoice->grand_total;
        foreach($payments as $p){
            $balance = $balance - $p->invoice_amount;
        }
        
        $this->page_data['invoice'] = $invoice;
        $this->page_data['balance'] = $balance;
        $this->load->view('v2/pages/invoice/record_payment_form', $this->page_data);
    }

    public function ajax_create_payment()
    {
        $is_success = 0;
        $msg = 'Cannot find invoice';

        $post = $this->input->post();
        $uid  = logged('id');
        $cid  = logged('company_id');

        $invoice = get_invoice_by_id($post['invoice_id']);
        
        if( $invoice ){
            $payments = $this->payment_records_model->getAllByInvoiceId($invoice->id);
            $total_payment = 0;
            if( $payments ){
                foreach( $payments as $p ){
                    $total_payment +=  $p->invoice_amount;
                }   
            }            

            $balance = $invoice->grand_total - $total_payment;                   
            if( round($balance) >= round($post['amount']) ){
                $new_balance = $balance - $post['amount'];
                $invoice_id = $this->payment_records_model->create([
                    'invoice_id' => $invoice->id,
                    'user_id' => $uid,
                    'company_id' => $cid,
                    'customer_id' => $invoice->customer_id,
                    'invoice_amount' => $post['amount'],
                    'invoice_tip' => $post['amount_tip'],
                    'balance' => $new_balance,
                    'payment_date' => date('Y-m-d', strtotime($post['date_payment'])),
                    'payment_method' => $post['payment_method'],
                    'invoice_number' => $invoice->invoice_number,
                    'reference_number' => $post['reference'],
                    'notes' => $post['notes']
                ]);

                //Update invoice status
                if( $new_balance <= $invoice->grand_total ){                    
                    $status = 'Partially Paid';
                    customerAuditLog($uid, $invoice->customer_id, $invoice->id, 'Invoice', 'Fully paid invoice number '.$invoice->invoice_number);
                }elseif( $new_balance == 0 ){
                    $status = 'Paid';
                }

                $invoice_data = [
                    'status' => $status,
                    'balance' => $new_balance
                ];

                $this->invoice_model->update($invoice->id, $invoice_data);
        
                $this->activity_model->add('New Payment Record Invoice ID ' . $invoice_id . ' Created by User:' . logged('name'), logged('id'));
                customerAuditLog($uid, $invoice->customer_id, $invoice->id, 'Invoice', 'Created payment for invoice number '.$invoice->invoice_number.' amounting of $'.$post['amount']);

                $is_success = 1;
                $msg = '';

            }else{
                $msg = 'Amount entered is greater than invoice balance. Current balance is <b>'.$balance.'</b>';
            }
            
        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg,
        ];

        echo json_encode($return);    
    }

    public function ajax_load_pay_now_form()
    {
        include APPPATH . 'libraries/braintree/lib/Braintree.php'; 

        $this->load->model('CompanyOnlinePaymentAccount_model');
        $this->load->model('Business_model');
        $this->config->load('api_credentials');

        $post = $this->input->post();
        $cid  = logged('company_id');   

        $invoice = get_invoice_by_id($post['invoice_id']);
        $items   = $this->invoice_model->getItemsInv($invoice->id);

        $companyOnlinePaymentAccount = $this->CompanyOnlinePaymentAccount_model->getByCompanyId($cid);
        $braintree_token = '';
        if( $companyOnlinePaymentAccount && ($companyOnlinePaymentAccount->braintree_merchant_id != '' && $companyOnlinePaymentAccount->braintree_public_key != '' && $companyOnlinePaymentAccount->braintree_private_key != '') ){
            $gateway = new Braintree\Gateway([
                'environment' => BRAINTREE_ENVIRONMENT,
                'merchantId' => $companyOnlinePaymentAccount->braintree_merchant_id,
                'publicKey' => $companyOnlinePaymentAccount->braintree_public_key,
                'privateKey' => $companyOnlinePaymentAccount->braintree_private_key
            ]);

            try {
                $braintree_token = $gateway->ClientToken()->generate();	
            } catch (Exception $e) {
                $braintree_token = '';
            }
        }        

        $company = $this->Business_model->getByCompanyId($cid);

        $this->page_data['invoice'] = $invoice;
        $this->page_data['items']   = $items;
        $this->page_data['onlinePaymentAccount'] = $companyOnlinePaymentAccount;
        $this->page_data['braintree_token'] = $braintree_token;
        $this->page_data['square_client_id'] = $this->config->item('square_client_id');
        $this->page_data['company_info'] = $company;
        $this->load->view('v2/pages/invoice/ajax_load_pay_now_form', $this->page_data);
    }

    public function ajax_update_payment_status()
    {
        $is_success = 0;
        $invoice_id = 0;
        $msg = 'Cannot find invoice data';

        $post = $this->input->post();
        $uid  = logged('id');
        $cid  = logged('company_id');

        $invoice = get_invoice_by_id($post['invoice_id']);
        if( $invoice ){
            $data = [
                'status' => 'Paid',
                'online_payments' => $post['payment_method'],
                'payment_methods' => $post['payment_method'],

            ];

            $this->invoice_model->update($invoice->id, $data);
            customerAuditLog($uid, $invoice->customer_id, $invoice->id, 'Invoice', 'Mark as paid invoice number '.$invoice->invoice_number);

            $this->payment_records_model->create([
                'invoice_id' => $invoice->id,
                'user_id' => $uid,
                'company_id' => $cid,
                'customer_id' => $invoice->customer_id,
                'invoice_amount' => $invoice->grand_total,
                'invoice_tip' => 0,
                'balance' => 0,
                'payment_date' => date('Y-m-d'),
                'payment_method' => $post['payment_method'],
                'invoice_number' => $invoice->invoice_number,
                'reference_number' => '',
                'notes' => 'Online Payment - ' . ucwords($post['payment_method'])
            ]);

            $this->activity_model->add('New Payment Record Invoice ID ' . $invoice->id . ' Created by User:' . logged('name'), $uid);
            customerAuditLog($uid, $invoice->customer_id, $invoice->id, 'Invoice', 'Created payment for invoice number '.$invoice->invoice_number.' amounting of $'.$invoice->grand_total);
            customerAuditLog($uid, $invoice->customer_id, $invoice->id, 'Invoice', 'Fully paid invoice number '.$invoice->invoice_number);

            $invoice_id = $invoice->id;
            $is_success = 1;
            $msg = '';
        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg,
        ];

        echo json_encode($return);    
    }

    public function ajax_process_braintree_payment()
	{
		include APPPATH . 'libraries/braintree/lib/Braintree.php'; 
        $this->load->model('CompanyOnlinePaymentAccount_model');

		$is_success = 0;
		$msg  = '';

		$post = $this->input->post();
        $cid  = logged('company_id');
        $invoice = get_invoice_by_id($post['invoice_id']);
        if( $invoice ){
        	$companyOnlinePaymentAccount = $this->CompanyOnlinePaymentAccount_model->getByCompanyId($cid);
	        if( $companyOnlinePaymentAccount ){
	    		$total_amount = $invoice->grand_total;

	            $gateway = new Braintree\Gateway([
	                'environment' => BRAINTREE_ENVIRONMENT,
	                'merchantId' => $companyOnlinePaymentAccount->braintree_merchant_id,
	                'publicKey' => $companyOnlinePaymentAccount->braintree_public_key,
	                'privateKey' => $companyOnlinePaymentAccount->braintree_private_key
	            ]);
	            $result = $gateway->transaction()->sale([
	                'amount' => floatval($total_amount),
	                'paymentMethodNonce' => $post['nonce'],
	                'options' => [
	                    'submitForSettlement' => true
	                ]
	            ]);

	            if($result->success || !is_null($result->transaction)) {
	                $is_success = 1;
	            }else{
	                $errorString = "";
	                foreach($result->errors->deepAll() as $error) {
	                    $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
	                }
	                $msg = $errorString;                
	            }
	        }else{
	        	$msg = 'Cannot process payment using braintree.';
	        }	
        }   
        

		$data = ['msg' => $msg, 'is_success' => $is_success];
		echo json_encode($data);
	}

    public function ajax_square_process_payment()
	{
		$this->load->helper('square_helper');
		$this->load->model('CompanyOnlinePaymentAccount_model');
		$this->load->model('CompanySquarePaymentLogs_model');

		$is_success = 0;
		$msg  = 'Cannot find invoice data';

		$post = json_decode(file_get_contents('php://input'), true);
        $cid  = logged('company_id');

        $invoice = get_invoice_by_id($post['invoice_id']);

		if( $invoice ){
			$companyOnlinePaymentAccount = $this->CompanyOnlinePaymentAccount_model->getByCompanyId($cid);
			if( $post['token'] != '' ){
	    		$total_amount = $invoice->grand_total;

				$idempotency_key = uniqid() . $invoice->id;
				$squarePayment = createPayment($companyOnlinePaymentAccount->square_access_token, $post['token'], $idempotency_key, $companyOnlinePaymentAccount->square_location_id, $total_amount);
				if( isset($squarePayment) && $squarePayment->payment ){
					$payment_data = [
						'company_id' => $cid,
						'access_token' => $companyOnlinePaymentAccount->square_access_token,
						'object_id' => $invoice->id,
						'object_type' => 'invoice',
						'amount' => $total_amount,
						'square_payment_id' => $squarePayment->payment->id,
						'source_type' => $squarePayment->payment->source_type,
						'status' => $squarePayment->payment->status,
						'source_id' => $post['token'],
						'location_id' => $companyOnlinePaymentAccount->square_location_id,
						'receipt_url' => $squarePayment->payment->receipt_url,
						'payment_date' => date('Y-m-d H:i:s')

					];

					$this->CompanySquarePaymentLogs_model->create($payment_data);

					$is_success = 1;
					$msg  = '';

				}
			}else{
				$msg = 'Cannot process payment.';
			}
		}

		$data = ['msg' => $msg, 'is_success' => $is_success];
		echo json_encode($data);
	}

    public function ajax_process_cash_payment()
    {
        $is_success = 0;
		$msg  = 'Cannot find invoice data';

        $post = $this->input->post();
        $cid  = logged('company_id');
        $uid  = logged('id');

        $invoice = get_invoice_by_id($post['invoice_id']);
        if( $invoice ){
            $this->payment_records_model->create([
                'invoice_id' => $invoice->id,
                'user_id' => $uid,
                'company_id' => $cid,
                'customer_id' => $invoice->customer_id,
                'invoice_amount' => $invoice->grand_total,
                'invoice_tip' => 0,
                'balance' => 0,
                'payment_date' => date("Y-m-d", strtotime($post['date_payment'])),
                'payment_method' => 'cash',
                'invoice_number' => $invoice->invoice_number,
                'reference_number' => $post['reference'],
                'notes' => $post['notes']
            ]);

            $is_success = 1;
			$msg  = '';
        }

        $data = ['msg' => $msg, 'is_success' => $is_success];
		echo json_encode($data);
    }

    public function ajax_create_invoice()
    {
        $this->load->model('JobTags_model');
        $this->load->model('Invoice_settings_model');
        $this->load->model('AcsProfile_model');  
        $this->load->model('Items_model');      

        $is_success = 1;
		$msg  = 'Cannot find invoice data';
        
        $post = $this->input->post();
        $cid  = logged('company_id');
        $uid  = logged('id');

        if( $post['grand_total'] <= 0 ){
            $is_success = 0;
            $msg = 'Cannot save 0 amount invoice';
        }

        if( $post['status'] == 'Partially Paid' && $post['amount_paid'] <= 0 ){
            $is_success = 0;
            $msg = 'Please specify amount paid';
        }

        if( $post['adjustment_value'] > 0 && $post['adjustment_name'] == '' ){
            $is_success = 0;
            $msg = 'Please specify adjustment name';
        }

        if( $post['customer_id'] <= 0 ){
            $is_success = 0;
            $msg = 'Please select customer';
        }
  
        if( $is_success == 1 ){
            $invoiceSettings =  $this->Invoice_settings_model->getByCompanyId($cid);
            if( $invoiceSettings ){            
                $next_number = (int) $invoiceSettings->invoice_num_next;     
                $prefix      = $invoiceSettings->invoice_num_prefix;        
            }else{
                $lastInsert = $this->Invoice_model->getLastInsertByCompanyId($cid);
                $prefix     = 'INV-';
                if( $lastInsert ){
                    $next_number   = $lastInsert->id + 1;
                }else{
                    $next_number   = 1;
                }
            }

            $invoiceNumber = formatInvoiceNumberV2($prefix, $next_number);
            $customer = $this->AcsProfile_model->getByProfId($post['customer_id']); 
            $jobTag   = $this->JobTags_model->getById($post['job_tag']);

            if( $post['status'] == 'Paid' ){
                $balance = 0;
            }elseif( $post['status'] == 'Partially Paid' ){
                $balance = $post['grand_total'] - $post['amount'];
            }else{
                $balance = $post['grand_total'];
            }

            //Attachment
            $attachmentFolderPath = "./uploads/invoice/attachments/".$cid."/";            
            if(!file_exists($attachmentFolderPath)) {
                mkdir($attachmentFolderPath, 0777, true);
            }

            if(isset($_FILES['attachment_file']) && $_FILES['attachment_file']['tmp_name'] != '') {
                $tmp_name  = $_FILES['attachment_file']['tmp_name'];
                $extension = strtolower(end(explode('.',$_FILES['attachment_file']['name'])));
                $attachment_file = $invoiceNumber."_attachment_".basename($_FILES["attachment_file"]["name"]);
                move_uploaded_file($tmp_name, $attachmentFolderPath.$attachment_file);
            }

            $new_data = array(
                'customer_id'               => $post['customer_id'],
                'job_location'              => $post['jobs_location'],
                'job_name'                  => $post['job_name'],
                'job_id'                    => 0,
                'job_number'                => '',
                'business_name'             => $post['business_name'],
                'tags'                      => $jobTag->name,
                'invoice_type'              => '',
                'work_order_number'         => '',
                'purchase_order'            => $post['purchase_order'],
                'invoice_number'            => $invoiceNumber,
                'date_issued'               => date("Y-m-d",strtotime($post['date_issued'])),
                'due_date'                  => date("Y-m-d",strtotime($post['due_date'])),
                'customer_email'            => $customer->email,
                'online_payments'           => '',
                'billing_address'           => $customer->mail_add,
                'shipping_to_address'       => $customer->mail_add,
                'ship_via'                  => '',
                'shipping_date'             => '',
                'tracking_number'           => '',
                'terms'                     => 0,     
                'tip'                       => 0,     
                'location_scale'            => '',
                'message_to_customer'       => '',
                'terms_and_conditions'      => $post['terms_and_conditions'],            
                'attachments'               => $attachment_file,
                'status'                    => $post['status'],
                'company_id'                => $cid,
                'deposit_request_type'      => '',
                'deposit_request'           => '',
                'monthly_monitoring'        => $post['adjustment_otps'],
                'program_setup'             => $post['monthly_monitoring'],
                'installation_cost'         => $post['adjustment_ic'],
                'payment_methods'           => '',
                'sub_total'                 => $post['subtotal'],
                'balance'                   => $balance,
                'taxes'                     => $post['taxes'],
                'no_tax'                    => $post['is_tax_exempted'],
                'adjustment_name'           => $post['adjustment_name'],
                'adjustment_value'          => $post['adjustment_value'] > 0 ? $post['adjustment_value'] : 0,
                'grand_total'               => $post['grand_total'],
                'total_due'                 => $post['grand_total'],    
                'user_id'                   => $uid,
                'date_created'              => date("Y-m-d H:i:s"),
                'date_updated'              => date("Y-m-d H:i:s")
            );
    
            $invoice_id = $this->invoice_model->createInvoice($new_data);

            //Create invoice payment record if partially paid
            if( $post['status'] == 'Partially Paid' || $post['status'] == 'Paid' ){
                $this->payment_records_model->create([
                    'invoice_id' => $invoice_id,
                    'user_id' => $uid,
                    'company_id' => $cid,
                    'customer_id' => $customer->prof_id,
                    'invoice_amount' => $post['grand_total'],
                    'invoice_tip' => 0,
                    'balance' => $balance,
                    'payment_date' => date('Y-m-d', strtotime($post['payment_date'])),
                    'payment_method' => $post['payment_method'],
                    'invoice_number' => $invoiceNumber,
                    'reference_number' => $post['reference_number'],
                    'notes' => ''
                ]);

                customerAuditLog($uid, $customer->prof_id, $invoice_id, 'Invoice', 'Created payment for invoice number '.$invoiceNumber.' amounting of $'.$post['amount']);
                $this->activity_model->add('New Payment Record Invoice ID ' . $invoice_id . ' Created by User:' . logged('name'), $uid);
            }            

            //Update invoice settings
            if( $invoiceSettings ){
                $invoice_settings_data = ['invoice_num_next' => $next_number + 1];
                $this->Invoice_settings_model->update($invoiceSettings->id, $invoice_settings_data);
            }else{
                $invoice_settings_data = [
                    'invoice_num_prefix' => $prefix,
                    'invoice_num_next' => $next_number,
                    'check_payable_to' => '',
                    'accept_credit_card' => 1,
                    'accept_check' => 0,
                    'accept_cash'  => 1,
                    'accept_direct_deposit' => 0,
                    'accept_credit' => 0,
                    'mobile_payment' => 1,
                    'capture_customer_signature' => 1,
                    'hide_item_price' => 0,
                    'hide_item_qty' => 0,
                    'hide_item_tax' => 0,
                    'hide_item_discount' => 0,
                    'hide_item_total' => 0,
                    'hide_from_email' => 0,
                    'hide_item_subtotal' => 0,
                    'hide_business_phone' => 0,
                    'hide_office_phone' => 0,
                    'accept_tip' => 0,
                    'due_terms' => '',
                    'auto_convert_completed_work_order' => 0,
                    'message' => 'Thank you for your business.',
                    'terms_and_conditions' => 'Thank you for your business.',
                    'company_id' => $company_id,
                    'commercial_message' => 'Thank you for your business.',
                    'commercial_terms_and_conditions' => 'Thank you for your business.',
                    'logo' => '',
                    'payment_fee_percent' => '',
                    'payment_fee_amount' => '',
                    'recurring' => ''
                ];

                $this->Invoice_settings_model->create($invoice_settings_data);
            }

            //Invoice Products
            if( $post['productIds'] && count($post['productIds']) > 0 ){
                foreach( $post['productIds'] as $key => $pid ){
                    $item = $this->Items_model->getByID($pid);
                    $storage_id = $post['storageLocIds'][$key];
                    $invoice_item_data = [
                        'invoice_id' => $invoice_id,
                        'location_id' => $storage_id,
                        'location_id' => $storage_id,
                        'item_type' => 'Product',
                        'item_name' => $item->title,
                        'items_id' => $pid,
                        'qty' => $post['productQty'][$key],
                        'cost' => $post['productPrice'][$key],
                        'tax' => $post['productTax'][$key],
                        'discount' => $post['productDiscount'][$key],
                        'total' => $post['productTotal'][$key]
                    ];
    
                    $this->invoice_model->add_invoice_details($invoice_item_data);                    

                    //Get Product item storage and deduct quantity                    
                    $storageLocation = $this->Items_model->getItemLocation($storage_id, $pid);
                    if( $storageLocation ){
                        //Update qty
                        if( $storageLocation->qty >= $post['productQty'][$key] ){
                            $new_qty = $storageLocation->qty - $post['productQty'][$key];
                        }else{
                            $new_qty = 0;
                        }

                        $this->Items_model->updateLocationQty($storage_id, $pid, $new_qty);
                    }
                }
            }

            //Invoice Services
            if( $post['serviceIds'] && count($post['serviceIds']) > 0 ){
                foreach( $post['serviceIds'] as $key => $sid ){
                    $item = $this->Items_model->getByID($pid);
                    $invoice_item_data = [
                        'invoice_id' => $invoice_id,
                        'storage_loc_id' => 0,
                        'location_id' => 0,
                        'item_type' => 'Service',
                        'item_name' => $item->title,
                        'items_id' => $sid,
                        'qty' => $post['serviceQty'][$key],                        
                        'cost' => $post['servicePrice'][$key],
                        'tax' => $post['serviceTax'][$key],
                        'discount' => $post['serviceDiscount'][$key],
                        'total' => $post['serviceTotal'][$key]
                    ];
    
                    $this->invoice_model->add_invoice_details($invoice_item_data);
                }
            }

            $this->activity_model->add('Created Invoice ID ' . $invoice_id . ' Created by User:' . logged('name'), $uid);

            $is_success = 1;
            $msg = '';
        }

        $data = ['msg' => $msg, 'is_success' => $is_success];
		echo json_encode($data);
    }

}

/* End of file Invoice.php */
/* Location: ./application/controllers/Invoice.php */
