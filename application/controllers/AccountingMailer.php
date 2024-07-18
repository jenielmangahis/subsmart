<?php

defined('BASEPATH') or exit('No direct script access allowed');

class AccountingMailer extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    private function sendEmail($emailTo, $emailCC, $emailSubject, $emailBody, $attachmentConfig = [])
    {
        $emailer = email__getInstance(['subject' => $emailSubject]);
        $emailer->addAddress($emailTo, $emailTo);
        $emailer->isHTML(true);
        $emailer->Body = $emailBody;
        $emailer->addCC($emailCC);
        $emailer->addBCC($emailCC);

        if ($attachmentConfig['customAttachmentNamePDF'] !== '') {
            if ($attachmentConfig['customAttachmentNamePDF'] !== '') {
                $emailer->addAttachment(FCPATH.'assets/pdf/accounting/'.$attachmentConfig['reportFilePathPDF'], preg_replace("/[^A-Za-z0-9_\-]/", '', $attachmentConfig['customAttachmentNamePDF']));
            } else {
                $emailer->addAttachment(FCPATH.'assets/pdf/accounting/'.$attachmentConfig['reportFilePathPDF']);
            }
        }

        if ($attachmentConfig['customAttachmentNameXLSX'] !== '') {
            if ($attachmentConfig['customAttachmentNameXLSX'] !== '') {
                $emailer->addAttachment(FCPATH.'assets/pdf/accounting/'.$attachmentConfig['reportFilePathXLSX'], preg_replace("/[^A-Za-z0-9_\-]/", '', $attachmentConfig['customAttachmentNameXLSX']));
            } else {
                $emailer->addAttachment(FCPATH.'assets/pdf/accounting/'.$attachmentConfig['reportFilePathXLSX']);
            }
        }

        $sendStatus = $emailer->Send();

        if ($sendStatus) {
            echo 'true';
        } else {
            echo 'false';
        }
    }

    public function emailReport($reportType)
    {
        // List of valid reports to request
        $accountingValidReports = array(
            "sales_tax_liability",
            "customer_contact_list",
            "vendor_contact_list",
            "audit_log_list",
            "expenses_by_vendor_summary",
            "inventory_valuation_summary",
            "customer_balance_summary",
            "physical_inventory_worksheet",
            "customer_balance_detail",
            "sales_by_customer_summary",
            "sales_by_customer_detail",
            "sales_by_customer_type_detail",
            "sales_by_product_service_detail",
            "vendor_balance_summary",
            "vendor_balance_detail",
            "purchases_by_vendor_detail",
            "purchases_by_product_service_detail",
            "inventory_valuation_detail",
            "estimates_by_customer",
            "invoice_list_by_date",
            "payment_method_list",
            "open_invoices",
            "product_service_list",
            "sales_by_product_service_summary",
            "taxable_sales_detail",
            "taxable_sales_summary",
            "income_by_customer_summary",
            "estimate_progress_invoicing",
            "terms_list",
            "statement_list",
            "bill_payment_list",
            "collections_report",
            "invoices_and_payments",
            "account_list",
            "employee_details",
            "accounts_receivable_aging_summary",
            "profit_and_loss_percentage_income",
            "balance_sheet",
            "balance_sheet_summary",
            "balance_sheet_details",
            "transaction_list_customer",
            "accounts_payable_aging_detail",
            "accounts_receivable_aging_detail_list",
            "accounts_payable_aging_summary",
            "accounts_payable_aging_detail_report",
            "balance_sheet_comparison",
            "deposit_detail",
            "check_detail",
            "unpaid_bills_summary",
            'transaction_list_by_tag_group',
            "contractor_balance_detail",
            "contractor_balance_summary",
            "recent_edited_time_activities",
            "open_purchase_order_list",
            "time_activities_by_employee_detail",
            "time_activities_by_customer_details",
            "transaction_list_by_vendor",
            "1099_transaction_detail",
            "bills_and_applied_payments",
            "open_purchase_order_details"
        );

        // Conditional Statements on the array
        if (in_array($reportType, $accountingValidReports)) {
            // Sending Report to email process
            $emailTo = $this->input->post('emailTo');
            $emailCC = $this->input->post('emailCC');
            $emailSubject = $this->input->post('emailSubject');
            $emailBody = $this->input->post('emailBody');
            $reportFilePath = $this->input->post('reportFilePath');
            $attachmentConfig = $this->input->post('attachmentConfig');
            $this->sendEmail($emailTo, $emailCC, $emailSubject, $emailBody, $attachmentConfig);
        } else {
            // If $reportType was not in the $accountingValidReports then return die() method
            exit('unable to send email report.');
        }
    }
}
