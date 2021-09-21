<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Public_view_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('accounting_invoices_model');
        $this->load->model('accounting_customers_model');
    }
    public function view_invoice($token="")
    {
        if ($token!="") {
            $shared_invoice = $this->accounting_invoices_model->get_shared_invoice_link($token);
            if ($shared_invoice!=null) {
                $inv = $this->accounting_invoices_model->get_invoice_by_invoice_id($shared_invoice->invoice_id);
                $customer_id = $inv->customer_id;
                $customer_info = $this->accounting_customers_model->get_customer_by_id($customer_id);
                
                
                $receivable_payment = 0;
                $total_amount_received =0;
                if (is_numeric($inv->grand_total)) {
                    $receivable_payment=$inv->grand_total;
                }
                $receive_payment=$this->accounting_invoices_model->get_payements_by_invoice($inv->id);
                foreach ($receive_payment as $payment) {
                    $total_amount_received += $payment->payment_amount;
                }
    
                $balance=$receivable_payment-$total_amount_received;
                foreach ($receive_payment as $payment) {
                    $total_amount_received += $payment->payment_amount;
                    $amount_received=$payment->payment_amount;
                }
                if (date("Y-m-d", strtotime($inv->due_date)) <= date("Y-m-d") && $balance > 0) {
                    $status="Overdue";
                } else {
                    if ($balance <= 0) {
                        $status="Paid";
                    } else {
                        $status="Open";
                    }
                }
                $this->page_data['date']=$inv->date_issued;
                $this->page_data['no']=$inv->invoice_number;
                $this->page_data['duedate']=$inv->due_date;
                $this->page_data['balance']=$balance;
                $this->page_data['invoice_amount']=$receivable_payment;
                $this->page_data['last_delivered']="";
                $this->page_data['email']=$inv->customer_email;
                $this->page_data['atatchement']="";
                $this->page_data['status']=$status;
                $this->page_data['customer_info'] =$customer_info;
                $this->page_data['pdf_file'] =$token."_portalappinv.pdf";
                $this->load->view('accounting/customer_includes/public_view/shared_invoice_link', $this->page_data);
            } else {
                redirect(base_url());
            }
        } else {
            redirect(base_url());
        }
    }
}
