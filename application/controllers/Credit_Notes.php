<?php

defined('BASEPATH') or exit('No direct script access allowed');


class Credit_Notes extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->page_data['page']->title = 'Marketing';
        $this->page_data['page']->menu = 'credit_notes';
        $this->load->model('CreditNote_model');
        $this->load->model('CreditNoteItem_model');
        $this->load->model('Clients_model');

        $this->checkLogin();
        
        $user_id = getLoggedUserID();

        add_css(array(
            'https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css',
            'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css',
            'https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css',
			"assets/css/accounting/sidebar.css",
            "assets/css/accounting/sales.css",
        ));

        /*add_footer_js(array(
            'https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js',
            'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js',
            'https://code.jquery.com/ui/1.12.1/jquery-ui.js',
            'https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js',
            'assets/frontend/js/estimate/estimate.js',
        ));

        add_css(array(
            "assets/css/accounting/accounting.css",
            "assets/css/accounting/accounting.modal.css",
            "assets/css/accounting/sidebar.css",
            "assets/css/accounting/sales.css",
            "assets/plugins/dropzone/dist/dropzone.css",
            "assets/css/accounting/accounting-modal-forms.css",
            "assets/plugins/jquery-toast-plugin-master/dist/jquery.toast.min.css"
        ));*/

        add_footer_js(array(
            "assets/plugins/dropzone/dist/dropzone.js",
            "assets/js/accounting/sweetalert2@9.js",
            "assets/js/accounting/accounting.js",
            "assets/js/accounting/modal-forms.js",
            "assets/plugins/jquery-toast-plugin-master/dist/jquery.toast.min.js"
        ));

        $this->page_data['menu_name'] =
            array(
                array("Dashboard",  array()),
                array("Banking",    array('Link Bank','Rules','Receipts','Tags')),
                array("Expenses",   array('Expenses','Vendors')),
                array("Sales",      array('Overview','All Sales','Invoices','Customers','Deposits','Products and Services', 'Credit Notes')),
                array("Payroll",    array('Overview','Employees','Contractors',"Workers' Comp",'Benifits')),
                array("Reports",    array()),
                array("Taxes",      array("Sales Tax","Payroll Tax")),
                array("Mileage",    array()),
                array("Accounting", array("Chart of Accounts","Reconcile"))
            );
        $this->page_data['menu_link'] =
            array(
                array('/accounting/banking',array()),
                array("",   array('/accounting/link_bank','/accounting/rules','/accounting/receipts','/accounting/tags')),
                array("",   array('/accounting/expenses','/accounting/vendors')),
                array("",   array('/accounting/sales-overview','/accounting/all-sales','/accounting/invoices','/accounting/customers','/accounting/deposits','/accounting/products-and-services', 'credit_notes')),
                array("",   array('/accounting/payroll-overview','/accounting/employees','/accounting/contractors','/accounting/workers-comp','#')),
                array('/accounting/reports',array()),
                array("",   array('#','#')),
                array('#',  array()),
                array("",   array('/accounting/chart_of_accounts','/accounting/reconcile')),
            );

        $this->page_data['disable_accounting_modals'] = true;
        $this->page_data['menu_icon'] = array("fa-tachometer","fa-university","fa-credit-card","fa-money","fa-dollar","fa-bar-chart","fa-minus-circle","fa-file","fa-calculator");
    }

    public function index($tab = '')
    {

        $status = $this->CreditNote_model->optionStatus();

        $statusSummary = array();
        $company_id    = logged('company_id');
        $role = logged('role');
        $total_all = 0;
        if( $role == 1 || $role == 2 ){
            foreach($status as $key => $value){
                $total = $this->CreditNote_model->countAllByStatusAndCompanyId($key,$company_id);
                $total_all+= $total;
                $statusSummary[$key] = $total;
            }
            $this->page_data['total_all'] = $total_all;
            $this->page_data['statusSummary'] = $statusSummary;
            if( $tab > 0 ){
                $this->page_data['creditNotes'] = $this->CreditNote_model->getAllByCompanyIdAndStatus($company_id,$tab);
            }else{                            
                $cc = $this->CreditNote_model->getAllByCompanyId($company_id);
                $this->page_data['creditNotes'] = $this->CreditNote_model->getAllByCompanyId($company_id);
            }

        }else{
            foreach($status as $key => $value){
                $total = $this->CreditNote_model->countAllByStatusAndCompanyId($key,$company_id);
                $total_all+= $total;
                $statusSummary[$key] = $this->CreditNote_model->countAllByStatusAndCompanyId($key,$company_id);
            }

            $this->page_data['total_all'] = $total_all;
            $this->page_data['statusSummary'] = $statusSummary;
            if( $tab > 0 ){
                $this->page_data['creditNotes'] = $this->CreditNote_model->getAllByCompanyIdAndStatus($company_id,$tab);
            }else{
                $this->page_data['creditNotes'] = $this->CreditNote_model->getAllByCompanyId($company_id);
            }
        }

        $this->page_data['tab'] = $tab;
        $this->page_data['status'] = $status;
        $this->load->view('credit_notes/list', $this->page_data);
    }

    public function add_new()
    {
        $this->load->model('AcsProfile_model');

        $company_id = logged('company_id');
        $role = logged('role');
        $this->page_data['status'] = $this->CreditNote_model->optionStatus();
        $this->page_data['customers'] = $this->AcsProfile_model->getAllByCompanyId($company_id);

        $this->load->view('credit_notes/add', $this->page_data);
    }

    public function save()
    {
        postAllowed();

        $user_id = logged('id');
        $post    = $this->input->post();

        if( $post['customer_id'] > 0 && $post['job_name'] != '' ){
            $data = [
                'user_id' => $user_id,
                'customer_id' => $post['customer_id'],
                'job_name' => $post['job_name'],
                'credit_note_number' => $post['credit_note_number'],
                'date_issued' => date("Y-m-d",strtotime($post['date_issued'])),
                'expiry_date' => date("Y-m-d",strtotime($post['expiry_date'])),
                'adjustment_name' => $post['adjustment_name'],
                'adjustment_amount' => $post['adjustment_total'],
                'total_discount' => $post['total_discount'],
                'grand_total' => $post['total_due'],
                'note_customer' => $post['customer_message'],
                'terms_condition' => $post['terms_conditions'],
                'status' => $post['status'],
                'created' => date("Y-m-d H:i:s"),
                'modified' => date("Y-m-d H:i:s")
            ];

            $credit_note_id = $this->CreditNote_model->saveCreditNote($data);
            if( $credit_note_id > 0 ){
                foreach($post['itemIds'] as $key => $value){
                    $data = [
                        'credit_note_id' => $credit_note_id,
                        'item_id' => $value,
                        'item_type' => $post['item_type'][$key],
                        'qty' => $post['quantity'][$key],
                        'price' => $post['price'][$key],
                        'discount' => $post['discount'][$key],
                        'tax' => $post['tax'][$key],
                        'total' => $post['itemTotal'][$key]
                    ];

                    $this->CreditNoteItem_model->create($data);
                }

                customerAuditLog(logged('id'), $post['customer_id'], $credit_note_id, 'Credit Note', 'Created credit note #'.$post['credit_note_number']);

                $this->session->set_flashdata('message', 'Credit Note was successful saved');
                $this->session->set_flashdata('alert_class', 'alert-success');

            }else{
                $this->session->set_flashdata('message', 'Cannot save data. Please check your entries.');
                $this->session->set_flashdata('alert_class', 'alert-danger');
            }

        }else{
            $this->session->set_flashdata('message', 'Cannot save data. Please check your entries.');
            $this->session->set_flashdata('alert_class', 'alert-danger');
        }

        redirect('credit_notes');
    }

    public function  delete_credit_note()
    {
        postAllowed();

        $creditNote = $this->CreditNote_model->getById(post('eid'));
        if( $creditNote ){
            customerAuditLog(logged('id'), $creditNote->customer_id, $creditNote->id, 'Credit Note', 'Deleted credit note #'.$creditNote->credit_note_number);
            $id = $this->CreditNote_model->deleteCreditNote(post('eid'));
        }

        $this->session->set_flashdata('message', 'Credit Note has been Deleted Successfully');
        $this->session->set_flashdata('alert_class', 'alert-success');

        redirect('credit_notes');
    }

    public function edit($id)
    {
        $this->load->model('AcsProfile_model');

        $creditNote = $this->CreditNote_model->getById($id);

        if( $creditNote ){
            $creditNoteItems = $this->CreditNoteItem_model->getAllByCreditNoteId($creditNote->id);
            if( $role == 1 || $role == 2 ){
                $this->page_data['customers'] = $this->AcsProfile_model->getAll();
            }else{
                $this->page_data['customers'] = $this->AcsProfile_model->getAllByCompanyId($company_id);
            }

            $this->page_data['status'] = $this->CreditNote_model->optionStatus();
            $this->page_data['creditNote'] = $creditNote;
            $this->page_data['creditNoteItems'] = $creditNoteItems;

            $this->load->view('credit_notes/edit', $this->page_data);

        }else{
            $this->session->set_flashdata('message', 'Record not found.');
            $this->session->set_flashdata('alert_class', 'alert-danger');
            redirect('credit_notes');
        }
    }

    public function update()
    {
        postAllowed();

        $user_id = logged('id');
        $post    = $this->input->post();

        $creditNote = $this->CreditNote_model->getById($post['cid']);
        if( $creditNote ){
            $data = [
                'customer_id' => $post['customer_id'],
                'job_name' => $post['job_name'],
                'credit_note_number' => $post['credit_note_number'],
                'date_issued' => date("Y-m-d",strtotime($post['date_issued'])),
                'expiry_date' => date("Y-m-d",strtotime($post['expiry_date'])),
                'adjustment_name' => $post['adjustment_name'],
                'adjustment_amount' => $post['adjustment_total'],
                'total_discount' => $post['total_discount'],
                'grand_total' => $post['total_due'],
                'status' => $post['status'],
                'note_customer' => $post['customer_message'],
                'terms_condition' => $post['terms_conditions'],
                'modified' => date("Y-m-d H:i:s")
            ];

            $this->CreditNote_model->update($creditNote->id, $data);
            $this->CreditNoteItem_model->deleteAllByCreditNoteId($creditNote->id);

            foreach($post['itemIds'] as $key => $value){
                $data = [
                    'credit_note_id' => $creditNote->id,
                    'item_id' => $value,
                    'item_type' => $post['item_type'][$key],
                    'qty' => $post['quantity'][$key],
                    'price' => $post['price'][$key],
                    'discount' => $post['discount'][$key],
                    'tax' => $post['tax'][$key],
                    'total' => $post['itemTotal'][$key]
                ];

                $this->CreditNoteItem_model->create($data);
            }

            customerAuditLog(logged('id'), $creditNote->customer_id, $creditNote->id, 'Credit Note', 'Updated credit note #'.$creditNote->credit_note_number);

            $this->session->set_flashdata('message', 'Credit Note was successful saved');
            $this->session->set_flashdata('alert_class', 'alert-success');

        }else{
            $this->session->set_flashdata('message', 'Cannot find data');
            $this->session->set_flashdata('alert_class', 'alert-danger');
        }

        redirect('credit_notes');
    }

    public function view($id)
    {
        $this->load->model('AcsProfile_model');

        $creditNote = $this->CreditNote_model->getById($id);
        $company_id = logged('company_id');

        if( $creditNote ){
            $customer = $this->AcsProfile_model->getByProfId($creditNote->customer_id);
            $client   = $this->Clients_model->getById($company_id);
            $creditNoteItems = $this->CreditNoteItem_model->getAllByCreditNoteId($creditNote->id);

            $this->page_data['status'] = $this->CreditNote_model->optionStatus();
            $this->page_data['customer'] = $customer;
            $this->page_data['client'] = $client;
            $this->page_data['creditNote'] = $creditNote;
            $this->page_data['creditNoteItems'] = $creditNoteItems;

            $this->load->view('credit_notes/view', $this->page_data);

        }else{
            $this->session->set_flashdata('message', 'Record not found.');
            $this->session->set_flashdata('alert_class', 'alert-danger');
            redirect('credit_notes');
        }
    }

    public function send_mail_credit_note_customer()
    {
        include APPPATH . 'libraries/PHPMailer/PHPMailerAutoload.php';

        $this->load->helper(array('url', 'hashids_helper'));

        $this->load->model('AcsProfile_model');

        $post     = $this->input->post();
        $creditNote = $this->CreditNote_model->getById($post['cnid']);

        if( $creditNote ){
            $eid = hashids_encrypt($estimate->id, '', 15);
            $url = base_url('/estimate_customer_view/' . $eid);
            $customer = $this->AcsProfile_model->getByProfId($estimate->customer_id);

            $subject = "NsmarTrac : Estimate";
            $msg = "<p>Hi " . $customer->first_name . ",</p>";
            $msg .= "<p>Please check the estimate for your approval.</p>";
            $msg .= "<p>Click <a href='".$url."'>Your Estimate</a> to view and approve estimate.</p><br />";
            $msg .= "<p>Thank you <br /><br /> NsmarTrac Team</p>";

            //Email Sending
            $from      = 'webmaster@ficoheroes.com';
            $recipient = $customer->email;
            $mail = new PHPMailer;
            $mail->SMTPDebug = 4;
            //$mail->isSMTP();
            $mail->From = $from;
            $mail->FromName = 'NsmarTrac';
            $mail->addAddress($recipient, $recipient);
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $msg;
            if(!$mail->Send()) {
                $this->session->set_flashdata('alert-type', 'danger');
                $this->session->set_flashdata('alert', 'Cannot send email.');
            }else {
                $this->estimate_model->update($estimate->id, ['status' => 'Submitted']);

                customerAuditLog(logged('id'), $creditNote->customer_id, $creditNote->id, 'Credit Note', 'Sent to email credit note #'.$creditNote->credit_note_number);

                $this->session->set_flashdata('alert-type', 'success');
                $this->session->set_flashdata('alert', 'Your credit note was successfully sent');
            }
        }else{
            $this->session->set_flashdata('alert-type', 'danger');
            $this->session->set_flashdata('alert', 'Cannot find credit note');
        }

        redirect('credit_notes');
    }

    public function send_customer($id)
    {
        $this->load->helper(array('url', 'hashids_helper'));

        $this->load->model('AcsProfile_model');

        $company_id = logged('company_id');

        $creditNote = $this->CreditNote_model->getById($id);
        $client     = $this->Clients_model->getById($company_id);

        if( $creditNote ){
            if( $role == 1 || $role == 2 ){
                $this->page_data['customers'] = $this->AcsProfile_model->getAllByCompanyId($company_id);
            }else{
                $this->page_data['customers'] = $this->AcsProfile_model->getAll();
            }

            $eid = hashids_encrypt($creditNote->id, '', 15);
            $url = base_url('/credit_note_customer_view/' . $eid);

            $this->page_data['customer_url'] = $url;
            $this->page_data['client'] = $client;
            $this->page_data['creditNote'] = $creditNote;
            $this->load->view('credit_notes/send_customer', $this->page_data);

        }else{
            $this->session->set_flashdata('message', 'Record not found.');
            $this->session->set_flashdata('alert_class', 'alert-danger');
            redirect('credit_notes');
        }
    }

    public function send_mail()
    {
        include APPPATH . 'libraries/PHPMailer/PHPMailerAutoload.php';

        $this->load->helper(array('url', 'hashids_helper'));
        $this->load->model('AcsProfile_model');

        $post = $this->input->post();

        if( count($post['customer_id']) > 0 && $post['mail_subject'] != '' && $post['mail_body'] != '' ){
            $creditNote = $this->CreditNote_model->getById($post['cid']);

            //Email Sending
            $server    = MAIL_SERVER;
            $port      = MAIL_PORT ;
            $username  = MAIL_USERNAME;
            $password  = MAIL_PASSWORD;
            $from      = MAIL_FROM;
            $recipient = $post['customer_id'];
            $subject   = $post['mail_subject'];
            $eid = hashids_encrypt($creditNote->id, '', 15);
            $url       = base_url('/tracker/imageTracker?id=' . $eid);
            //$url       = 'https://nsmartrac.com/tracker/imageTracker?id=' . $eid;
            $msg       = $post['mail_body'];
            $msg       = $msg . "<br />" . '<img src="'.$url.'"/>';

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

            //$mail->addAddress('bryann.revina03@gmail.com', 'bryann.revina03@gmail.com');
            foreach( $post['customer_id'] as $value ){
                $mail->addAddress($value, $value);
            }
            if( isset($post['email_bcc']) ){
               if( count($post['email_bcc']) > 0 ){
                    $bcc = implode(",", $post['email_bcc']);
                    $mail->addBcc($bcc);
                }
            }

            if( isset($post['email_cc']) ){
                if( count($post['email_cc']) > 0 ){
                    $cc = implode(",", $post['email_cc']);
                    $mail->addCC($cc);
                }
            }

            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $msg;

            if(!$mail->Send()) {
                $this->session->set_flashdata('alert-type', 'danger');
                $this->session->set_flashdata('alert', 'Cannot send email.');
            }else {
                $this->CreditNote_model->update($creditNote->id, ['status' => $this->CreditNote_model->isSubmitted()]);
                customerAuditLog(logged('id'), $creditNote->customer_id, $creditNote->id, 'Credit Note', 'Sent to email credit note #'.$creditNote->credit_note_number);

                $this->session->set_flashdata('alert-type', 'success');
                $this->session->set_flashdata('alert', 'Your credit note was successfully sent');
            }
        }else{
            $this->session->set_flashdata('alert-type', 'danger');
            $this->session->set_flashdata('alert', 'Cannot send email');
        }

        redirect('credit_notes');
    }

    public function pdf_credit_note($id)
    {

        $creditNote = $this->CreditNote_model->getById($id);


        if( $creditNote ){

            $this->load->helper('pdf_helper');
            $this->load->model('AcsProfile_model');

            $company_id = $creditNote->company_id;
            $customer = $this->AcsProfile_model->getByProfId($creditNote->customer_id);
            $client   = $this->Clients_model->getById($company_id);
            $creditNoteItems = $this->CreditNoteItem_model->getAllByCreditNoteId($creditNote->id);

            $html = '
            <table>
                <tr>
                    <td>
                        <h5 style="font-size:12px;"><span class="fa fa-user-o"></span> From <br/><span>'.$client->business_name.'</span></h5>
                        <br />
                        <span class="">'.$client->business_address.'</span><br />
                        <span class="">EMAIL: '.$client->email_address.'</span><br />
                        <span class="">PHONE: '.$client->phone_number.'</span>
                        <br/><br /><br />
                        <h5 style="font-size:12px;"><span class="fa fa-user-o"></span> To <br/><span>'.$customer->first_name . ' ' .$customer->last_name.'</span></h5>
                        <br />
                        <span class="">'.$customer->mail_add. " " .$customer->city.'</span><br />
                        <span class="">EMAIL: '.$customer->email.'</span><br />
                        <span class="">PHONE: '.$customer->phone_w.'</span>
                    </td>
                    <td colspan=1></td>
                    <td style="text-align:right;">
                        <h5 style="font-size:20px;margin:0px;">CREDIT NOTE <br /><small style="font-size: 10px;">#'.$creditNote->credit_note_number.'</small></h5>
                        <br />
                        <table>
                          <tr>
                            <td>Date Issued :</td>
                            <td>'.date("Y-m-d",strtotime($creditNote->date_issued)).'</td>
                          </tr>
                          <tr>
                            <td>Expire Due :</td>
                            <td>'.date("Y-m-d",strtotime($creditNote->expiry_date)).'</td>
                          </tr>
                          <tr>
                            <td><b>Credits Remaining :</b></td>
                            <td><b>'.$creditNote->grand_total.'</b></td>
                          </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <br /><br /><br />

            <table style="width="100%;>
            <thead>
                <tr>
                    <th style="width:5%;"><b>#</b></th>
                    <th><b>Items</b></th>
                    <th style="text-align: right;"><b>Qty</b></th>
                    <th style="text-align: right;"><b>Discount</b></th>
                    <th style="text-align: right;"><b>Tax</b></th>
                    <th style="text-align: right;"><b>Total</b></th>
                </tr>
            </thead>
            <tbody>';
            $total_tax = 0;
            $row = 1;
            foreach($creditNoteItems as $item){
                $html .= '<tr>
                    <td valign="top" style="width:5%;">'.$row.'</td>
                    <td valign="top" style="">'.$item->title.'</td>
                    <td valign="top" style="text-align: right;">'.$item->qty.'</td>
                    <td valign="top" style="text-align: right;">'.number_format($item->discount,2).'</td>
                    <td valign="top" style="text-align: right;">'.number_format($item->tax,2).'</td>
                    <td valign="top" style="text-align: right;">'.number_format($item->total,2).'</td>
                  </tr>
                ';
                $total_tax += $item->tax;
                $row++;
            }

            $html .= '<tr><td colspan="6"><hr/></td></tr>
            <tr>
              <td colspan="5" style="text-align: right;">Taxes</td>
              <td style="text-align: right;">$'.number_format($total_tax, 2).'</td>
            </tr>';

            if( $creditNote->adjustment_amount > 0 ){
                $html .= '
                <tr>
                  <td colspan="5" style="text-align: right;">'.$creditNote->adjustment_name.'</td>
                  <td style="text-align: right;">$'.number_format($creditNote->adjustment_amount, 2).'</td>
                </tr>';
            }

            $html .= '<tr>
              <td colspan="5" style="text-align: right;"><b>Grand Total</b></td>
              <td style="text-align: right;"><b>$'.number_format($creditNote->grand_total, 2).'</b></td>
            </tr>
          </tbody>
          </table>
          <br /><br /><br />
          <p><b>Message</b><br /><br />'.$creditNote->note_customer.'</p>
          <p><b>Terms</b><br /><Br />'.$creditNote->terms_condition.'</p>
            ';

            tcpdf();
            $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
            $title = "Credit Note";
            $obj_pdf->SetTitle($title);
            $obj_pdf->setPrintHeader(false);
            $obj_pdf->setPrintFooter(false);
            $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
            $obj_pdf->SetDefaultMonospacedFont('helvetica');
            $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
            $obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
            $obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
            $obj_pdf->SetFont('helvetica', '', 9);
            $obj_pdf->setFontSubsetting(false);
            $obj_pdf->AddPage();
            ob_end_clean();
            $obj_pdf->writeHTML($html, true, false, true, false, '');
            $obj_pdf->Output('credit_note.pdf', 'I');

        }else{
            $this->session->set_flashdata('message', 'Record not found.');
            $this->session->set_flashdata('alert_class', 'alert-danger');
            redirect('credit_notes');
        }
    }

    public function close_credit_note()
    {
        $post = $this->input->post();
        $id   = $post['ceid'];

        $creditNote = $this->CreditNote_model->getById($id);
        if( $creditNote ){
            $data = [
                'status' => $this->CreditNote_model->isClosed(),
                'modified' => date("Y-m-d H:i:s")
            ];

            $this->CreditNote_model->update($creditNote->id, $data);

            customerAuditLog(logged('id'), $creditNote->customer_id, $creditNote->id, 'Credit Note', 'Updated credit note #'.$creditNote->credit_note_number.' set status to Closed');

            $this->session->set_flashdata('message', 'Credit Note was successful updated');
            $this->session->set_flashdata('alert_class', 'alert-success');

        }else{
            $this->session->set_flashdata('message', 'Record not found.');
            $this->session->set_flashdata('alert_class', 'alert-danger');
        }

        redirect('credit_notes');
    }

    public function print_credit_note($id)
    {
        $this->load->model('AcsProfile_model');

        $creditNote = $this->CreditNote_model->getById($id);
        $company_id = logged('company_id');

        if( $creditNote ){
            $customer = $this->AcsProfile_model->getByProfId($creditNote->customer_id);
            $client   = $this->Clients_model->getById($company_id);
            $creditNoteItems = $this->CreditNoteItem_model->getAllByCreditNoteId($creditNote->id);

            $this->page_data['status'] = $this->CreditNote_model->optionStatus();
            $this->page_data['customer'] = $customer;
            $this->page_data['client'] = $client;
            $this->page_data['creditNote'] = $creditNote;
            $this->page_data['creditNoteItems'] = $creditNoteItems;

            $this->load->view('credit_notes/print_credit_note', $this->page_data);

        }else{
            $this->session->set_flashdata('message', 'Record not found.');
            $this->session->set_flashdata('alert_class', 'alert-danger');
            redirect('credit_notes');
        }
    }

    public function clone_credit_note()
    {
        $this->load->model('AcsProfile_model');

        $post = $this->input->post();
        $id   = $post['cloneid'];
        $creditNote = $this->CreditNote_model->getById($id);

        if( $creditNote ){
            $creditNoteItems = $this->CreditNoteItem_model->getAllByCreditNoteId($creditNote->id);

            //Duplicate
            $data_credit_note = (array) $creditNote;
            unset($data_credit_note['id']);
            unset($data_credit_note['uid']);
            unset($data_credit_note['company_id']);

            $credit_note_id = $this->CreditNote_model->saveCreditNote($data_credit_note);
            if( $credit_note_id > 0 ){
                foreach($creditNoteItems as $key => $values){
                    $data_credit_note_items = (array) $values;
                    $data_credit_note_items['credit_note_id'] = $credit_note_id;
                    unset($data_credit_note_items['id']);
                    unset($data_credit_note_items['title']);
                    unset($data_credit_note_items['description']);

                    $this->CreditNoteItem_model->create($data_credit_note_items);
                }

                customerAuditLog(logged('id'), $creditNote->customer_id, $creditNote->id, 'Credit Note', 'Cloned credit note #'.$creditNote->credit_note_number);

                $this->session->set_flashdata('message', 'Credit Note was successful clone');
                $this->session->set_flashdata('alert_class', 'alert-success');

                redirect('credit_notes/edit/' . $credit_note_id);
            }else{
                redirect('credit_notes');
            }

        }else{
            $this->session->set_flashdata('message', 'Record not found.');
            $this->session->set_flashdata('alert_class', 'alert-danger');
            redirect('credit_notes');
        }
    }

    public function credit_note_settings()
    {
        $this->load->model('CreditNoteSettings_model');

        $company_id = logged('company_id');
        $settings   = $this->CreditNoteSettings_model->getByCompanyId($company_id);

        if( empty($settings) ){
            $data_settings = [
                'company_id' => $company_id,
                'credit_note_number_prefix' => 'CN',
                'credit_note_number_next_number' => 1,
                'default_message' => '',
                'default_terms_conditions' => '',
                'modified' => date("Y-m-d H:i:s")
            ];

            $settings_id = $this->CreditNoteSettings_model->create($data_settings);
            $settings    = $this->CreditNoteSettings_model->getById($settings_id);
        }

        $this->page_data['settings'] = $settings;
        $this->load->view('credit_notes/settings', $this->page_data);
    }

    public function ajax_update_credit_note_settings()
    {
        $this->load->model('CreditNoteSettings_model');

        $is_success = false;
        $post       = $this->input->post();

        $company_id = logged('company_id');
        $settings   = $this->CreditNoteSettings_model->getByCompanyId($company_id);
        if( $settings ){
            $data_settings = [
                'credit_note_number_prefix' => $post['credit_note_number_prefix'],
                'credit_note_number_next_number' => $post['credit_note_number_next_number'],
                'default_message' => $post['credit_note_message'],
                'default_terms_conditions' => $post['credit_note_terms'],
                'modified' => date("Y-m-d H:i:s")
            ];

            $this->CreditNoteSettings_model->update($settings->id, $data_settings);

            $is_success = true;
        }

        $json_data = ['is_success' => $is_success];
        echo json_encode($json_data);
    }
}
