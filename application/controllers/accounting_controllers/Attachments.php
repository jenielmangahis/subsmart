<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attachments extends MY_Controller {
	
	public function __construct()
    {
		parent::__construct();
        $this->checkLogin();
        $this->load->model('accounting_attachments_model');
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

        $this->page_data['page']->title = 'Attachments';

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
            "assets/js/v2/accounting/lists/attachments/list.js"
            // "assets/js/accounting/attachments.js"
        ));

        $this->page_data['attachments'] = $this->get_attachment_files();
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->load->view('v2/pages/accounting/lists/attachments/list', $this->page_data);
    }

    public function upload()
    {
        $files = $_FILES['file'];

        if(count($files['name']) > 0) {
            $insert = $this->uploadFile($files);

            if(count($insert) > 0) {
                $this->session->set_flashdata('success', "Upload successful!");
            } else {
                $this->session->set_flashdata('error', "Please try again!");
            }
        } else {
            $this->session->set_flashdata('error', "An unexpected error occured!");
        }
    }

    private function uploadFile($files)
    {
        $this->load->helper('string');
        $data = [];
        foreach($files['name'] as $key => $name)
        {
            $extension = end(explode('.', $name));

            do {
                $randomString = random_string('alnum');
                $fileNameToStore = $randomString . '.' .$extension;
                $exists = file_exists('./uploads/accounting/attachments/'.$fileNameToStore);
            } while ($exists);

            $fileType = explode('/', $files['type'][$key]);
            $uploadedName = str_replace('.'.$extension, '', $name);

            $data[] = [
                'company_id' => getLoggedCompanyID(),
                'type' => $fileType[0] === 'application' ? ucfirst($fileType[1]) : ucfirst($fileType[0]),
                'uploaded_name' => $uploadedName,
                'stored_name' => $fileNameToStore,
                'file_extension' => $extension,
                'size' => $files['size'][$key],
                'notes' => null,
                'status' => 1,
                'created_at' => date('Y-m-d h:i:s'),
                'updated_at' => date('Y-m-d h:i:s')
            ];

            move_uploaded_file($files['tmp_name'][$key], './uploads/accounting/attachments/'.$fileNameToStore);
        }

        $attachmentIds = [];
        foreach($data as $attachment) {
            $attachmentIds[] = $this->accounting_attachments_model->create($attachment);
        }

        return $attachmentIds;
    }

    private function get_attachment_files()
    {
        $attachments = $this->accounting_attachments_model->getCompanyAttachments();

        $data = [];

        if(count($attachments) > 0) {
            foreach($attachments as $attachment) {
                $linked = $this->accounting_attachments_model->get_attachment_link_by_attachment_id($attachment['id']);

                $attached = [];
                foreach($linked as $link) {
                    switch($link->type) {
                        case 'Vendor' :
                            $vendor = $this->vendors_model->get_vendor_by_id($link->linked_id);
                            $text = "<p class='m-0'><a href='/accounting/vendors/view/$vendor->id' class='text-decoration-none'>";
                            $text .= 'Vendor: '.$vendor->display_name;
                            $text .= '</a></p>';
                        break;
                        case 'Expense' :
                            $expense = $this->vendors_model->get_expense_by_id($link->linked_id, logged('company_id'));
                            switch ($expense->payee_type) {
                                case 'vendor':
                                    $payee = $this->vendors_model->get_vendor_by_id($expense->payee_id);
                                    $payeeName = $payee->display_name;
                                break;
                                case 'customer':
                                    $payee = $this->accounting_customers_model->get_by_id($expense->payee_id);
                                    $payeeName = $payee->first_name . ' ' . $payee->last_name;
                                break;
                                case 'employee':
                                    $payee = $this->users_model->getUser($expense->payee_id);
                                    $payeeName = $payee->FName . ' ' . $payee->LName;
                                break;
                            }
                            $amount = '$'.number_format($expense->total_amount, 2, '.', ',');
                            $amount = str_replace('$-', '-$', $amount);

                            $text = '<p class="m-0"><a href="#" class="view-linked-expense text-decoration-none" data-id="'.$expense->id.'">';
                            if(in_array($expense->ref_no, ['', '0', null])) {
                                $text .= "Expense:</a> $amount - $payeeName";
                            } else {
                                $text .= "Expense $expense->ref_no:</a> $amount - $payeeName";
                            }
                            $text .= '</p>';
                        break;
                        case 'Check' :
                            $check = $this->vendors_model->get_check_by_id($link->linked_id, logged('company_id'));
                            switch ($check->payee_type) {
                                case 'vendor':
                                    $payee = $this->vendors_model->get_vendor_by_id($check->payee_id);
                                    $payeeName = $payee->display_name;
                                break;
                                case 'customer':
                                    $payee = $this->accounting_customers_model->get_by_id($check->payee_id);
                                    $payeeName = $payee->first_name . ' ' . $payee->last_name;
                                break;
                                case 'employee':
                                    $payee = $this->users_model->getUser($check->payee_id);
                                    $payeeName = $payee->FName . ' ' . $payee->LName;
                                break;
                            }
                            $amount = '$'.number_format($check->total_amount, 2, '.', ',');
                            $amount = str_replace('$-', '-$', $amount);

                            $text = '<p class="m-0"><a href="#" class="view-linked-check text-decoration-none" data-id="'.$check->id.'">';
                            if(in_array($check->check_no, ['', '0', null]) || $check->to_print === "1") {
                                $text .= "Check:</a> $amount - $payeeName";
                            } else {
                                $text .= "Check $check->check_no:</a> $amount - $payeeName";
                            }
                            $text .= '</p>';
                        break;
                        case 'Bill' :
                            $bill = $this->vendors_model->get_bill_by_id($link->linked_id, logged('company_id'));
                            $vendor = $this->vendors_model->get_vendor_by_id($bill->vendor_id);
                            $payeeName = $vendor->display_name;

                            $amount = '$'.number_format($bill->total_amount, 2, '.', ',');
                            $amount = str_replace('$-', '-$', $amount);

                            $text = '<p class="m-0"><a href="#" class="view-linked-bill text-decoration-none" data-id="'.$bill->id.'">';
                            if(in_array($bill->bill_no, ['', '0', null])) {
                                $text .= "Bill:</a> $amount - $payeeName";
                            } else {
                                $text .= "Bill $bill->bill_no:</a> $amount - $payeeName";
                            }
                            $text .= '</p>';
                        break;
                        case 'Bill Payment' :
                            $billPayment = $this->vendors_model->get_bill_payment_by_id($link->linked_id);
                            $payee = $this->vendors_model->get_vendor_by_id($billPayment->payee_id);
                            $payeeName = $payee->display_name;
                            
                            $amount = '$'.number_format($billPayment->total_amount, 2, '.', ',');
                            $amount = str_replace('$-', '-$', $amount);

                            $text = '<p class="m-0"><a href="#" class="view-linked-bill-payment text-decoration-none" data-id="'.$billPayment->id.'">';
                            if(in_array($billPayment->check_no, ['', '0', null])) {
                                $text .= "Bill Payment:</a> $amount - $payeeName";
                            } else {
                                $text .= "Bill Payment $billPayment->check_no:</a> $amount - $payeeName";
                            }
                            $text .= '</p>';
                        break;
                        case 'Purchase Order' :
                            $purchaseOrder = $this->vendors_model->get_purchase_order_by_id($link->linked_id, logged('company_id'));
                            $vendor = $this->vendors_model->get_vendor_by_id($purchaseOrder->vendor_id);
                            $payeeName = $vendor->display_name;

                            $amount = '$'.number_format($purchaseOrder->total_amount, 2, '.', ',');
                            $amount = str_replace('$-', '-$', $amount);

                            $text = '<p class="m-0"><a href="#" class="view-linked-purchase-order text-decoration-none" data-id="'.$purchaseOrder->id.'">';
                            if(in_array($purchaseOrder->purchase_order_no, ['', '0', null])) {
                                $text .= "Purchase Order:</a> $amount - $payeeName";
                            } else {
                                $text .= "Purchase Order $purchaseOrder->purchase_order_no:</a> $amount - $payeeName";
                            }
                            $text .= '</p>';
                        break;
                        case 'Vendor Credit' :
                            $vCredit = $this->vendors_model->get_vendor_credit_by_id($link->linked_id, logged('company_id'));
                            $vendor = $this->vendors_model->get_vendor_by_id($vCredit->vendor_id);
                            $payeeName = $vendor->display_name;

                            $amount = '$'.number_format($vCredit->total_amount, 2, '.', ',');
                            $amount = str_replace('$-', '-$', $amount);

                            $text = '<p class="m-0"><a href="#" class="view-linked-vendor-credit text-decoration-none" data-id="'.$vCredit->id.'">';
                            if(in_array($vCredit->ref_no, ['', '0', null])) {
                                $text .= "Vendor Credit:</a> $amount - $payeeName";
                            } else {
                                $text .= "Vendor Credit $vCredit->ref_no:</a> $amount - $payeeName";
                            }
                            $text .= '</p>';
                        break;
                        case 'CC Credit' :
                            $ccCredit = $this->vendors_model->get_credit_card_credit_by_id($link->linked_id, logged('company_id'));
                            switch ($ccCredit->payee_type) {
                                case 'vendor':
                                    $payee = $this->vendors_model->get_vendor_by_id($ccCredit->payee_id);
                                    $payeeName = $payee->display_name;
                                break;
                                case 'customer':
                                    $payee = $this->accounting_customers_model->get_by_id($ccCredit->payee_id);
                                    $payeeName = $payee->first_name . ' ' . $payee->last_name;
                                break;
                                case 'employee':
                                    $payee = $this->users_model->getUser($ccCredit->payee_id);
                                    $payeeName = $payee->FName . ' ' . $payee->LName;
                                break;
                            }
                            $amount = '$'.number_format($ccCredit->total_amount, 2, '.', ',');
                            $amount = str_replace('$-', '-$', $amount);

                            $text = '<p class="m-0"><a href="#" class="view-linked-cc-credit text-decoration-none" data-id="'.$ccCredit->id.'">';
                            if(in_array($ccCredit->ref_no, ['', '0', null])) {
                                $text .= "CC-Credit:</a> $amount - $payeeName";
                            } else {
                                $text .= "CC-Credit $ccCredit->ref_no:</a> $amount - $payeeName";
                            }
                            $text .= '</p>';
                        break;
                        case 'CC Payment' :
                            $ccPayment = $this->vendors_model->get_credit_card_payment_by_id($link->linked_id);
                            $vendor = $this->vendors_model->get_vendor_by_id($ccPayment->payee_id);
                            $payeeName = $vendor->display_name;

                            $amount = '$'.number_format($ccPayment->amount, 2, '.', ',');
                            $amount = str_replace('$-', '-$', $amount);

                            $text = '<p class="m-0"><a href="#" class="view-linked-cc-payment text-decoration-none" data-id="'.$ccPayment->id.'">';
                            $text .= "CC Payment:</a> $amount - $payeeName";
                            $text .= '</p>';
                        break;
                        case 'Deposit' :
                            $deposit = $this->accounting_bank_deposit_model->getById($link->linked_id, logged('company_id'));
                            $amount = '$'.number_format($deposit->total_amount, 2, '.', ',');
                            $amount = str_replace('$-', '-$', $amount);

                            $text = '<p class="m-0"><a href="#" class="view-linked-deposit text-decoration-none" data-id="'.$deposit->id.'">';
                            $text .= "Deposit:</a> $amount";
                            $text .= '</p>';
                        break;
                        case 'Transfer' :
                            $transfer = $this->accounting_transfer_funds_model->getById($link->linked_id, logged('company_id'));
                            $amount = '$'.number_format($transfer->transfer_amount, 2, '.', ',');
                            $amount = str_replace('$-', '-$', $amount);

                            $text = '<p class="m-0"><a href="#" class="view-linked-transfer text-decoration-none" data-id="'.$transfer->id.'">';
                            $text .= "Transfer:</a> $amount";
                            $text .= '</p>';
                        break;
                        case 'Journal' :
                            $journal = $this->accounting_journal_entries_model->getById($link->linked_id, logged('company_id'));
                            $amount = '$0.00';
                            
                            $text = '<p class="m-0"><a href="#" class="view-linked-journal text-decoration-none" data-id="'.$journal->id.'">';
                            if(in_array($journal->journal_no, ['', '0', null])) {
                                $text .= "Journal:</a> $amount";
                            } else {
                                $text .= "Journal $journal->journal_no:</a> $amount";
                            }
                            $text .= '</p>';
                        break;
                    }

                    $attachedTo = [
                        'id' => $link->linked_id,
                        'type' => $link->type,
                        'text' => $text
                    ];

                    $attached[] = $attachedTo;
                }

                $data[] = [
                    'id' => $attachment['id'],
                    'thumbnail' => $attachment['stored_name'],
                    'type' => $attachment['type'],
                    'name' => $attachment['uploaded_name'],
                    'extension' => $attachment['file_extension'],
                    'size' => $attachment['size'],
                    'upload_date' => date('m/d/Y', strtotime($attachment['created_at'])),
                    'links' => $attached,
                    'note' => $attachment['notes']
                ];
            }
        }

        return $data;
    }

    public function download()
    {
        $filename = $this->input->get('filename');
        $file = "./uploads/accounting/attachments/$filename";

        if(file_exists($file)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.basename($file).'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            readfile($file);
        }
    }

    public function edit($id)
    {
        $post = $this->input->post();

        $data = [
            'uploaded_name' => $post['file_name'],
            'notes' => $post['notes']
        ];

        $update = $this->accounting_attachments_model->updateAttachment($id, $data);
        $name = $post['file_name'];

        if($update) {
            $this->session->set_flashdata('success', "$name updated successfully!");
        } else {
            $this->session->set_flashdata('error', "Please try again!");
        }

        redirect('/accounting/attachments');
    }

    public function delete($id)
    {
        $result = [];

        $attachment = $this->accounting_attachments_model->getById($id);
        if(file_exists("./uploads/accounting/attachments/".$attachment->stored_name)) {
            unlink("./uploads/accounting/attachments/".$attachment->stored_name);
        }
        $name = $attachment->uploaded_name;
        $delete = $this->accounting_attachments_model->delete($id);

        if($delete) {
            $this->session->set_flashdata('success', "$name has been successfully deleted!");
        } else {
            $this->session->set_flashdata('error', "Please try again!");
        }
    }

    public function attach()
    {
        $files = $_FILES['file'];

        if(count($files['name']) > 0) {
            $insert = $this->uploadFile($files);

            $return = new stdClass();
            $return->attachment_ids = $insert;
            echo json_encode($return);
        } else {
            echo json_encode('error');
        }
    }

    public function get_all_attachments()
    {
        $transacAtt = $this->accounting_attachments_model->get_attachments($this->input->get('type'), $this->input->get('id'));
        $exemptedIds = array_column($transacAtt, 'id');

        $attachments = $this->accounting_attachments_model->getCompanyAttachments();

        $attachments = array_filter($attachments, function($attachment) use ($exemptedIds) {
            return !in_array($attachment['id'], $exemptedIds);
        });

        echo json_encode($attachments);
    }

    public function get_unlinked_attachments()
    {
        $transacAtt = $this->accounting_attachments_model->get_attachments($this->input->get('type'), $this->input->get('id'));
        $exemptedIds = array_column($transacAtt, 'id');

        $attachments = $this->accounting_attachments_model->get_unlinked_attachments();

        $attachments = array_filter($attachments, function($attachment) use ($exemptedIds) {
            return !in_array($attachment['id'], $exemptedIds);
        });

        echo json_encode($attachments);
    }

    public function print_attachments()
    {
        $data = $this->input->post();
        $attachments = $this->accounting_attachments_model->getCompanyAttachments();

        $tableHtml = "<table width='100%'>";
        $tableHtml .= "<thead>";
        $tableHtml .= "<tr style='text-align: left;'>";
        $tableHtml .= "<th style='border-bottom: 2px solid #BFBFBF'>Thumbnail</th>";
        $tableHtml .= "<th style='border-bottom: 2px solid #BFBFBF'>Type</th>";
        $tableHtml .= "<th style='border-bottom: 2px solid #BFBFBF'>Name</th>";
        $tableHtml .= $data['size'] === "1" ? "<th style='border-bottom: 2px solid #BFBFBF'>Size</th>" : "";
        $tableHtml .= $data['uploaded'] === "1" ? "<th style='border-bottom: 2px solid #BFBFBF'>Uploaded</th>" : "";
        $tableHtml .= "<th style='border-bottom: 2px solid #BFBFBF'>Links</th>";
        $tableHtml .= $data['notes'] === "1" ? "<th style='border-bottom: 2px solid #BFBFBF'>Note</th>" : "";
        $tableHtml .= "</tr>";
        $tableHtml .= "</thead>";
        $tableHtml .= "<tbody>";
        foreach($attachments as $attachment) {
            $linked = $this->accounting_attachments_model->get_attachment_link_by_attachment_id($attachment['id']);

            $links = "";
            foreach($linked as $link) {
                switch($link->type) {
                    case 'Vendor' :
                        $vendor = $this->vendors_model->get_vendor_by_id($link->linked_id);
                        $links .= "<p style='margin: 0'>";
                        $links .= 'Vendor: '.$vendor->display_name;
                        $links .= '</p>';
                    break;
                    case 'Expense' :
                        $expense = $this->vendors_model->get_expense_by_id($link->linked_id, logged('company_id'));
                        switch ($expense->payee_type) {
                            case 'vendor':
                                $payee = $this->vendors_model->get_vendor_by_id($expense->payee_id);
                                $payeeName = $payee->display_name;
                            break;
                            case 'customer':
                                $payee = $this->accounting_customers_model->get_by_id($expense->payee_id);
                                $payeeName = $payee->first_name . ' ' . $payee->last_name;
                            break;
                            case 'employee':
                                $payee = $this->users_model->getUser($expense->payee_id);
                                $payeeName = $payee->FName . ' ' . $payee->LName;
                            break;
                        }
                        $amount = '$'.number_format($expense->total_amount, 2, '.', ',');
                        $amount = str_replace('$-', '-$', $amount);

                        $links .= '<p style="margin: 0">';
                        if(in_array($expense->ref_no, ['', '0', null])) {
                            $links .= "Expense: $amount - $payeeName";
                        } else {
                            $links .= "Expense $expense->ref_no: $amount - $payeeName";
                        }
                        $links .= '</p>';
                    break;
                    case 'Check' :
                        $check = $this->vendors_model->get_check_by_id($link->linked_id, logged('company_id'));
                        switch ($check->payee_type) {
                            case 'vendor':
                                $payee = $this->vendors_model->get_vendor_by_id($check->payee_id);
                                $payeeName = $payee->display_name;
                            break;
                            case 'customer':
                                $payee = $this->accounting_customers_model->get_by_id($check->payee_id);
                                $payeeName = $payee->first_name . ' ' . $payee->last_name;
                            break;
                            case 'employee':
                                $payee = $this->users_model->getUser($check->payee_id);
                                $payeeName = $payee->FName . ' ' . $payee->LName;
                            break;
                        }
                        $amount = '$'.number_format($check->total_amount, 2, '.', ',');
                        $amount = str_replace('$-', '-$', $amount);

                        $links .= '<p style="margin: 0">';
                        if(in_array($check->check_no, ['', '0', null]) || $check->to_print === "1") {
                            $links .= "Check: $amount - $payeeName";
                        } else {
                            $links .= "Check $check->check_no: $amount - $payeeName";
                        }
                        $links .= '</p>';
                    break;
                    case 'Bill' :
                        $bill = $this->vendors_model->get_bill_by_id($link->linked_id, logged('company_id'));
                        $vendor = $this->vendors_model->get_vendor_by_id($bill->vendor_id);
                        $payeeName = $vendor->display_name;

                        $amount = '$'.number_format($bill->total_amount, 2, '.', ',');
                        $amount = str_replace('$-', '-$', $amount);

                        $links .= '<p style="margin: 0">';
                        if(in_array($bill->bill_no, ['', '0', null])) {
                            $links .= "Bill: $amount - $payeeName";
                        } else {
                            $links .= "Bill $bill->bill_no: $amount - $payeeName";
                        }
                        $links .= '</p>';
                    break;
                    case 'Bill Payment' :
                        $billPayment = $this->vendors_model->get_bill_payment_by_id($link->linked_id);
                        $payee = $this->vendors_model->get_vendor_by_id($billPayment->payee_id);
                        $payeeName = $payee->display_name;
                        
                        $amount = '$'.number_format($billPayment->total_amount, 2, '.', ',');
                        $amount = str_replace('$-', '-$', $amount);

                        $links .= '<p style="margin: 0">';
                        if(in_array($billPayment->check_no, ['', '0', null])) {
                            $links .= "Bill Payment: $amount - $payeeName";
                        } else {
                            $links .= "Bill Payment $billPayment->check_no: $amount - $payeeName";
                        }
                        $links .= '</p>';
                    break;
                    case 'Purchase Order' :
                        $purchaseOrder = $this->vendors_model->get_purchase_order_by_id($link->linked_id, logged('company_id'));
                        $vendor = $this->vendors_model->get_vendor_by_id($purchaseOrder->vendor_id);
                        $payeeName = $vendor->display_name;

                        $amount = '$'.number_format($purchaseOrder->total_amount, 2, '.', ',');
                        $amount = str_replace('$-', '-$', $amount);

                        $links .= '<p style="margin: 0">';
                        if(in_array($purchaseOrder->purchase_order_no, ['', '0', null])) {
                            $links .= "Purchase Order: $amount - $payeeName";
                        } else {
                            $links .= "Purchase Order $purchaseOrder->purchase_order_no: $amount - $payeeName";
                        }
                        $links .= '</p>';
                    break;
                    case 'Vendor Credit' :
                        $vCredit = $this->vendors_model->get_vendor_credit_by_id($link->linked_id, logged('company_id'));
                        $vendor = $this->vendors_model->get_vendor_by_id($vCredit->vendor_id);
                        $payeeName = $vendor->display_name;

                        $amount = '$'.number_format($vCredit->total_amount, 2, '.', ',');
                        $amount = str_replace('$-', '-$', $amount);

                        $links .= '<p style="margin: 0">';
                        if(in_array($vCredit->ref_no, ['', '0', null])) {
                            $links .= "Vendor Credit: $amount - $payeeName";
                        } else {
                            $links .= "Vendor Credit $vCredit->ref_no: $amount - $payeeName";
                        }
                        $links .= '</p>';
                    break;
                    case 'CC Credit' :
                        $ccCredit = $this->vendors_model->get_credit_card_credit_by_id($link->linked_id, logged('company_id'));
                        switch ($ccCredit->payee_type) {
                            case 'vendor':
                                $payee = $this->vendors_model->get_vendor_by_id($ccCredit->payee_id);
                                $payeeName = $payee->display_name;
                            break;
                            case 'customer':
                                $payee = $this->accounting_customers_model->get_by_id($ccCredit->payee_id);
                                $payeeName = $payee->first_name . ' ' . $payee->last_name;
                            break;
                            case 'employee':
                                $payee = $this->users_model->getUser($ccCredit->payee_id);
                                $payeeName = $payee->FName . ' ' . $payee->LName;
                            break;
                        }
                        $amount = '$'.number_format($ccCredit->total_amount, 2, '.', ',');
                        $amount = str_replace('$-', '-$', $amount);

                        $links .= '<p style="margin: 0">';
                        if(in_array($ccCredit->ref_no, ['', '0', null])) {
                            $links .= "CC-Credit: $amount - $payeeName";
                        } else {
                            $links .= "CC-Credit $ccCredit->ref_no: $amount - $payeeName";
                        }
                        $links .= '</p>';
                    break;
                    case 'CC Payment' :
                        $ccPayment = $this->vendors_model->get_credit_card_payment_by_id($link->linked_id);
                        $vendor = $this->vendors_model->get_vendor_by_id($ccPayment->payee_id);
                        $payeeName = $vendor->display_name;

                        $amount = '$'.number_format($ccPayment->amount, 2, '.', ',');
                        $amount = str_replace('$-', '-$', $amount);

                        $links .= '<p style="margin: 0">';
                        $links .= "CC Payment: $amount - $payeeName";
                        $links .= '</p>';
                    break;
                    case 'Deposit' :
                        $deposit = $this->accounting_bank_deposit_model->getById($link->linked_id, logged('company_id'));
                        $amount = '$'.number_format($deposit->total_amount, 2, '.', ',');
                        $amount = str_replace('$-', '-$', $amount);

                        $links = '<p style="margin: 0">';
                        $links .= "Deposit: $amount";
                        $links .= '</p>';
                    break;
                    case 'Transfer' :
                        $transfer = $this->accounting_transfer_funds_model->getById($link->linked_id, logged('company_id'));
                        $amount = '$'.number_format($transfer->transfer_amount, 2, '.', ',');
                        $amount = str_replace('$-', '-$', $amount);

                        $links .= '<p style="margin: 0">';
                        $links .= "Transfer: $amount";
                        $links .= '</p>';
                    break;
                    case 'Journal' :
                        $journal = $this->accounting_journal_entries_model->getById($link->linked_id, logged('company_id'));
                        $amount = '$0.00';
                        
                        $links .= '<p style="margin: 0">';
                        if(in_array($journal->journal_no, ['', '0', null])) {
                            $links .= "Journal: $amount";
                        } else {
                            $links .= "Journal $journal->journal_no: $amount";
                        }
                        $links .= '</p>';
                    break;
                }
            }

            $fileName = $attachment['stored_name'];
            $tableHtml .= "<tr>";
            $tableHtml .= "<td style='border-bottom: 1px dotted #D5CDB5'><img src='/uploads/accounting/attachments/$fileName'></td>";
            $tableHtml .= "<td style='border-bottom: 1px dotted #D5CDB5'>".$attachment['type']."</td>";
            $tableHtml .= "<td style='border-bottom: 1px dotted #D5CDB5'>".$attachment['uploaded_name'].'.'.$attachment['file_extension']."</td>";
            $tableHtml .= $data['size'] === "1" ? "<td style='border-bottom: 1px dotted #D5CDB5'>".$attachment['size']."</td>" : "";
            $tableHtml .= $data['uploaded'] === "1" ? "<td style='border-bottom: 1px dotted #D5CDB5'>".date('m/d/Y', strtotime($attachment['created_at']))."</td>" : "";
            $tableHtml .= "<td style='border-bottom: 1px dotted #D5CDB5'>$links</td>";
            $tableHtml .= $data['notes'] === "1" ? "<td style='border-bottom: 1px dotted #D5CDB5'>".$attachment['notes']."</td>" : "";
            $tableHtml .= "</tr>";
        }

        $tableHtml .= "</tbody>";
        $tableHtml .= "</table>";

        echo $tableHtml;
    }

    public function export()
    {
        $this->load->helper('string');
        $ids = $this->input->post('ids');

        $attachments = $this->accounting_attachments_model->get_attachments_by_ids($ids);

        $zip = new ZipArchive();
        do {
            $randomString = random_string('alnum');
            $exists = file_exists('./uploads/accounting/attachments/archive_'.$randomString.'.zip');
        } while ($exists);

        $zipFile = "archive_$randomString.zip";
        $zip->open('./uploads/accounting/attachments/'.$zipFile, ZipArchive::CREATE);
        foreach($attachments as $attachment) {
            $links = $this->accounting_attachments_model->get_attachment_link_by_attachment_id($attachment->id);
            if(count($links) > 0) {
                foreach($links as $link) {
                    switch($link->type) {
                        case 'Vendor' :
                            $folder = '(Unattached documents)';

                            if($zip->locateName("$folder/") === false) {
                                $zip->addEmptyDir($folder);
                            }
                        break;
                        case 'Expense' :
                            $expense = $this->vendors_model->get_expense_by_id($link->linked_id, logged('company_id'));
                            switch ($expense->payee_type) {
                                case 'vendor':
                                    $payee = $this->vendors_model->get_vendor_by_id($expense->payee_id);
                                    $payeeName = $payee->display_name;
                                break;
                                case 'customer':
                                    $payee = $this->accounting_customers_model->get_by_id($expense->payee_id);
                                    $payeeName = $payee->first_name . ' ' . $payee->last_name;
                                break;
                                case 'employee':
                                    $payee = $this->users_model->getUser($expense->payee_id);
                                    $payeeName = $payee->FName . ' ' . $payee->LName;
                                break;
                            }

                            $amount = '$'.number_format($expense->total_amount, 2, '.', ',');
                            $amount = str_replace('$-', '-$', $amount);

                            if($zip->locateName("Expense/") === false) {
                                $zip->addEmptyDir("Expense");
                            }

                            $folder = "Expense/Expense $payeeName $amount";
                        break;
                        case 'Check' :
                            $check = $this->vendors_model->get_check_by_id($link->linked_id, logged('company_id'));
                            switch ($check->payee_type) {
                                case 'vendor':
                                    $payee = $this->vendors_model->get_vendor_by_id($check->payee_id);
                                    $payeeName = $payee->display_name;
                                break;
                                case 'customer':
                                    $payee = $this->accounting_customers_model->get_by_id($check->payee_id);
                                    $payeeName = $payee->first_name . ' ' . $payee->last_name;
                                break;
                                case 'employee':
                                    $payee = $this->users_model->getUser($check->payee_id);
                                    $payeeName = $payee->FName . ' ' . $payee->LName;
                                break;
                            }

                            $amount = '$'.number_format($check->total_amount, 2, '.', ',');
                            $amount = str_replace('$-', '-$', $amount);

                            if($zip->locateName("Check/") === false) {
                                $zip->addEmptyDir("Check");
                            }

                            $folder = "Check/Check $payeeName $amount";
                        break;
                        case 'Bill' :
                            $bill = $this->vendors_model->get_bill_by_id($link->linked_id, logged('company_id'));
                            $vendor = $this->vendors_model->get_vendor_by_id($bill->vendor_id);
                            $payeeName = $vendor->display_name;

                            $amount = '$'.number_format($bill->total_amount, 2, '.', ',');
                            $amount = str_replace('$-', '-$', $amount);

                            if($zip->locateName("Bill/") === false) {
                                $zip->addEmptyDir("Bill");
                            }

                            $folder = "Bill/Bill $payeeName $amount";
                        break;
                        case 'Bill Payment' :
                            $billPayment = $this->vendors_model->get_bill_payment_by_id($link->linked_id);
                            $payee = $this->vendors_model->get_vendor_by_id($billPayment->payee_id);
                            $payeeName = $payee->display_name;

                            $amount = '$'.number_format($billPayment->total_amount, 2, '.', ',');
                            $amount = str_replace('$-', '-$', $amount);

                            if($zip->locateName("Bill Payment/") === false) {
                                $zip->addEmptyDir("Bill Payment");
                            }

                            $folder = "Bill Payment/Bill Payment $payeeName $amount";
                        break;
                        case 'Purchase Order' :
                            $purchaseOrder = $this->vendors_model->get_purchase_order_by_id($link->linked_id, logged('company_id'));
                            $vendor = $this->vendors_model->get_vendor_by_id($purchaseOrder->vendor_id);
                            $payeeName = $vendor->display_name;

                            $amount = '$'.number_format($purchaseOrder->total_amount, 2, '.', ',');
                            $amount = str_replace('$-', '-$', $amount);

                            if($zip->locateName("Purchase Order/") === false) {
                                $zip->addEmptyDir("Purchase Order");
                            }

                            $folder = "Purchase Order/Purchase Order $payeeName $amount";
                        break;
                        case 'Vendor Credit' :
                            $vCredit = $this->vendors_model->get_vendor_credit_by_id($link->linked_id, logged('company_id'));
                            $vendor = $this->vendors_model->get_vendor_by_id($vCredit->vendor_id);
                            $payeeName = $vendor->display_name;

                            $amount = '$'.number_format($vCredit->total_amount, 2, '.', ',');
                            $amount = str_replace('$-', '-$', $amount);

                            if($zip->locateName("Vendor Credit/") === false) {
                                $zip->addEmptyDir("Vendor Credit");
                            }

                            $folder = "Vendor Credit/Vendor Credit $payeeName $amount";
                        break;
                        case 'CC Credit' :
                            $ccCredit = $this->vendors_model->get_credit_card_credit_by_id($link->linked_id, logged('company_id'));
                            switch ($ccCredit->payee_type) {
                                case 'vendor':
                                    $payee = $this->vendors_model->get_vendor_by_id($ccCredit->payee_id);
                                    $payeeName = $payee->display_name;
                                break;
                                case 'customer':
                                    $payee = $this->accounting_customers_model->get_by_id($ccCredit->payee_id);
                                    $payeeName = $payee->first_name . ' ' . $payee->last_name;
                                break;
                                case 'employee':
                                    $payee = $this->users_model->getUser($ccCredit->payee_id);
                                    $payeeName = $payee->FName . ' ' . $payee->LName;
                                break;
                            }

                            $amount = '$'.number_format($ccCredit->total_amount, 2, '.', ',');
                            $amount = str_replace('$-', '-$', $amount);

                            if($zip->locateName("Credit Card Credit/") === false) {
                                $zip->addEmptyDir("Credit Card Credit");
                            }

                            $folder = "Credit Card Credit/CC-Credit $payeeName $amount";
                        break;
                        case 'CC Payment' :
                            $ccPayment = $this->vendors_model->get_credit_card_payment_by_id($link->linked_id);
                            $vendor = $this->vendors_model->get_vendor_by_id($ccPayment->payee_id);
                            $payeeName = $vendor->display_name;

                            $amount = '$'.number_format($ccPayment->amount, 2, '.', ',');
                            $amount = str_replace('$-', '-$', $amount);

                            if($zip->locateName("Credit Card Payment/") === false) {
                                $zip->addEmptyDir("Credit Card Payment");
                            }

                            $folder = "Credit Card Payment/Credit Card Pmt $payeeName $amount";
                        break;
                        case 'Deposit' :
                            $deposit = $this->accounting_bank_deposit_model->getById($link->linked_id. logged('company_id'));

                            $amount = '$'.number_format($deposit->total_amount, 2, '.', ',');
                            $amount = str_replace('$-', '-$', $amount);

                            if($zip->locateName("Deposit/") === false) {
                                $zip->addEmptyDir("Deposit");
                            }

                            $folder = "Deposit/Deposit $amount";
                        break;
                        case 'Transfer' :
                            $transfer = $this->accounting_transfer_funds_model->getById($link->linked_id, logged('company_id'));

                            $amount = '$'.number_format($transfer->transfer_amount, 2, '.', ',');
                            $amount = str_replace('$-', '-$', $amount);

                            if($zip->locateName("Transfer/") === false) {
                                $zip->addEmptyDir("Transfer");
                            }

                            $folder = "Transfer/Transfer $amount";
                        break;
                        case 'Journal' :
                            $journal = $this->accounting_journal_entries_model->getById($link->linked_id, logged('company_id'));

                            if($zip->locateName("Journal/") === false) {
                                $zip->addEmptyDir("Journal");
                            }

                            if(!in_array($journal->journal_no, [null, '', '0'])) {
                                $folder = "Journal Entry/Journal #$journal->journal_no";
                            } else {
                                $folder = "Journal Entry/Journal";
                            }
                        break;
                    }

                    if($link->type !== 'Vendor') {
                        if($zip->locateName("$folder/") !== false) {
                            $folder = "$folder - 1";
                        }
                    }

                    $zip->addEmptyDir($folder);

                    $path = "$folder/$attachment->uploaded_name.$attachment->file_extension";
                    if($zip->locateName($path) !== false) {
                        $path = "$folder/$attachment->uploaded_name - 1.$attachment->file_extension";
                    }
                    $zip->addFile('./uploads/accounting/attachments/'.$attachment->stored_name, $path);
                }
            } else {
                $folder = '(Unattached documents)';

                $path = "$folder/$attachment->uploaded_name.$attachment->file_extension";
                if($zip->locateName($path) !== false) {
                    $path = "$folder/$attachment->uploaded_name - 1.$attachment->file_extension";
                }
                $zip->addFile('./uploads/accounting/attachments/'.$attachment->stored_name, $path);
            }
        }
        $zip->close();

        $file = "./uploads/accounting/attachments/$zipFile";

        header('Content-Type: application/zip');
        header('Content-Disposition: attachment; filename="archive.zip"');
        header('Content-Length: ' . filesize($file));
        header('Pragma: no-cache');
        header('Expires: 0');
        readfile($file);

        unlink('./uploads/accounting/attachments/'.$zipFile);
    }
}