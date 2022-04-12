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

        $this->load->model('AcsProfile_model');
        $this->load->model('invoice_model');
        $this->load->model('workorder_model');
        $this->load->model('estimate_model');
        $this->load->model('accounting_receive_payment_model');
        $this->load->model('accounting_sales_receipt_model');
        $this->load->model('accounting_credit_memo_model');
        $this->load->model('accounting_statements_model');

        add_css(array(
            "assets/css/accounting/banking.css?v='rand()'",
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
        add_footer_js(array(
            "assets/js/accounting/terms.js"
        ));
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->load->view('accounting/terms', $this->page_data);
    }

    public function add()
    {
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

        $term = $this->accounting_terms_model->create($data);
        $name = $data['name'];

        if($term) {
            $this->session->set_flashdata('success', "$name added successfully!");
        } else {
            $this->session->set_flashdata('error', "Please try again!");
        }

        redirect('/accounting/terms');
    }

    public function load_terms()
    {
        $post = json_decode(file_get_contents('php://input'), true);
        $order = $post['order'][0]['dir'];
        $start = $post['start'];
        $limit = $post['length'];

        $status = [
            1
        ];

        if($post['inactive'] === '1' || $post['inactive'] === 1) {
            array_push($status, 0);
        }

        $terms = $this->accounting_terms_model->getCompanyTerms($order, $status);

        $data = [];
        $search = $post['columns'][0]['search']['value'];

        if(count($terms) > 0) {
            foreach($terms as $term) {
                if($search !== "") {
                    if(stripos($term['name'], $search) !== false) {
                        $data[] = [
                            'id' => $term['id'],
                            'name' => $term['name'],
                            'type' => $term['type'],
                            'net_due_days' => $term['net_due_days'],
                            'day_of_month_due' => $term['day_of_month_due'],
                            'minimum_days_to_pay' => $term['minimum_days_to_pay'],
                            'status' => $term['status']
                        ];
                    }
                } else {
                    $data[] = [
                        'id' => $term['id'],
                        'name' => $term['name'],
                        'type' => $term['type'],
                        'net_due_days' => $term['net_due_days'],
                        'day_of_month_due' => $term['day_of_month_due'],
                        'minimum_days_to_pay' => $term['minimum_days_to_pay'],
                        'status' => $term['status']
                    ];
                }
            }
        }

        $result = [
            'draw' => $post['draw'],
            'recordsTotal' => count($terms),
            'recordsFiltered' => count($data),
            'data' => array_slice($data, $start, $limit)
        ];

        echo json_encode($result);
    }

    public function delete($id)
    {
        $result = [];

        $delete = $this->accounting_terms_model->delete($id);
        $name = $this->accounting_terms_model->get_by_id($id, logged('company_id'))->name;

        if($delete) {
            $this->session->set_flashdata('success', "$name is now inactive!");
        } else {
            $this->session->set_flashdata('error', "Please try again!");
        }
    }

    public function activate($id)
    {
        $result = [];

        $activate = $this->accounting_terms_model->activate($id);
        $name = $this->accounting_terms_model->get_by_id($id, logged('company_id'))->name;

        if($activate) {
            $this->session->set_flashdata('success', "$name is now active!");
        } else {
            $this->session->set_flashdata('error', "Please try again!");
        }
    }

    public function edit($id)
    {
        $this->page_data['term'] = $this->accounting_terms_model->get_by_id($id, logged('company_id'));

        $this->load->view('accounting/modals/term_modal', $this->page_data);
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