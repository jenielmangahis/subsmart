<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Credit_notes extends MY_Controller {

    public function __construct()
    {
		parent::__construct();
        $this->checkLogin();
        $this->load->model('vendors_model');
        $this->load->model('accounting_customers_model');
        $this->load->model('accounting_invoices_model');

        $this->load->model('AcsProfile_model');
        $this->load->model('invoice_model');
        $this->load->model('workorder_model');
        $this->load->model('estimate_model');
        $this->load->model('accounting_receive_payment_model');
        $this->load->model('accounting_sales_receipt_model');
        $this->load->model('accounting_refund_receipt_model');
        $this->load->model('accounting_credit_memo_model');
        $this->load->model('accounting_delayed_credit_model');
        $this->load->model('accounting_delayed_charge_model');
        $this->load->model('accounting_statements_model');
        $this->load->model('accounting_single_time_activity_model');
        $this->load->model('invoice_settings_model');
        $this->load->model('accounting_payment_methods_model');
        $this->load->model('EstimateSettings_model');

        $this->page_data['page']->title = 'Sales Transactions';
        $this->page_data['page']->parent = 'Sales';

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
            "assets/js/v2/accounting/sales/credit_notes/list.js",
            "assets/js/v2/printThis.js",
        ));
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['page_title'] = "All Sales";

        $creditMemos = $this->accounting_credit_memo_model->get_company_credit_memos(['company_id' => logged('company_id')]);

        $notes = [];
        foreach($creditMemos as $creditMemo)
        {
            $customer = $this->accounting_customers_model->get_by_id($creditMemo->customer_id);
            $customerName = $customer->first_name . ' ' . $customer->last_name;

            $manageCol = "<div class='dropdown table-management'>
                <a href='#' class='dropdown-toggle' data-bs-toggle='dropdown'>
                    <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                </a>
                <ul class='dropdown-menu dropdown-menu-end'>
                    <li>
                        <a class='dropdown-item print-credit-memo' href='/accounting/customers/print-transaction/credit-memo/$creditMemo->id' target='_blank'>Print</a>
                    </li>
                    <li>
                        <a class='dropdown-item send-credit-memo' href='#'>Send</a>
                    </li>
                    <li>
                        <a class='dropdown-item view-edit-credit-memo' href='#'>View/Edit</a>
                    </li>
                    <li>
                        <a class='dropdown-item copy-transaction' href='#'>Copy</a>
                    </li>
                    <li>
                        <a class='dropdown-item void-credit-memo' href='#'>Void</a>
                    </li>
                </ul>
            </div>";

            $notes[] = [
                'id' => $creditMemo->id,
                'date' => date("m/d/Y", strtotime($creditMemo->credit_memo_date)),
                'type' => 'Credit Memo',
                'no' => $creditMemo->ref_no,
                'customer' => $customerName,
                'customer_id' => $creditMemo->customer_id,
                'method' => '',
                'source' => '',
                'memo' => $creditMemo->message_credit_memo,
                'due_date' => date("m/d/Y", strtotime($creditMemo->credit_memo_date)),
                'aging' => '',
                'balance' => number_format(floatval(str_replace(',', '', $creditMemo->balance)), 2, '.', ','),
                'total' => number_format(floatval(str_replace(',', '', $creditMemo->total_amount)), 2, '.', ','),
                'last_delivered' => '',
                'email' => $creditMemo->email,
                'attachments' => '',
                'status' => floatval($creditMemo->balance) > 0 ? 'Unapplied' : 'Applied',
                'po_number' => '',
                'sales_rep' => $creditMemo->sales_rep,
                'date_created' => date("m/d/Y H:i:s", strtotime($creditMemo->created_at)),
                'manage' => $manageCol
            ];
        }

        if(!empty(get('from'))) {
            $dates = [
                'start-date' => get('from'),
                'end-date' => get('to')
            ];

            $notes = array_filter($notes, function($v, $k) use ($dates) {
                return strtotime($v['date']) >= strtotime($dates['start-date']) && strtotime($v['date']) <= strtotime($dates['end-date']);
            }, ARRAY_FILTER_USE_BOTH);
        }

        if(!empty(get('customer'))) {
            $customerId = get('customer');
            $notes = array_filter($notes, function($v, $k) use ($customerId) {
                return $customerId === $v['customer_id'];
            }, ARRAY_FILTER_USE_BOTH);
        }

        usort($notes, function($a, $b) {
            if($a['date'] === $b['date']) {
                return strtotime($b['date_created']) > strtotime($a['date_created']);
            }
            return strtotime($b['date']) > strtotime($a['date']);
        });

        $this->page_data['page']->title = 'Credit Notes';
        $this->page_data['page']->parent = 'Sales';
        $this->page_data['notes'] = $notes;
        $this->load->view('accounting/sales/credit_notes', $this->page_data);
    }

    public function ajax_delete_selected()
    {
        $post = $this->input->post();
        $is_success = 0;
        $msg = 'Cannot find data';

        foreach ($post['creditNotes'] as $credit_note_id) {
            $this->accounting_credit_memo_model->delete($credit_note_id);
            $total_deleted++;
        }

        if( $total_deleted > 0 ){
            $msg = '';
            $is_success = 1;
        }else{
            $msg = 'Credit note data not found';
        }

        $json_data = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($json_data);

        exit;
    }

    public function export()
    {
        $this->load->library('PHPXLSXWriter');
        $post = $this->input->post();
        $order = $post['order'];
        $columnName = $post['column'];
        $date = $post['date'];
        $from = $post['from'];
        $to = $post['to'];
        $customerId = $post['customer'];

        $creditMemos = $this->accounting_credit_memo_model->get_company_credit_memos(['company_id' => logged('company_id')]);

        $notes = [];
        foreach($creditMemos as $creditMemo)
        {
            $customer = $this->accounting_customers_model->get_by_id($creditMemo->customer_id);
            $customerName = $customer->first_name . ' ' . $customer->last_name;

            $manageCol = "<div class='dropdown table-management'>
                <a href='#' class='dropdown-toggle' data-bs-toggle='dropdown'>
                    <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                </a>
                <ul class='dropdown-menu dropdown-menu-end'>
                    <li>
                        <a class='dropdown-item print-credit-memo' href='/accounting/customers/print-transaction/credit-memo/$creditMemo->id' target='_blank'>Print</a>
                    </li>
                    <li>
                        <a class='dropdown-item send-credit-memo' href='#'>Send</a>
                    </li>
                    <li>
                        <a class='dropdown-item view-edit-credit-memo' href='#'>View/Edit</a>
                    </li>
                    <li>
                        <a class='dropdown-item copy-transaction' href='#'>Copy</a>
                    </li>
                    <li>
                        <a class='dropdown-item void-credit-memo' href='#'>Void</a>
                    </li>
                </ul>
            </div>";

            $notes[] = [
                'id' => $creditMemo->id,
                'date' => date("m/d/Y", strtotime($creditMemo->credit_memo_date)),
                'type' => 'Credit Memo',
                'no' => $creditMemo->ref_no,
                'customer' => $customerName,
                'customer_id' => $creditMemo->customer_id,
                'method' => '',
                'source' => '',
                'memo' => $creditMemo->message_credit_memo,
                'due_date' => date("m/d/Y", strtotime($creditMemo->credit_memo_date)),
                'aging' => '',
                'balance' => number_format(floatval(str_replace(',', '', $creditMemo->balance)), 2, '.', ','),
                'total' => number_format(floatval(str_replace(',', '', $creditMemo->total_amount)), 2, '.', ','),
                'last_delivered' => '',
                'email' => $creditMemo->email,
                'attachments' => '',
                'status' => floatval($creditMemo->balance) > 0 ? 'Unapplied' : 'Applied',
                'po_number' => '',
                'sales_rep' => '',
                'date_created' => date("m/d/Y H:i:s", strtotime($creditMemo->created_at)),
                'manage' => $manageCol
            ];
        }

        if(!empty($from)) {
            $dates = [
                'start-date' => $from,
                'end-date' => $to
            ];

            $notes = array_filter($notes, function($v, $k) use ($dates) {
                return strtotime($v['date']) >= strtotime($dates['start-date']) && strtotime($v['date']) <= strtotime($dates['end-date']);
            }, ARRAY_FILTER_USE_BOTH);
        }

        if(!empty($customerId)) {
            $notes = array_filter($notes, function($v, $k) use ($customerId) {
                return $customerId === $v['customer_id'];
            }, ARRAY_FILTER_USE_BOTH);
        }

        usort($notes, function($a, $b) {
            if($a['date'] === $b['date']) {
                return strtotime($b['date_created']) > strtotime($a['date_created']);
            }
            return strtotime($b['date']) > strtotime($a['date']);
        });

        $excelHead .= $customerId ? "Name: $customer->first_name $customer->last_name · " : "";
        $excelHead .= $date ? "Date: ".ucfirst(str_replace("-", " ", $date)) : "Date: Last 365 days";

        $writer = new XLSXWriter();
        $writer->writeSheetRow('Sheet1', [$excelHead], ['halign' => 'center', 'valign' => 'center', 'font-style' => 'bold']);
        $writer->markMergedCell('Sheet1', 0, 0, 0, count($post['fields']) - 1);

        $writer->writeSheetRow('Sheet1', $post['fields'], ['font-style' => 'bold', 'border' => 'bottom', 'halign' => 'center', 'valign' => 'center']);

        foreach($notes as $note)
        {
            $keys = array_keys($note);
            $item = [];

            foreach($post['fields'] as $tableHeader)
            {
                $tableHeader = str_replace('.', '', $tableHeader);
                $tableHeader = str_replace(' ', '_', $tableHeader);
                $tableHeader = strtolower($tableHeader);

                $item[] = $note[$tableHeader];
            }

            $writer->writeSheetRow('Sheet1', $item);
        }

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="credit_notes.xlsx"');
        header('Cache-Control: max-age=0');
        $writer->writeToStdOut();
    }
}