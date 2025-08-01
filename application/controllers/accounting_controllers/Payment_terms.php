<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment_terms extends MY_Controller {
	
	public function __construct()
    {
		parent::__construct();
        $this->checkLogin();
        $this->load->model('accounting_terms_model');
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

        $this->page_data['page']->title = 'Terms';

        add_css(array(
            // "assets/css/accounting/banking.css?v='rand()'",
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
            "assets/js/accounting/accounting.js",
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
        add_footer_js(array(
            "assets/js/v2/printThis.js",
            "assets/js/v2/accounting/lists/payment_terms/list.js"
            // "assets/js/accounting/terms.js"
        ));

        $status = [
            1,0
        ];

        if (!empty(get('inactive') && get('inactive') === '1') ) {
            array_push($status, 0);
            $this->page_data['inactive'] = true;
        }

        $terms = $this->accounting_terms_model->getCompanyTerms('asc', $status);

        if(!empty(get('search'))) {
            $search = get('search');
            $terms = array_filter($terms, function($term, $key) use ($search) {
                return (stripos($term['name'], $search) !== false);
            }, ARRAY_FILTER_USE_BOTH);

            $this->page_data['search'] = $search;
        }
        
        $this->page_data['terms'] = $terms;
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['page']->title = 'Payment Terms';
        $this->load->view('v2/pages/accounting/lists/payment_terms/list', $this->page_data);
    }

    public function add()
    {
        $company_id = logged('company_id');
        $data = [
            'company_id' => $company_id,
            'name' => $this->input->post('name'),
            'type' => $this->input->post('payment_term_type'),
            'net_due_days' => $this->input->post('payment_term_type') === "1" ? $this->input->post('net_due_days') === "" ? 0 : $this->input->post('net_due_days') : null,
            'day_of_month_due' => $this->input->post('payment_term_type') === "2" ? $this->input->post('day_of_month_due') === "" ? 0 : $this->input->post('day_of_month_due') : null,
            'minimum_days_to_pay' => $this->input->post('payment_term_type') === "2" ? $this->input->post('minimum_days_to_pay') === "" ? 0 : $this->input->post('minimum_days_to_pay') : null,
            'discount_days' => 0,
            'status' => 1,
            'created_at' => date('Y-m-d h:i:s'),
            'updated_at' => date('Y-m-d h:i:s')
        ];

        $term = $this->accounting_terms_model->create($data);
        $name = $data['name'];

        if($term) {
            $this->session->set_flashdata('success', "$name added successfully!");
        } else {
            $this->session->set_flashdata('error', "Please try again!");
        }

        redirect('/accounting/terms');
    }

    public function ajax_save_payment_terms()
    {
        $is_success = 1;
        $msg = 'Cannot find data';
        $payment_term_name = '';
        $payment_term_id   = '';

        $data = [
            'company_id' => getLoggedCompanyID(),
            'name' => $this->input->post('name'),
            'type' => $this->input->post('payment_term_type'),
            'net_due_days' => $this->input->post('payment_term_type') === "1" ? $this->input->post('net_due_days') === "" ? 0 : $this->input->post('net_due_days') : null,
            'day_of_month_due' => $this->input->post('payment_term_type') === "2" ? $this->input->post('day_of_month_due') === "" ? 0 : $this->input->post('day_of_month_due') : null,
            'minimum_days_to_pay' => $this->input->post('payment_term_type') === "2" ? $this->input->post('minimum_days_to_pay') === "" ? 0 : $this->input->post('minimum_days_to_pay') : null,
            'discount_days' => 0,
            'status' => 1,
            'created_at' => date('Y-m-d h:i:s'),
            'updated_at' => date('Y-m-d h:i:s')
        ];

        $payment_term_id   = $this->accounting_terms_model->create($data);
        $payment_term_name = $data['name'];

        $return = [
            'is_success' => $is_success,
            'msg' => $msg,
            'payment_term_id' => $payment_term_id,
            'payment_term_name' => $payment_term_name
        ];
        echo json_encode($return);
    }   

    public function delete($id)
    {
        $term = $this->accounting_terms_model->get_by_id($id, logged('company_id'));

        $attempt = 0;
        do {
            $name = $attempt > 0 ? "$term->name (deleted-$attempt)" : "$term->name (deleted)";
            $checkName = $this->accounting_terms_model->check_name(logged('company_id'), $name, 0);

            $attempt++;
        } while(!is_null($checkName));

        $delete = $this->accounting_terms_model->inactive($id, $name);
        $name = $term->name;

        if($delete) {
            $this->session->set_flashdata('success', "$name is now inactive!");
        } else {
            $this->session->set_flashdata('error', "Please try again!");
        }
    }

    public function ajax_delete_term(){
        $this->load->model('Accounting_terms_model');

        $is_success = 0;
        $msg = 'Cannot find data';

        $company_id  = logged('company_id');
        $post        = $this->input->post();

        if($post) {
            $term = $this->Accounting_terms_model->get_by_id($post['tid'], $company_id);
            if( $term ){
                $this->Accounting_terms_model->delete($post['tid']);
                $is_success = 1;
                $msg = '';            
            } else {
                $msg = 'Cannot find data';
            } 
        }
     
        $json_data = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($json_data);
    }     

    public function ajax_update_status(){
        $this->load->model('Accounting_terms_model');

        $is_success = 0;
        $msg = 'Cannot find data';

        $company_id  = logged('company_id');
        $post        = $this->input->post();

        if($post) {
            $term = $this->Accounting_terms_model->get_by_id($post['tid'], $company_id);
            if( $term ){
                $update = $this->accounting_terms_model->updateTermStatus($post['tid'], $post['t_status'], $company_id);
                if($update) {
                    $is_success = 1;
                    $msg = '';                            
                }
            } else {
                $msg = 'Cannot find data';
            } 
        }
     
        $json_data = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($json_data);
    }         

    public function ajax_delete_selected_payment_terms() 
    {
        $this->load->model('Accounting_terms_model');

        $is_success = 0;
        $msg    = 'Please select data';  

        $company_id  = logged('company_id');
        $post        = $this->input->post();     
        
        if( $post['terms'] ){
            $delete_count = 0;
            foreach($post['terms'] as $term_id) {
                $term = $this->Accounting_terms_model->get_by_id($term_id, $company_id);
                if( $term ){
                    $this->Accounting_terms_model->delete($term_id);
                    $delete_count++;
                }                
            }

            if($delete_count) {
                $is_success = 1;
                $msg    = '';
            }            
        }
        
        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);        
    }    

    public function activate($id)
    {
        $term = $this->accounting_terms_model->get_by_id($id, logged('company_id'));

        $explode = explode(' ', $term->name);
        array_pop($explode);
        $newName = implode(' ', $explode);

        $attempt = 0;
        do {
            $name = $attempt > 0 ? "$newName - $attempt" : $newName;
            $checkName = $this->accounting_terms_model->check_name(logged('company_id'), $name, 1);

            $attempt++;
        } while(!is_null($checkName));

        $activate = $this->accounting_terms_model->activate($id, $name);
        $name = $term->name;

        if($activate) {
            $this->session->set_flashdata('success', "$name is now active!");
        } else {
            $this->session->set_flashdata('error', "Please try again!");
        }
    }

    public function edit($id)
    {
        $this->page_data['term'] = $this->accounting_terms_model->get_by_id($id, logged('company_id'));

        $this->load->view('v2/includes/accounting/modal_forms/term_modal', $this->page_data);
    }

    public function update($id)
    {
        $data = [
            'name' => $this->input->post('name'),
            'type' => $this->input->post('payment_term_type'),
            'net_due_days' => $this->input->post('payment_term_type') === "1" ? $this->input->post('net_due_days') === "" ? 0 : $this->input->post('net_due_days') : null,
            'day_of_month_due' => $this->input->post('payment_term_type') === "2" ? $this->input->post('day_of_month_due') === "" ? 0 : $this->input->post('day_of_month_due') : null,
            'minimum_days_to_pay' => $this->input->post('payment_term_type') === "2" ? $this->input->post('minimum_days_to_pay') === "" ? 0 : $this->input->post('minimum_days_to_pay') : null,
            'updated_at' => date('Y-m-d h:i:s')
        ];

        $update = $this->accounting_terms_model->updateTerm($id, $data);
        $name = $data['name'];

        if($update) {
            $this->session->set_flashdata('success', "$name updated successfully!");
        } else {
            $this->session->set_flashdata('error', "Please try again!");
        }

        redirect('/accounting/terms');
    }

    public function ajax_add_term()
    {
        $data = [
            'company_id' => getLoggedCompanyID(),
            'name' => $this->input->post('name'),
            'type' => $this->input->post('type'),
            'net_due_days' => $this->input->post('type') === "1" ? $this->input->post('net_due_days') === "" ? 0 : $this->input->post('net_due_days') : null,
            'day_of_month_due' => $this->input->post('type') === "2" ? $this->input->post('day_of_month_due') === "" ? 0 : $this->input->post('day_of_month_due') : null,
            'minimum_days_to_pay' => $this->input->post('type') === "2" ? $this->input->post('minimum_days_to_pay') === "" ? 0 : $this->input->post('minimum_days_to_pay') : null,
            'discount_days' => 0,
            'status' => 1,
            'created_at' => date('Y-m-d h:i:s'),
            'updated_at' => date('Y-m-d h:i:s')
        ];

        $termId = $this->accounting_terms_model->create($data);
        $name = $data['name'];

        $return = [
            'data' => [
                'id' => $termId,
                'name' => $name
            ],
            'success' => $termId ? true : false
        ];

        echo json_encode($return);
    }

    public function print()
    {
        $post = $this->input->post();
        $search = $post['search'];
        $status = [
            1
        ];
        if($post['inactive'] === '1' || $post['inactive'] === 1) {
            array_push($status, 0);
        }

        $terms = $this->accounting_terms_model->getCompanyTerms($post['order'], $status);

        if($search !== "") {
            $terms = array_filter($terms, function($term, $key) use ($search) {
                return stripos($term['name'], $search) !== false;
            }, ARRAY_FILTER_USE_BOTH);
        }

        usort($terms, function($a, $b) use ($post) {
            if($post['order'] === 'asc') {
                return strcasecmp($a['name'], $b['name']);
            } else {
                return strcasecmp($b['name'], $a['name']);
            }
        });

        $tableHtml = "<table width='100%'>";
        $tableHtml .= "<thead>";
        $tableHtml .= "<tr style='text-align: left;'>";
        $tableHtml .= "<th style='border-bottom: 2px solid #BFBFBF'>Name</th>";
        $tableHtml .= "</tr>";
        $tableHtml .= "</thead>";
        $tableHtml .= "<tbody>";
        foreach($terms as $term) {
            $name = $term['status'] === "0" ? $term['name']." (deleted)" : $term['name'];
            $tableHtml .= "<tr>";
            $tableHtml .= "<td style='border-bottom: 1px dotted #D5CDB5'>$name</td>";
            $tableHtml .= "</tr>";
        }

        $tableHtml .= "</tbody>";
        $tableHtml .= "</table>";

        echo $tableHtml;
    }
}