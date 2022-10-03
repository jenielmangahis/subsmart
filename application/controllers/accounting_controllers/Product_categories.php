<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_categories extends MY_Controller {
	
	public function __construct()
    {
		parent::__construct();
        $this->checkLogin();
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
        $this->load->model('vendors_model');

        $this->page_data['page']->title = 'Product Categories';
        $this->page_data['page']->parent = 'Sales';

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
        add_footer_js(array(
            "assets/js/v2/printThis.js",
            "assets/js/v2/accounting/sales/product_categories/list.js"
        ));

        $categories = $this->items_model->categoriesWithoutParent();

        foreach($categories as $key => $category) {
            $categories[$key]->child_categories = $this->items_model->get_child_categories($category->item_categories_id);
        }

        $this->page_data['categories'] = $categories;
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['page_title'] = "Product Categories";
        $this->load->view('v2/pages/accounting/sales/products_and_services/product_categories', $this->page_data);
    }

    public function get_categories()
    {
        $categories = $this->items_model->categoriesWithoutParent();

        $return = [];

        foreach($categories as $category) {
            $return['results'][] = [
                'id' => $category->item_categories_id,
                'text' => $category->name
            ];
        }

        echo json_encode($return);
    }

    public function create()
    {
        $post = $this->input->post();

        $data = [
            'company_id' => getLoggedCompanyID(),
            'name' => $post['name'],
            'parent_id' => isset($post['parent_id']) ? $post['parent_id'] : null
        ];

        $create = $this->items_model->insertCategory($data);
        $name = $data['name'];

        if($create) {
            $this->session->set_flashdata('success', "$name added successfully!");
        } else {
            $this->session->set_flashdata('error', "Please try again!");
        }

        redirect("accounting/product-categories");
    }

    public function get_category_details($id)
    {
        $category = $this->items_model->getCategory($id);
        if($category->parent_id !== null && $category->parent_id !== 0 && $category->parent_id !== "") {
            $category->parent = $this->items_model->getCategory($category->parent_id);
        }
        echo json_encode($category);
    }

    public function update($id)
    {
        $post = $this->input->post();

        $data = [
            'name' => $post['name'],
            'parent_id' => isset($post['parent_id']) ? $post['parent_id'] : null
        ];

        $update = $this->items_model->updateCategory($id, $data);
        $name = $data['name'];

        if($update) {
            $this->session->set_flashdata('success', "$name updated successfully!");
        } else {
            $this->session->set_flashdata('error', "Please try again!");
        }

        redirect("accounting/product-categories");
    }

    public function delete($id)
    {
        $name = $this->items_model->getCategory($id)->name;
        $delete = $this->items_model->deleteCategory($id);

        $removeItemCategories = $this->items_model->remove_item_categories($id);

        if($delete) {
            $this->session->set_flashdata('success', "$name deleted successfully!");
        } else {
            $this->session->set_flashdata('error', "Please try again!");
        }
    }

    public function load_product_categories()
    {
        $postData = json_decode(file_get_contents('php://input'), true);
        $order = $postData['order'][0]['dir'];
        $start = $postData['start'];
        $limit = $postData['length'];

        $categories = $this->items_model->getItemCategories($order);

        $data = [];

        foreach($categories as $category) {
            $data[] = [
                'id' => $category->item_categories_id,
                'name' => $category->name
            ];
        }

        $result = [
            'draw' => $postData['draw'],
            'recordsTotal' => count($categories),
            'recordsFiltered' => count($data),
            'data' => array_slice($data, $start, $limit)
        ];

        echo json_encode($result);
    }
}