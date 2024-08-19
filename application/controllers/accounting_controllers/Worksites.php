<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Worksites extends MY_Controller {
	
	public function __construct()
    {
		parent::__construct();
        $this->checkLogin();
        $this->load->model('vendors_model');
        $this->load->model('account_model');
        $this->load->model('expenses_model');        
        $this->load->model('accounting_account_transactions_model');
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

        $this->load->model('accounting_worksites_model');

        $this->page_data['page']->title = 'Worksites';
        $this->page_data['page']->parent = 'Payroll';

        add_css(array(
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
                array("Cash Flow", array()),
                array("Expenses", array('Expenses', 'Vendors')),
                array("Sales", array('Overview', 'All Sales', 'Estimates', 'Customers', 'Deposits', 'Work Order', 'Invoice', 'Jobs', 'Products and services')),
                array("Payroll", array('Overview', 'Employees', 'Contractors', "Workers' Comp", 'Benifits')),
                array("Reports", array()),
                array("Taxes", array("Sales Tax", "Payroll Tax")),
                array("Accounting", array("Chart of Accounts", "Reconcile"))
            );
        $this->page_data['menu_link'] =
            array(
                array('/accounting/cashflowplanner', array()),
                array("", array('/accounting/expenses', '/accounting/vendors')),
                array("", array('/accounting/sales-overview', '/accounting/all-sales', '/accounting/newEstimateList', '/accounting/customers', '/accounting/deposits', '/accounting/listworkOrder', '/accounting/invoices', '/accounting/jobs', '/accounting/products-and-services')),
                array("", array('/accounting/payroll-overview', '/accounting/employees', '/accounting/contractors', '/accounting/workers-comp', '#')),
                array('/accounting/reports', array()),
                array("", array('/accounting/salesTax', '/accounting/payrollTax')),
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
            "assets/js/v2/accounting/payroll/contractors/list.js"
        ));

        switch(get('status')) {
            case 'inactive' :
                $status = [
                    0
                ];
            break;
            case 'all' :
                $status = [
                    0,
                    1
                ];
            break;
            default :
                $status = [
                    1
                ];
            break;
        }

        $this->page_data['status'] = get('status');

        $worksites = $this->accounting_worksites_model->get_company_worksites(logged('company_id'));

        if(!empty(get('search'))) {
            $search = get('search');
            $worksites = array_filter($worksites, function($worksite, $key) use ($search) {
                return stripos($worksite->name, $search) !== false;
            }, ARRAY_FILTER_USE_BOTH);

            $this->page_data['search'] = $search;
        }

        $this->page_data['worksites'] = $worksites;
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['page_title'] = "Worksites";
        $this->load->view('v2/pages/accounting/worksites/list', $this->page_data);
    }

    public function add()
    {
        $post                    = $this->input->post();

        $post_data['company_id'] = logged('company_id');
        $post_data['name']       = $post['name'];
        $post_data['street']     = $post['street'];
        $post_data['city']       = $post['city'];
        $post_data['state']      = $post['state'];
        $post_data['zip_code']   = $post['zip_code'];

        $add_id = $this->accounting_worksites_model->create($post_data);
        if($add_id) {
            $this->session->set_flashdata('success', "Worksite location added successfully!");
        } else {
            $this->session->set_flashdata('error', "Please try again!");
        }

        redirect($_SERVER['HTTP_REFERER']);
    }

    public function get_details($vendorId)
    {
        $worksite = $this->accounting_worksites_model->get_worksite_by_id($vendorId);
        echo json_encode($worksite);
    }    



    public function update_details($worksiteId)
    {
        $post = $this->input->post();

        $post_data['company_id'] = logged('company_id');
        $post_data['name']       = $post['name'];
        $post_data['street']     = $post['street'];
        $post_data['city']       = $post['city'];
        $post_data['state']      = $post['state'];
        $post_data['zip_code']   = $post['zip_code'];

        $update = $this->accounting_worksites_model->update($worksiteId, $post_data);

        if($update) {
            $this->session->set_flashdata('success', "Worksite details updated successfully!");
        } else {
            $this->session->set_flashdata('error', "Unexpected error, please try again!");
        }

        redirect($_SERVER['HTTP_REFERER']);
    }

    public function delete($worksiteId)
    {
        $total_deleted = 0;
        
        $data = [];

        $delete_id = $this->accounting_worksites_model->delete($worksiteId);

        if($delete_id) {
            $this->session->set_flashdata('success', "Worksite deleted successfully!");
        } else {
            $this->session->set_flashdata('error', "Please try again!");
        }

        redirect($_SERVER['HTTP_REFERER']);
    }
}