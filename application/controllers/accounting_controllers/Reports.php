<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends MY_Controller {
	
	public function __construct()
    {
		parent::__construct();
        $this->checkLogin();

        $this->load->model('accounting_favorite_reports_model');
        $this->load->model('accounting_report_groups_model');
        $this->load->model('accounting_report_types_model');

        $this->load->model('accounting_customers_model');
        $this->load->model('vendors_model');
        $this->load->model('timesheet_model');
        $this->load->model('accounting_management_reports');

        $this->load->model('accounting_invoices_model');
        $this->load->model('AcsProfile_model');
        $this->load->model('invoice_model');
        $this->load->model('workorder_model');
        $this->load->model('estimate_model');
        $this->load->model('accounting_receive_payment_model');
        $this->load->model('accounting_sales_receipt_model');
        $this->load->model('accounting_credit_memo_model');
        $this->load->model('accounting_statements_model');
        $this->load->model('items_model');

        $this->load->model('tags_model');

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
        // add_css([
        //     'assets/css/accounting/reports/management_reports.css'
        // ]);

        add_footer_js([
            'assets/js/accounting/reports/index.js'
            // 'assets/js/accounting/reports/management_reports.js'
        ]);

        $reportGroups = $this->accounting_report_groups_model->get_report_groups();

        foreach($reportGroups as $key => $reportGroup) {
            if ($reportGroup->description === 'Favorites') {
                $reportGroups[$key]->report_types = $this->accounting_report_types_model->get_favorite_reports(logged('company_id'));
            } else {
                $reportGroups[$key]->report_types = $this->accounting_report_types_model->get_by_group($reportGroup->id);
            }
        }

        $this->page_data['reportGroups'] = $reportGroups;
        $this->page_data['company_details'] = $this->timesheet_model->get_user_and_company_details(logged('id'));
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['employees'] = $this->vendors_model->getEmployees(logged('company_id'));
        $this->page_data['page_title'] = "Reports";
        $this->page_data['management_reports'] = $this->accounting_management_reports->get_management_reports_by_company(logged('company_id'));

        $this->page_data['page']->title = 'Reports';
        $this->page_data['page']->parent = 'Reports';
        $this->load->view('accounting/reports/index', $this->page_data);
    }

    public function add_to_favorites($reportTypeId)
    {
        $favoriteId = $this->accounting_favorite_reports_model->add_to_favorites($reportTypeId, logged('company_id'));

        echo json_encode([
            'data' => $favoriteId,
            'success' => $favoriteId ? true : false
        ]);
    }

    public function remove_from_favorites($reportTypeId)
    {
        $delete = $this->accounting_favorite_reports_model->remove_from_favorites($reportTypeId, logged('company_id'));

        echo json_encode([
            'data' => $reportTypeId,
            'success' => $delete ? true : false
        ]);
    }

    public function custom()
    {
        $this->page_data['company_details'] = $this->timesheet_model->get_user_and_company_details(logged('id'));
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['employees'] = $this->vendors_model->getEmployees(logged('company_id'));
        $this->page_data['page_title'] = "Reports";
        $this->page_data['management_reports'] = $this->accounting_management_reports->get_management_reports_by_company(logged('company_id'));

        $this->page_data['page']->title = 'Custom Reports';
        $this->page_data['page']->parent = 'Reports';
        $this->load->view('accounting/reports/custom', $this->page_data);
    }

    public function management()
    {
        add_css([
            'assets/css/accounting/reports/management_reports.css'
        ]);

        add_footer_js([
            'assets/js/accounting/reports/management_reports.js'
        ]);

        $this->page_data['company_details'] = $this->timesheet_model->get_user_and_company_details(logged('id'));
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['employees'] = $this->vendors_model->getEmployees(logged('company_id'));
        $this->page_data['page_title'] = "Reports";
        $this->page_data['management_reports'] = $this->accounting_management_reports->get_management_reports_by_company(logged('company_id'));

        $this->page_data['page']->title = 'Management Reports';
        $this->page_data['page']->parent = 'Reports';
        $this->load->view('accounting/reports/management_reports', $this->page_data);
    }

    public function activities()
    {
        $this->page_data['company_details'] = $this->timesheet_model->get_user_and_company_details(logged('id'));
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['employees'] = $this->vendors_model->getEmployees(logged('company_id'));
        $this->page_data['page_title'] = "Reports";
        $this->page_data['management_reports'] = $this->accounting_management_reports->get_management_reports_by_company(logged('company_id'));

        $this->page_data['page']->title = 'Activities Reports';
        $this->page_data['page']->parent = 'Reports';
        $this->load->view('accounting/reports/activities', $this->page_data);
    }

    public function analytics()
    {
        $this->page_data['company_details'] = $this->timesheet_model->get_user_and_company_details(logged('id'));
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['employees'] = $this->vendors_model->getEmployees(logged('company_id'));
        $this->page_data['page_title'] = "Reports";
        $this->page_data['management_reports'] = $this->accounting_management_reports->get_management_reports_by_company(logged('company_id'));

        $this->page_data['page']->title = 'Analytics';
        $this->page_data['page']->parent = 'Reports';
        $this->load->view('accounting/reports/analytics', $this->page_data);
    }

    public function payscale()
    {
        $this->page_data['company_details'] = $this->timesheet_model->get_user_and_company_details(logged('id'));
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['employees'] = $this->vendors_model->getEmployees(logged('company_id'));
        $this->page_data['page_title'] = "Reports";
        $this->page_data['management_reports'] = $this->accounting_management_reports->get_management_reports_by_company(logged('company_id'));

        $this->page_data['page']->title = 'PayScale';
        $this->page_data['page']->parent = 'Reports';
        $this->load->view('accounting/reports/payscale', $this->page_data);
    }

    public function audit_log()
    {
        add_footer_js([
            'assets/js/accounting/reports/standard_report_pages/audit_log.js'
        ]);

        $this->page_data['company_users'] = $this->users_model->getActiveCompanyUsers(logged('company_id'));
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['customers'] = $this->accounting_invoices_model->getCustomers();
        $this->page_data['page_title'] = "Audit Log";

        $this->page_data['page']->title = 'Audit Log';
        $this->page_data['page']->parent = 'Reports';
        $this->load->view('accounting/reports/standard_report_pages/audit_log', $this->page_data);
    }

    public function ffcra_cares_act_report()
    {
        add_footer_js([
            'assets/js/accounting/reports/standard_report_pages/ffcra_cares_act_report.js'
        ]);

        $this->page_data['company_users'] = $this->users_model->getActiveCompanyUsers(logged('company_id'));
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['customers'] = $this->accounting_invoices_model->getCustomers();
        $this->page_data['page_title'] = "FFCRA Cares Act Report";

        $this->page_data['page']->title = 'FFCRA Cares Act Report';
        $this->page_data['page']->parent = 'Reports';
        $this->load->view('accounting/reports/standard_report_pages/ffcra_cares_act_report', $this->page_data);
    }

    public function view_report($reportTypeId)
    {
        $reportType = $this->accounting_report_types_model->get_by_id($reportTypeId);
        $view = strtolower(str_replace(' ', '_', $reportType->name));
        $view = str_replace('-', '_', $view);
        $view = str_replace('&', 'and', $view);
        $view = str_replace('/', '_', $view);
        $js = str_replace('%', 'percentage', $view);

        add_footer_js([
            "assets/js/accounting/reports/standard_report_pages/$js.js"
        ]);

        $this->page_data['company_details'] = $this->timesheet_model->get_user_and_company_details(logged('id'));
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['employees'] = $this->vendors_model->getEmployees(logged('company_id'));

        if($reportType->name === 'Profit and Loss by Tag Group') {
            $this->page_data['group_tags'] = $this->tags_model->getGroup();
        }

        $this->page_data['page']->title = $reportType->name;
        $this->page_data['page']->parent = 'Reports';
        $this->load->view("accounting/reports/standard_report_pages/$view", $this->page_data);
    }
}