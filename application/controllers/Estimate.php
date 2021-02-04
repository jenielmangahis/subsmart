<?php

defined('BASEPATH') or exit('No direct script access allowed');


class Estimate extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->page_data['page']->title = 'My Estimates';
        $this->page_data['page']->menu = 'estimates';
        $this->load->model('Estimate_model', 'estimate_model');
        $this->load->model('Jobs_model', 'jobs_model');

        $this->checkLogin();

        $user_id = getLoggedUserID();

        add_css(array(
            'https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css',
            'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css',
            'https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css',
			"assets/css/accounting/sidebar.css",
        ));

        add_footer_js(array(
            'https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js',
            'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js',
            'https://code.jquery.com/ui/1.12.1/jquery-ui.js',
            'https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js',
            'assets/frontend/js/estimate/estimate.js',
        ));
    }

    public function index($tab = '')
    {
        $is_allowed = $this->isAllowedModuleAccess(18);
        if( !$is_allowed ){
            $this->page_data['module'] = 'estimate';
            echo $this->load->view('no_access_module', $this->page_data, true);
            die();
        }
        $role = logged('role');
        if ($role == 2 || $role == 3 || $role == 1) {
            $this->page_data['jobs'] = $this->jobs_model->getByWhere([]);
        }else{
            $company_id = logged('company_id');
            $this->page_data['jobs'] = $this->jobs_model->getByWhere(['company_id' => $company_id]);   
        }
            
        if (!empty($tab)) {
            $query_tab = $tab;
            if( $tab == 'declined%20by%20customer' ){
                $query_tab = 'Declined By Customer';
            }
            $this->page_data['tab'] = $tab;
            $this->page_data['estimates'] = $this->estimate_model->filterBy(array('status' => lcfirst($query_tab)), $company_id, $role);
        } else {

            // search
            if (!empty(get('search'))) {

                $this->page_data['search'] = get('search');
                $this->page_data['estimates'] = $this->estimate_model->filterBy(array('search' => get('search')), $company_id, $role);
            } elseif (!empty(get('order'))) {

                $this->page_data['search'] = get('search');
                $this->page_data['estimates'] = $this->estimate_model->filterBy(array('order' => get('order')), $company_id, $role);

            } else {
                if( $role == 1 || $role == 2 ){
                    $this->page_data['estimates'] = $this->estimate_model->getAllEstimates();
                }else{
                    $this->page_data['estimates'] = $this->estimate_model->getAllByCompany($company_id);
                }
            }
        }

        $this->page_data['role'] = $role;
        $this->page_data['estimateStatusFilters'] = $this->estimate_model->getStatusWithCount($company_id);
        

        /*if ($role == 4) {

            if (!empty($tab)) {

                $this->page_data['tab'] = $tab;
                $this->page_data['estimates'] = $this->estimate_model->filterBy(array('status' => $tab));


            } elseif (!empty(get('order'))) {

                $this->page_data['order'] = get('order');
                $this->page_data['estimates'] = $this->workorder_model->filterBy(array('order' => get('order')), $company_id);

            } else {

                if (!empty(get('search'))) {

                    $this->page_data['search'] = get('search');
                    $this->page_data['estimates'] = $this->workorder_model->filterBy(array('search' => get('search')), $company_id);
                } else {
                    $this->page_data['estimates'] = $this->estimate_model->getAllByUserId();
                }
            }

            $this->page_data['estimateStatusFilters'] = $this->estimate_model->getStatusWithCount();
        }*/

        $this->load->view('estimate/list', $this->page_data);
    }


    public function add()
    {   
        $this->load->model('AcsProfile_model');

        $query_autoincrment = $this->db->query("SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE table_name = 'customer_groups'");
        $result_autoincrement = $query_autoincrment->result_array();

        if(count( $result_autoincrement )) {
            if($result_autoincrement[0]['AUTO_INCREMENT'])
            {
                $this->page_data['auto_increment_estimate_id'] = 1;    
            } else {
                
                $this->page_data['auto_increment_estimate_id'] = $result_autoincrement[0]['AUTO_INCREMENT'];
            }
        } else {
            $this->page_data['auto_increment_estimate_id'] = 0;        
        }

        $user_id = logged('id');
        // $parent_id = $this->db->query("select parent_id from users where id=$user_id")->row();

        // if ($parent_id->parent_id == 1) { // ****** if user is company ******//
        //     $this->page_data['users'] = $this->users_model->getAllUsersByCompany($user_id);
        // } else {
        //     $this->page_data['users'] = $this->users_model->getAllUsersByCompany($parent_id->parent_id, $user_id);
        // }

        $company_id = logged('company_id');
        $role = logged('role');
        // $this->page_data['workstatus'] = $this->Workstatus_model->getByWhere(['company_id'=>$company_id]);
        if( $role == 1 || $role == 2 ){
            $this->page_data['customers'] = $this->AcsProfile_model->getAllByCompanyId($company_id);
        }else{
            $this->page_data['customers'] = $this->AcsProfile_model->getAll();    
        }
        $type = $this->input->get('type');
        $this->page_data['type'] = $type;
        $this->page_data['plans'] = $this->plans_model->getByWhere(['company_id' => $company_id]);

        // $this->page_data['file_selection'] = $this->load->view('modals/file_vault_selection', array(), TRUE);
        $this->load->view('estimate/add', $this->page_data);
    }


    public function save()
    {

        postAllowed();

        // echo '<pre>'; print_r($this->input->post()); die;

        $user = (object)$this->session->userdata('logged');

        if (count(post('item')) > 0) {

            $items = post('item');
            $quantity = post('quantity');
            $price = post('price');
            $discount = post('discount');
            $type = post('item_type');
            $location = post('location');

            foreach (post('item') as $key => $val) {

                $itemArray[] = array(

                    'item' => $items[$key],
                    'item_type' => $type[$key],
                    'quantity' => $quantity[$key],
                    'location' => $location[$key],
                    'discount' => $discount[$key],
                    'price' => $price[$key]
                );
            }

            $estimate_items = serialize($itemArray);
        } else {

            $estimate_items = '';
        }

        $eqpt_cost = array(

            'eqpt_cost' => post('eqpt_cost') ? post('eqpt_cost') : 0,
            'sales_tax' => post('sales_tax') ? post('sales_tax') : 0,
            'inst_cost' => post('inst_cost') ? post('inst_cost') : 0,
            'one_time' => post('one_time') ? post('one_time') : 0,
            'm_monitoring' => post('m_monitoring') ? post('m_monitoring') : 0
        );

        //echo '<pre>';print_r($data);die;

        $company_id = logged('company_id');

        $id = $this->estimate_model->create([

            'user_id' => $user->id,
            'company_id' => $company_id,
            'customer_id' => post('customer_id'),
            'job_location' => post('job_location'),
            'job_name' => post('job_name'),
            'estimate_date' => date('Y-m-d', strtotime(post('estimate_date'))),
            'expiry_date' => date('Y-m-d', strtotime(post('expiry_date'))),
            'purchase_order_number' => post('purchase_order_number'),
            'plan_id' => post('plan_id'),
            'estimate_items' => $estimate_items,
            'estimate_eqpt_cost' => serialize($eqpt_cost),
            'estimate_number' => post('estimate_number'),
            'deposit_request' => post('deposit_request'),
            'customer_message' => post('customer_message'),
            'terms_conditions' => post('terms_conditions'),
            'instructions' => post('instructions'),
        ]);

        $this->activity_model->add('New User $' . $user->id . ' Created by User:' . logged('name'), logged('id'));
        $this->session->set_flashdata('alert-type', 'success');
        $this->session->set_flashdata('alert', 'New Estimate Created Successfully');

        redirect('estimate');

    }


    public function edit($id)
    {
        $this->load->model('AcsProfile_model');

        $company_id = logged('company_id');
        $user_id = logged('id');
        $role    = logged('role');
        //$parent_id = $this->db->query("select parent_id from users where id=$user_id")->row();

        if ($role == 1 || $role == 2) {
            $this->page_data['users'] = $this->users_model->getAllUsers();
            $this->page_data['customers'] = $this->AcsProfile_model->getAll();  
        } else {
            $this->page_data['users'] = $this->users_model->getAllUsersByCompany($user_id);
            $this->page_data['customers'] = $this->AcsProfile_model->getAllByCompanyId($company_id);
        }


        $this->load->model('Customer_model', 'customer_model');

        $this->page_data['estimate'] = $this->estimate_model->getById($id);
        $this->page_data['estimate']->customer = $this->customer_model->getCustomer($this->page_data['estimate']->customer_id);
        $this->page_data['plans'] = $this->plans_model->getByWhere(['company_id' => $company_id]);
        $this->load->view('estimate/edit', $this->page_data);
    }


    public function update($id)
    {

        postAllowed();

        // echo '<pre>'; print_r($this->input->post()); die;

        $user = (object)$this->session->userdata('logged');

        if (count(post('item')) > 0) {

            $items = post('item');
            $quantity = post('quantity');
            $price = post('price');
            $discount = post('discount');
            $type = post('item_type');
            $location = post('location');

            foreach (post('item') as $key => $val) {

                $itemArray[] = array(

                    'item' => $items[$key],
                    'item_type' => $type[$key],
                    'quantity' => $quantity[$key],
                    'location' => $location[$key],
                    'discount' => $discount[$key],
                    'price' => $price[$key]
                );
            }

            $estimate_items = serialize($itemArray);
        } else {

            $estimate_items = '';
        }

        $eqpt_cost = array(

            'eqpt_cost' => post('eqpt_cost') ? post('eqpt_cost') : 0,
            'sales_tax' => post('sales_tax') ? post('sales_tax') : 0,
            'inst_cost' => post('inst_cost') ? post('inst_cost') : 0,
            'one_time' => post('one_time') ? post('one_time') : 0,
            'm_monitoring' => post('m_monitoring') ? post('m_monitoring') : 0
        );

        //echo '<pre>';print_r($data);die;

        $company_id = logged('company_id');

        $id = $this->estimate_model->update($id, [

            'user_id' => $user->id,
            'company_id' => $company_id,
            'customer_id' => post('customer_id'),
            'job_location' => post('job_location'),
            'job_name' => post('job_name'),
            'estimate_date' => date('Y-m-d', strtotime(post('estimate_date'))),
            'expiry_date' => date('Y-m-d', strtotime(post('expiry_date'))),
            'purchase_order_number' => post('purchase_order_number'),
            'plan_id' => post('plan_id'),
            'estimate_items' => $estimate_items,
            'estimate_eqpt_cost' => serialize($eqpt_cost),
            'deposit_request' => post('deposit_request'),
            'estimate_number' => post('estimate_number'),
            'customer_message' => post('customer_message'),
            'terms_conditions' => post('terms_conditions'),
            'instructions' => post('instructions'),
        ]);

        $this->activity_model->add('New User $' . $user->id . ' Created by User:' . logged('name'), logged('id'));
        $this->session->set_flashdata('alert-type', 'success');
        $this->session->set_flashdata('alert', 'Estimate has been Updated Successfully');

        redirect('estimate');
    }


    public function tab($index)
    {

        $this->index($index);
    }



    public function print($tab = '')
    {
        $role = logged('role');
        if ($role == 2 || $role == 3) {
            $company_id = logged('company_id');

            if (!empty($tab)) {
                $this->page_data['tab'] = $tab;
                $this->page_data['estimates'] = $this->estimate_model->filterBy(array('status' => $tab), $company_id);
            } else {

                // search
                if (!empty(get('search'))) {

                    $this->page_data['search'] = get('search');
                    $this->page_data['estimates'] = $this->estimate_model->filterBy(array('search' => get('search')), $company_id);
                } elseif (!empty(get('order'))) {

                    $this->page_data['search'] = get('search');
                    $this->page_data['estimates'] = $this->estimate_model->filterBy(array('order' => get('order')), $company_id);

                } else {
                    $this->page_data['estimates'] = $this->estimate_model->getAllByCompany($company_id);
                }
            }

            $this->page_data['estimateStatusFilters'] = $this->estimate_model->getStatusWithCount($company_id);
        }

        if ($role == 4) {

            if (!empty($tab)) {

                $this->page_data['tab'] = $tab;
                $this->page_data['estimates'] = $this->estimate_model->filterBy(array('status' => $tab));


            } elseif (!empty(get('order'))) {

                $this->page_data['order'] = get('order');
                $this->page_data['estimates'] = $this->workorder_model->filterBy(array('order' => get('order')), $company_id);

            } else {

                if (!empty(get('search'))) {

                    $this->page_data['search'] = get('search');
                    $this->page_data['estimates'] = $this->workorder_model->filterBy(array('search' => get('search')), $company_id);
                } else {
                    $this->page_data['estimates'] = $this->estimate_model->getAllByUserId();
                }
            }

            $this->page_data['estimateStatusFilters'] = $this->estimate_model->getStatusWithCount();
        }

        $this->load->view('estimate/print/list', $this->page_data);
    }

    public function send_mail_estimate_customer()
    {
        include APPPATH . 'libraries/PHPMailer/PHPMailerAutoload.php';

        $this->load->helper(array('url', 'hashids_helper'));

        $this->load->model('AcsProfile_model');

        $post     = $this->input->post();
        $estimate = $this->estimate_model->getEstimate($post['eid']);

        if( $estimate ){
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

                $this->session->set_flashdata('alert-type', 'success');
                $this->session->set_flashdata('alert', 'Your estimate was successfully sent');
            }
        }else{
            $this->session->set_flashdata('alert-type', 'danger');
            $this->session->set_flashdata('alert', 'Cannot find estimate');
        }

        redirect('estimate');
    }

    public function ajax_load_scheduled_estimates()
    {
        $role    = logged('role');
        $user_id = getLoggedUserID();

        if( $role == 1 || $role == 2 ){
            $scheduledEstimates = $this->estimate_model->getAllPendingEstimates();
        }else{
            $scheduledEstimates = $this->estimate_model->getAllPendingEstimatesByUserId($user_id);
        }

        $this->page_data['scheduledEstimates'] = $scheduledEstimates;
        $this->load->view('estimate/ajax_load_scheduled_estimates', $this->page_data);

    }

    public function view($id)
    {
        $this->load->model('AcsProfile_model');
        $this->load->model('EstimateItem_model');
        $this->load->model('Clients_model');
        
        $estimate = $this->estimate_model->getById($id);
        $company_id = logged('company_id');

        if( $estimate ){
            $customer = $this->AcsProfile_model->getByProfId($estimate->customer_id);
            $client   = $this->Clients_model->getById($company_id);

            $this->page_data['customer'] = $customer;
            $this->page_data['client'] = $client;
            $this->page_data['estimate'] = $estimate;

            $this->load->view('estimate/view', $this->page_data);

        }else{
            $this->session->set_flashdata('message', 'Record not found.');
            $this->session->set_flashdata('alert_class', 'alert-danger');
            redirect('estimate');
        }
    }

    public function pdf_estimate($id)
    {        

        $estimate = $this->estimate_model->getById($id);
        if( $estimate ){
            
            $this->load->helper('pdf_helper');
            $this->load->model('AcsProfile_model');
            $this->load->model('Clients_model');

            $company_id = $estimate->company_id;
            $customer = $this->AcsProfile_model->getByProfId($estimate->customer_id);
            $client   = $this->Clients_model->getById($company_id);
            $estimateItems = unserialize($estimate->estimate_items);

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
                        <h5 style="font-size:20px;margin:0px;">ESTIMATE <br /><small style="font-size: 10px;">#'.$estimate->estimate_number.'</small></h5>
                        <br />
                        <table>
                          <tr>
                            <td>Estimate Date :</td>
                            <td>'.date("F d, Y",strtotime($estimate->estimate_date)).'</td>
                          </tr>
                          <tr>
                            <td>Expire Due :</td>
                            <td>'.date("F d, Y",strtotime($estimate->expiry_date)).'</td>
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
                    <th><b>Item Type</b></th>
                    <th style="text-align: right;"><b>Qty</b></th>
                    <th style="text-align: right;"><b>Discount</b></th>
                    <th style="text-align: right;"><b>Total</b></th>
                </tr>
            </thead>
            <tbody>';
            $total_amount = 0;
            $total_tax = 0;
            $row = 1; 
            foreach($estimateItems as $item){
                $html .= '<tr>
                    <td valign="top" style="width:5%;">'.$row.'</td>
                    <td valign="top" style="">'.$item['item'].'</td>
                    <td valign="top" style="">'.ucwords($item['item_type']).'</td>
                    <td valign="top" style="text-align: right;">'.$item['quantity'].'</td>
                    <td valign="top" style="text-align: right;">'.number_format($item['discount'],2).'</td>
                    <td valign="top" style="text-align: right;">'.number_format($item['price'],2).'</td>
                  </tr>
                ';
                $row++;
                $total_amount += $item['price'];
            }

            $html .= '<tr>
              <td colspan="5" style="text-align: right;"><b>Grand Total</b></td>
              <td style="text-align: right;"><b>$'.number_format($total_amount, 2).'</b></td>
            </tr>
          </tbody>
          </table>
          <br /><br /><br />
          <p><b>Message</b><br /><br />'.$estimate->customer_message.'</p>
          <p><b>Terms</b><br /><Br />'.$creditNote->terms_conditions.'</p>
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
}