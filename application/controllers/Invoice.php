<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once 'application/services/InvoiceCustomer.php';

class Invoice extends MY_Controller {

	public function __construct()
    {
        parent::__construct();

        $this->checkLogin();

        $this->page_data['page']->title = 'Invoice Management';

        $this->page_data['page']->menu = (!empty($this->uri->segment(2))) ? $this->uri->segment(2) : 'invoice';
        $this->load->model('Invoice_model', 'invoice_model');
        $this->load->model('Invoice_settings_model', 'invoice_settings_model');
        $this->load->model('Payment_records_model', 'payment_records_model');
        $this->load->model('AcsProfile_model', 'AcsProfile_model');
        $this->load->model('Accounting_terms_model','accounting_terms_model');
        $this->load->model('Accounting_invoices_model','accounting_invoices_model');

        $user_id = getLoggedUserID();

        // add css and js file path so that they can be attached on this page dynamically
        // add_css and add_footer_js are the helper function defined in the helpers/basic_helper.php
        add_css(array(
            'https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css',
            'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css',
            'https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css',
            'assets/frontend/css/invoice/main.css',
        ));


        // JS to add only Customer module
        add_footer_js(array(
            'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js',
            'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js',
            'https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js',
            'assets/frontend/js/invoice/add.js',
            'assets/js/invoice.js'
        ));
    }

    public function index($tab = '')
    {

        $is_allowed = $this->isAllowedModuleAccess(35);
        if( !$is_allowed ){
            $this->page_data['module'] = 'invoice';
            echo $this->load->view('no_access_module', $this->page_data, true);
            die();
        }

        $role = logged('role');
        $type = 0;
        if ($role == 2 || $role == 3 || $role == 6) {
            $comp_id = logged('company_id');

            if (!empty($tab)) {
                $this->page_data['tab'] = $tab;
                $this->page_data['invoices'] = $this->invoice_model->filterBy(array('status' => $tab), $comp_id, $type);
            } else {

                // search
                if (!empty(get('search'))) {

                    $this->page_data['search'] = get('search');
                    $this->page_data['invoices'] = $this->invoice_model->filterBy(array('search' => get('search')), $comp_id, $type);
                } elseif (!empty(get('order'))) {

                    $this->page_data['search'] = get('search');
                    $this->page_data['invoices'] = $this->invoice_model->filterBy(array('order' => get('order')), $comp_id, $type);

                } else {
                    $this->page_data['invoices'] = $this->invoice_model->getAllByCompany($comp_id, $type);
                }
            }
        }

        if ($role == 4) {

            if (!empty($tab)) {

                $this->page_data['tab'] = $tab;
                $this->page_data['invoice'] = $this->invoice_model->filterBy(array('status' => $tab), $type);


            } elseif (!empty(get('order'))) {

                $this->page_data['order'] = get('order');
                $this->page_data['invoice'] = $this->workorder_model->filterBy(array('order' => get('order')), $comp_id, $type);

            } else {

                if (!empty(get('search'))) {

                    $this->page_data['search'] = get('search');
                    $this->page_data['invoice'] = $this->workorder_model->filterBy(array('search' => get('search')), $comp_id, $type);
                } else {
                    $this->page_data['invoice'] = $this->invoice_model->getAllByUserId();
                }
            }
        }


        $this->load->view('invoice/invoice_new', $this->page_data);
    }

    public function recurring($tab = '')
    {
        $is_allowed = $this->isAllowedModuleAccess(37);
        if( !$is_allowed ){
            $this->page_data['module'] = 'recurring_invoices';
            echo $this->load->view('no_access_module', $this->page_data, true);
            die();
        }

        $role = logged('role');
        $type = 1;
        if ($role == 2 || $role == 3) {
            $comp_id = logged('company_id');

            if (!empty($tab)) {
                $this->page_data['tab'] = $tab;
                $this->page_data['invoices'] = $this->invoice_model->filterBy(array('status' => $tab), $comp_id, $type);
            } else {

                // search
                if (!empty(get('search'))) {

                    $this->page_data['search'] = get('search');
                    $this->page_data['invoices'] = $this->invoice_model->filterBy(array('search' => get('search')), $comp_id, $type);
                } elseif (!empty(get('order'))) {

                    $this->page_data['search'] = get('search');
                    $this->page_data['invoices'] = $this->invoice_model->filterBy(array('order' => get('order')), $comp_id, $type);

                } else {
                    $this->page_data['invoices'] = $this->invoice_model->getAllByCompany($comp_id, $type);
                }
            }
        }

        $this->load->view('invoice/recurring', $this->page_data);
    }

    public function add()
    {

        $user_id = logged('id');
        // $parent_id = $this->db->query("select parent_id from users where id=$user_id")->row();

        // if ($parent_id->parent_id == 1) { // ****** if user is company ******//
            $this->page_data['users'] = $this->users_model->getAllUsersByCompany($user_id);
        // } else {
        //     $this->page_data['users'] = $this->users_model->getAllUsersByCompany($parent_id->parent_id, $user_id);
        // }
        $company_id = logged('company_id');
        $role = logged('role');
        // $this->page_data['workstatus'] = $this->Workstatus_model->getByWhere(['company_id'=>$company_id]);
        if( $role == 1 || $role == 2 ){
            // $this->page_data['customers'] = $this->AcsProfile_model->getAllByCompanyId($company_id);
            $this->page_data['customers'] = $this->AcsProfile_model->getAll();
        }else{
            // $this->page_data['customers'] = $this->AcsProfile_model->getAll();
            $this->page_data['customers'] = $this->AcsProfile_model->getAllByCompanyId($company_id);
        }


        $setting = $this->invoice_settings_model->getAllByCompany(logged('company_id'));
        $terms = $this->accounting_terms_model->getCompanyTerms_a($company_id);
        $this->page_data['number'] = $this->invoice_model->getlastInsert();

        if (!empty($setting)) {
            foreach ($setting as $key => $value) {
                if (is_serialized($value)) {
                    $setting->{$key} = unserialize($value);
                }
            }
            $this->page_data['setting'] = $setting;
            $this->page_data['terms'] = $terms;
        }

        $this->page_data['items'] = $this->items_model->getItemlist();

        $this->load->view('invoice/add', $this->page_data);

    }

    public function addNewInvoice()
    {
        if($this->input->post('custocredit_card_paymentsmer_id') == 1){
            $credit_card = 'Credit Card';
        }else{
            $credit_card = '0';
        }

        if($this->input->post('bank_transfer') == 1){
            $bank_transfer = 'Bank Transfer';
        }else{
            $bank_transfer = '0';
        }

        if($this->input->post('instapay') == 1){
            $instapay = 'Instapay';
        }else{
            $instapay = '0';
        }

        if($this->input->post('check') == 1){
            $check = 'Check';
        }else{
            $check = '0';
        }

        if($this->input->post('cash') == 1){
            $cash = 'Cash';
        }else{
            $cash = '0';
        }

        if($this->input->post('deposit') == 1){
            $deposit = 'Deposit';
        }else{
            $deposit = '0';
        }


        $new_data = array(
            'customer_id' => $this->input->post('customer_id'),//

            'job_location' => $this->input->post('jobs_location'),//
            'job_name' => $this->input->post('job_name'),//

            'tags' => $this->input->post('tags'),//
            'invoice_type' => $this->input->post('invoice_type'),//
            'work_order_number' => $this->input->post('work_order_number'),//
            'purchase_order' => $this->input->post('purchase_order'),//
            'invoice_number' => $this->input->post('invoice_number'),//
            'date_issued' => $this->input->post('date_issued'),//

            'customer_email' => $this->input->post('customer_email'),//
            'online_payments' => $this->input->post('online_payments'),
            'billing_address' => $this->input->post('billing_address'),//
            'shipping_to_address' => $this->input->post('shipping_to_address'),//
            'ship_via' => $this->input->post('ship_via'),//
            'shipping_date' => $this->input->post('shipping_date'),//
            'tracking_number' => $this->input->post('tracking_number'),//
            'terms' => $this->input->post('terms'),//
            // 'invoice_date' => $this->input->post('invoice_date'),
            'due_date' => $this->input->post('due_date'),//
            'location_scale' => $this->input->post('location_scale'),//
            'message_to_customer' => $this->input->post('message_to_customer'),//
            'terms_and_conditions' => $this->input->post('terms_and_conditions'),//
            // 'attachments' => $this->input->post('file_name'),
            'attachments' => 'test',
            'status' => $this->input->post('status'),//

            'deposit_request_type' => $this->input->post('deposit_request_type'),//
            'deposit_request' => $this->input->post('deposit_amount'),//
            // 'payment_schedule' => $this->input->post('payment_schedule'),
            'payment_methods' => $credit_card.','.$bank_transfer.','.$instapay.','.$check.','.$cash.','.$deposit,

            'sub_total' => $this->input->post('sub_total'),//
            'adjustment_name' => $this->input->post('adjustment_name'),//
            'adjustment_value' => $this->input->post('adjustment_input'),//
            'grand_total' => $this->input->post('grand_total'),//


            'user_id' => logged('id'),
            'date_created' => date("Y-m-d H:i:s"),
            'date_updated' => date("Y-m-d H:i:s")
        );

        $addQuery = $this->invoice_model->createInvoice($new_data);

        if($addQuery > 0){
            //echo json_encode($addQuery);
            $new_data2 = array(
                'item' => $this->input->post('item'),
                'item_type' => $this->input->post('item_type'),
                // 'description' => $this->input->post('desc'),
                'qty' => $this->input->post('quantity'),
                // 'rate' => $this->input->post('rate'),
                'cost' => $this->input->post('price'),
                'discount' => $this->input->post('discount'),
                'tax' => $this->input->post('tax'),
                'total' => $this->input->post('total'),
                'type' => 'Invoice',
                'type_id' => $addQuery,
                'status' => '1',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            );

            $a = $this->input->post('item');
            $b = $this->input->post('item_type');
            $c = $this->input->post('quantity');
            $d = $this->input->post('price');
            $e = $this->input->post('discount');
            $f = $this->input->post('tax');
            $g = $this->input->post('total');

        $i = 0;
        foreach($a as $row){
            $data['item'] = $a[$i];
            $data['item_type'] = $b[$i];
            $data['qty'] = $c[$i];
            $data['cost'] = $d[$i];
            $data['discount'] = $e[$i];
            $data['tax'] = $f[$i];
            $data['total'] = $g[$i];
            $data['type'] = 'Invoice';
            $data['type_id'] = $addQuery;
            $data['status'] = '1';
            $data['created_at'] = date("Y-m-d H:i:s");
            $data['updated_at'] = date("Y-m-d H:i:s");
            // $addQuery2 = $this->accounting_invoices_model->createInvoiceProd($data);
            $addQuery2 = $this->accounting_invoices_model->additem_details($data);
            $i++;
        }

        // redirect('accounting/banking');
        redirect('invoice');

        }
        else{
            echo json_encode(0);
        }
    }

    public function recurring_add()
    {

        $user_id = logged('id');
        $parent_id = $this->db->query("select parent_id from users where id=$user_id")->row();

        if ($parent_id->parent_id == 1) { // ****** if user is company ******//
            $this->page_data['users'] = $this->users_model->getAllUsersByCompany($user_id);
        } else {
            $this->page_data['users'] = $this->users_model->getAllUsersByCompany($parent_id->parent_id, $user_id);
        }

        $setting = $this->invoice_settings_model->getAllByCompany(logged('company_id'));

        if (!empty($setting)) {
            foreach ($setting as $key => $value) {
                if (is_serialized($value)) {
                    $setting->{$key} = unserialize($value);
                }
            }
            $this->page_data['setting'] = $setting;
        }

        $this->load->view('invoice/add_recurring', $this->page_data);

    }


    public function settings()
    {
        $is_allowed = $this->isAllowedModuleAccess(38);
        if( !$is_allowed ){
            $this->page_data['module'] = 'settings3';
            echo $this->load->view('no_access_module', $this->page_data, true);
            die();
        }


        $comp_id = logged('company_id');
        $this->page_data['setting'] = null;
        $setting = $this->invoice_settings_model->getAllByCompany($comp_id);

        if (!empty($setting)) {
            foreach ($setting as $key => $value) {
                if (is_serialized($value)) {
                    $setting->{$key} = unserialize($value);
                }
            }
            $this->page_data['setting'] = $setting;
        }


        $this->load->view('invoice/settings', $this->page_data);

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
            $tax = post('tax');
            $total = post('total');

            foreach (post('item') as $key => $val) {

                $itemArray[] = array(

                    'item' => $items[$key],
                    'item_type' => $type[$key],
                    'quantity' => $quantity[$key],
                    'price' => $price[$key],
                    'discount' => $discount[$key],
                    'tax' => $tax[$key],
                    'total' => $total[$key]
                );
            }

            $invoice_items = serialize($itemArray);
        } else {

            $invoice_items = '';
        }

        $invoice_totals = array(

            'sub_total' => post('sub_total') ? post('sub_total') : 0,
            'adjustment_amount' => post('adjustment_amount') ? post('adjustment_amount') : 0,
            'grand_total' => post('grand_total') ? post('grand_total') : 0
        );

        $comp_id = logged('company_id');

        $id = $this->invoice_model->create([
            'user_id' => $user->id,
            'company_id' => $comp_id,
            'customer_id' => post('customer_id'),
            'job_location' => post('job_location'),
            'job_name' => post('job_name'),
            'date_issued' => date('Y-m-d', strtotime(post('date_issued'))),
            'due_date' => date('Y-m-d', strtotime(post('due_date'))),
            'po_number' => post('purchase_order'),
            'work_order_number' => post('work_order'),
            'invoice_number' => post('invoice_number'),
            'invoice_type' => post('invoice_type'),
            'accept_credit_card' => post('credit_card'),
            'accept_check' => post('check'),
            'accept_direct_deposit' => post('deposit'),
            'accept_cash' => post('cash'),
            'status' => 'Draft',
            'invoice_items' => $invoice_items,
            'invoice_totals' => serialize($invoice_totals),
            'deposit_request' => post('deposit_request'),
            'message_to_customer' => post('message'),
            'terms_and_conditions' => post('terms_conditions')
        ]);

        $this->activity_model->add('New Invoice $' . $user->id . ' Created by User:' . logged('name'), logged('id'));
        $this->session->set_flashdata('alert-type', 'success');
        $this->session->set_flashdata('alert', 'New Invoice Created Successfully');

        redirect('invoice');
    }

    public function save_payment_record()
    {
        postAllowed();

        $user = (object)$this->session->userdata('logged');
        $comp_id = logged('company_id');

        $id = $this->payment_records_model->create([
            'user_id' => $user->id,
            'company_id' => $comp_id,
            'customer_id' => post('customer_id'),
            'invoice_amount' => post('amount'),
            'invoice_tip' => post('amount_tip'),
            'payment_date' => date('Y-m-d', strtotime(post('date_payment'))),
            'payment_method' => post('payment_method'),
            'invoice_number' => post('invoice_number'),
            'reference_number' => post('reference'),
            'notes' => post('notes')
        ]);

        $this->activity_model->add('New Payment Record $' . $user->id . ' Created by User:' . logged('name'), logged('id'));
        $this->session->set_flashdata('alert-type', 'success');
        $this->session->set_flashdata('alert', 'New Payment Recorded Successfully');

        redirect('invoice/genview/'.post('invoice_id'));
    }

    public function save_recurring()
    {
        postAllowed();

        $user = (object)$this->session->userdata('logged');

        if (count(post('item')) > 0) {

            $items = post('item');
            $quantity = post('quantity');
            $price = post('price');
            $discount = post('discount');
            $type = post('item_type');
            $tax = post('tax');
            $total = post('total');

            foreach (post('item') as $key => $val) {

                $itemArray[] = array(

                    'item' => $items[$key],
                    'item_type' => $type[$key],
                    'quantity' => $quantity[$key],
                    'price' => $price[$key],
                    'discount' => $discount[$key],
                    'tax' => $tax[$key],
                    'total' => $total[$key]
                );
            }

            $invoice_items = serialize($itemArray);
        } else {
            $invoice_items = '';
        }

        $invoice_totals = array(
            'sub_total' => post('sub_total') ? post('sub_total') : 0,
            'adjustment_amount' => post('adjustment_amount') ? post('adjustment_amount') : 0,
            'grand_total' => post('grand_total') ? post('grand_total') : 0
        );

        $repeats = array(
            'repeats' => post('repeats'),
            'repeat_every' => post('recurring_interval'),
            'repeat_on' => post('recurring_frequency_weekday')
        );

        switch(post('recurring_end')) {
            case "on":
                $end_date = post('recurring_until');
                break;
            case "count":
                $end_date = post('recurring_count');
                break;

            default:
                $end_date = post('recurring_end');
                break;
        }

        $comp_id = logged('company_id');

        $id = $this->invoice_model->create([
            'user_id' => $user->id,
            'company_id' => $comp_id,
            'customer_id' => post('customer_id'),
            'job_location' => post('job_location'),
            'job_name' => post('job_name'),
            'po_number' => post('purchase_order'),
            'work_order_number' => post('work_order'),
            'invoice_type' => post('invoice_type'),
            'accept_credit_card' => post('credit_card'),
            'accept_check' => post('check'),
            'accept_direct_deposit' => post('deposit'),
            'accept_cash' => post('cash'),
            'start_on' => post('start_on'),
            'end_date' => $end_date,
            'due_terms' => post('due_terms'),
            'sent_time' => post('recurring_scheduled_time'),
            'status' => 'Draft',
            'is_recurring' => 1,
            'repeats' => serialize($repeats),
            'invoice_items' => $invoice_items,
            'invoice_totals' => serialize($invoice_totals),
            'deposit_request' => post('deposit_request'),
            'message_to_customer' => post('message'),
            'terms_and_conditions' => post('terms_conditions')
        ]);

        $this->activity_model->add('New Recurring Invoice $' . $user->id . ' Created by User:' . logged('name'), logged('id'));
        $this->session->set_flashdata('alert-type', 'success');
        $this->session->set_flashdata('alert', 'New Recurring Invoice Created Successfully');

        redirect('invoice/recurring');
    }

    public function save_setting($id = null)
    {
        postAllowed();
        $user = (object)$this->session->userdata('logged');
        $config = array(
            'upload_path' => "./uploads/",
            'allowed_types' => "gif|jpg|png|jpeg",
            'overwrite' => TRUE,
            'max_size' => "2048000",
            'max_height' => "768",
            'max_width' => "1024"
        );

        $this->load->library('upload', $config);

        if($this->upload->do_upload()) {
            $draftlogo = array('upload_data' => $this->upload->data());
            $logo = $draftlogo['upload_data']['file_name'];
        } else {
            if ($id) {
                $logo = post('img_setting');
            } else {
                $logo = '';
            }
        }

        $payment_methods = array(
            'cc' => post('payment_cc'),
            'check' => post('payment_check'),
            'cash' => post('payment_cash'),
            'deposit' => post('payment_deposit')
        );

        $invoice_number = array(
            'prefix' => post('prefix'),
            'base' => post('base'),
        );

        $residential = array(
            'default_msg' => post('message'),
            'default_terms' => post('terms'),
        );

        $commercial = array(
            'default_msg' => post('message_commercial'),
            'default_terms' => post('terms_commercial'),
        );

        $payment_fee = array(
            'percent' => post('payment_fee_percent'),
            'amount' => post('payment_fee_amount'),
        );

        $invoice_template = array(
            'item_price' => post('hide_item_price'),
            'item_qty' => post('hide_item_qty'),
            'item_tax' => post('hide_item_tax'),
            'item_discount' => post('hide_item_discount'),
            'item_total' => post('hide_item_total'),
            'from_email' => post('hide_from_email'),
            'item_subtotal' => post('show_item_type_subtotal')
        );

        $invoice_from = array(
            'business_phone' => post('from_phone_show'),
            'office_phone' => post('from_office_phone_show'),
        );

        $comp_id = logged('company_id');
        if (!$id) {
            $this->invoice_settings_model->create([
                'user_id' => $user->id,
                'company_id' => $comp_id,
                'invoice_number' => serialize($invoice_number),
                'residential' => serialize($residential),
                'commercial' => serialize($commercial),
                'logo' => $logo,
                'payable_to' => post('payment_to'),
                'due_terms' => post('due_terms'),
                'invoice_type' => post('invoice_type'),
                'payment_fee' => serialize($payment_fee),
                'invoice_template' => serialize($invoice_template),
                'invoice_from' => serialize($invoice_from),
                'recurring' => post('recurring_on_add_child'),
                'payment_method' => serialize($payment_methods),
                'mobile_payment' => post('payment_mobile_status'),
                'invoice_tip' => post('tip_status'),
                'autoconvert_work_order' => post('autoconvert_work_order')
            ]);
        } else {
            $this->invoice_settings_model->update($id, [
                'user_id' => $user->id,
                'company_id' => $comp_id,
                'invoice_number' => serialize($invoice_number),
                'residential' => serialize($residential),
                'commercial' => serialize($commercial),
                'logo' => $logo,
                'payable_to' => post('payment_to'),
                'due_terms' => post('due_terms'),
                'invoice_type' => post('invoice_type'),
                'payment_fee' => serialize($payment_fee),
                'invoice_template' => serialize($invoice_template),
                'invoice_from' => serialize($invoice_from),
                'recurring' => post('recurring_on_add_child'),
                'payment_method' => serialize($payment_methods),
                'mobile_payment' => post('payment_mobile_status'),
                'invoice_tip' => post('tip_status'),
                'autoconvert_work_order' => post('autoconvert_work_order')
            ]);
        }

        $this->activity_model->add('Update Invoice Settings $' . $user->id . ' Created by User:' . logged('name'), logged('id'));
        $this->session->set_flashdata('alert-type', 'success');
        $this->session->set_flashdata('alert', 'Invoice Settings Saved Successfully');

        redirect('invoice/settings');
    }

    public function save_new_customer()
    {
        $company_id  = getLoggedCompanyID();
        $user_id  = getLoggedUserID();

        if($this->input->post('notify_by_email') == 1){
            $notify_by_email = '1';
        }else{
            $notify_by_email = '0';
        }

        if($this->input->post('notify_by_sms') == 1){
            $notify_by_sms = '1';
        }else{
            $notify_by_sms = '0';
        }

        if($this->input->post('street_address') == null)
        {
            $street_address = '';
        }else{
            $street_address = $this->input->post('street_address');
        }

        if($this->input->post('suite_unit') == null)
        {
            $suite_unit = '';
        }else{
            $suite_unit = $this->input->post('suite_unit');
        }

        if($this->input->post('city') == null)
        {
            $city = '';
        }else{
            $city = $this->input->post('city');
        }

        if($this->input->post('postcode') == null)
        {
            $postcode = '';
        }else{
            $postcode = $this->input->post('postcode');
        }

        if($this->input->post('state') == null)
        {
            $state = '';
        }else{
            $state = $this->input->post('state');
        }

        $new_data = array(
            'fk_user_id' => $user_id,
            // 'contact_name' => $this->input->post('contact_name'),
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'middle_name' => $this->input->post('middle_name'),
            'email' => $this->input->post('contact_email'),
            'phone_m' => $this->input->post('contact_mobile'),
            'phone_h' => $this->input->post('contact_phone'),
            'business_name' => $this->input->post('business_name'),
            'customer_type' => $this->input->post('customer_type'),

            'mail_add' => $street_address,
            'cross_street' => $street_address,
            'subdivision' => $suite_unit,
            'city' => $city,
            'zip_code' => $postcode,
            'state' => $state,

            'notify_email' => $notify_by_email,
            'notify_sms' => $notify_by_sms,
            'company_id' => $company_id,
        );

        $addQuery = $this->invoice_model->savenewCustomer($new_data);

        if($addQuery > 0){
            // echo 'Congrats, new customer added!';
            echo json_encode($addQuery);
            //$this->session->set_flashdata('Method added');
        }
        else{
            echo json_encode(0);
        }
    }


    public function edit($id)
    {
        $comp_id = logged('company_id');
        $user_id = logged('id');
        // $parent_id = $this->db->query("select parent_id from users where id=$user_id")->row();

        // if ($parent_id->parent_id == 1) {
            $this->page_data['users'] = $this->users_model->getAllUsersByCompany($user_id);
        // } else {
            // $this->page_data['users'] = $this->users_model->getAllUsersByCompany($parent_id->parent_id, $user_id);
        // }

        $this->page_data['invoice'] = $this->invoice_model->getById($id);

        $this->load->view('invoice/edit', $this->page_data);
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

            $invoice_items = serialize($itemArray);
        } else {

            $invoice_items = '';
        }

        $invoice_totals = array(

            'sub_total' => post('sub_total') ? post('sub_total') : 0,
            'adjustment_amount' => post('adjustment_amount') ? post('adjustment_amount') : 0,
            'grand_total' => post('grand_total') ? post('grand_total') : 0
        );

        $comp_id = logged('company_id');

        $id = $this->invoice_model->update($id, [

            'user_id' => $user->id,
            'company_id' => $comp_id,
            'customer_id' => post('customer_id'),
            'job_location' => post('job_location'),
            'job_name' => post('job_name'),
            'date_issued' => date('Y-m-d', strtotime(post('date_issued'))),
            'due_date' => date('Y-m-d', strtotime(post('due_date'))),
            'po_number' => post('purchase_order'),
            'work_order_number' => post('work_order'),
            'invoice_number' => post('invoice_number'),
            'invoice_type' => post('invoice_type'),
            'accept_credit_card' => post('credit_card'),
            'accept_check' => post('check'),
            'accept_direct_deposit' => post('deposit'),
            'accept_cash' => post('cash'),
            'invoice_items' => $invoice_items,
            'invoice_totals' => serialize($invoice_totals),
            'deposit_request' => post('deposit_request'),
            'message_to_customer' => post('customer_message'),
            'terms_and_conditions' => post('terms_conditions')
        ]);

        $this->activity_model->add('New User $' . $user->id . ' Created by User:' . logged('name'), logged('id'));
        $this->session->set_flashdata('alert-type', 'success');
        $this->session->set_flashdata('alert', 'Invoice has been Updated Successfully');

        redirect('invoice');
    }

     /**
     * @param $id
     */
    public function genview($id)
    {
        $invoice = get_invoice_by_id($id);
        $user = get_user_by_id(logged('id'));
        $setting = $this->invoice_settings_model->getAllByCompany(logged('company_id'));

        if (!empty($setting)) {
            foreach ($setting as $key => $value) {
                if (is_serialized($value)) {
                    $setting->{$key} = unserialize($value);
                }
            }
            $this->page_data['setting'] = $setting;
        }

        if (!empty($invoice)) {
            foreach ($invoice as $key => $value) {
                if (is_serialized($value)) {
                    $invoice->{$key} = unserialize($value);
                }
            }
            $this->page_data['invoice'] = $invoice;
            $this->page_data['user'] = $user;
        }
        $this->page_data['record_payment'] = $this->input->get('do');

        $this->load->view('invoice/genview', $this->page_data);
    }

    /**
     * @param $id
     */
    public function send($id)
    {
        $invoice = get_invoice_by_id($id);
        $user = get_user_by_id(logged('id'));

        if (!empty($invoice)) {
            foreach ($invoice as $key => $value) {
                if (is_serialized($value)) {
                    $invoice->{$key} = unserialize($value);
                }
            }
            $this->page_data['invoice'] = $invoice;
            $this->page_data['user'] = $user;
            $this->page_data['scheduled'] = $this->input->get('scheduled');
        }

        $this->load->view('invoice/send', $this->page_data);
    }

    /**
     * @param $id
     */
    public function mark_as_sent($id)
    {
        $ids = $this->invoice_model->markAsSent($id, logged('company_id'));
        $this->activity_model->add("invoice #$id Mark As Sent by User:" . logged('name'));
        $this->session->set_flashdata('alert-type', 'success');
        $this->session->set_flashdata('alert', 'invoice has been Mark As Sent Successfully');

        redirect('invoice/genview/'.$id);
    }

    /**
     * @param $id
     */
    public function clone($id)
    {
        $id = $this->invoice_model->duplicateRecord($id, logged('company_id'));
        $this->activity_model->add("invoice #$id Clone by User:" . logged('name'));
        $this->session->set_flashdata('alert-type', 'success');
        $this->session->set_flashdata('alert', 'invoice has been Cloned Successfully');

        redirect('invoice');
    }

    /**
     * @param $id
     */
    public function delete($id)
    {
        $id = $this->invoice_model->delete($id);
        $this->activity_model->add("invoice #$id Deleted by User:" . logged('name'));
        $this->session->set_flashdata('alert-type', 'success');
        $this->session->set_flashdata('alert', 'invoice has been Deleted Successfully');

        redirect('invoice');
    }

    /**
     * Sending Invoice Emails
     */
    public function send_email()
    {
        postAllowed();
        if (!post('scheduled')) {
            $config = Array(
                'protocol'  => 'smtp',
                'smtp_host' => 'smtp.gmail.com',
                'smtp_port' => 587,
                'smtp_user' => 'nsmartrac@gmail.com',
                'smtp_pass' => 'nSmarTrac1',
                'mailtype'  => 'html',
                'charset'   => 'iso-8859-1',
                'wordwrap'  => TRUE
            );

            $this->load->library('email', $config);

            $this->email->set_newline("\r\n");
            $this->email->from(post('from_email'), post('from_name'));
            $this->email->to("jeykell125@gmail.com");
            $this->email->cc(post('cc[]'));
            $this->email->bcc(post('bcc[]'));

            $this->email->subject(post('mail_subject'));
            $this->email->message(post('mail_msg'));

            $this->email->send();

            $this->session->set_flashdata('alert-type', 'success');
            $this->session->set_flashdata('alert', 'Email has been Sent');
        } else {
            $this->session->set_flashdata('alert-type', 'success');
            $this->session->set_flashdata('alert', 'Scheduled invoice email has been set');
        }

        redirect('invoice/genview/'.post('invoice_id'));
    }

    public function sendSMS($data) {
        // Your Account SID and Auth Token from twilio.com/console
        $sid = 'your_sid';
        $token = 'your_token';
        $client = new Client($sid, $token);

        // Use the client to do fun stuff like send text messages!
            return $client->messages->create(
            // the number you'd like to send the message to
            $data['phone'],
            array(
                // A Twilio phone number you purchased at twilio.com/console
                "from" => "+your Twilio number",
                // the body of the text message you'd like to send
                'body' => $data['text']
            )
        );
    }

    public function tab($index)
    {
        $this->index($index);
    }

	 /**
     *
     */
    public function customer()
    {
        // pass the $this so that we can use it to load view, model, library or helper classes
        $invoiceCustomer = new InvoiceCustomer($this);
    }

    public function new_customer_form()
    {
        $get = $this->input->get();

        if (!empty($get)) {
            $this->page_data['action'] = $get['action'];
            $this->page_data['data_index'] = $get['index'];
            $this->page_data['customer'] = $this->customer_model->getCustomer($get['customer_id']);
            $this->page_data['additional_contacts'] = $this->customer_model->getAdditionalContacts(array('id' => $get['customer_id']), $get['index']);
            // print_r($this->page_data['service_address']); die;
        }

        die($this->load->view('invoice/new_customer_form', $this->page_data, true));

    }

    public function record_payment_form()
    {
        $get = $this->input->get();

        if (!empty($get)) {
            $invoice = get_invoice_by_id($get['invoice_id']);
            $this->page_data['action'] = $get['action'];

            if (!empty($invoice)) {
                foreach ($invoice as $key => $value) {
                    if (is_serialized($value)) {
                        $invoice->{$key} = unserialize($value);
                    }
                }
                $this->page_data['invoice'] = $invoice;
            }
        }

        die($this->load->view('invoice/record_payment_form', $this->page_data, true));

    }

    public function pay_now_form()
    {
        $get = $this->input->get();

        if (!empty($get)) {
            $invoice = get_invoice_by_id($get['invoice_id']);
            $this->page_data['action'] = $get['action'];

            if (!empty($invoice)) {
                foreach ($invoice as $key => $value) {
                    if (is_serialized($value)) {
                        $invoice->{$key} = unserialize($value);
                    }
                }
                $this->page_data['invoice'] = $invoice;
            }
        }

        die($this->load->view('invoice/pay_now_form', $this->page_data, true));

    }

    function preview($id)
    {
        $invoice = get_invoice_by_id($id);
        $user = get_user_by_id(logged('id'));
        $this->page_data['invoice'] = $invoice;
        $this->page_data['user'] = $user;
        // $this->page_data['items'] = $user;
        $this->page_data['items'] = $this->invoice_model->getItems($id);
        $this->page_data['users'] = $this->invoice_model->getInvoiceCustomer($id);

        if (!empty($invoice)) {
            foreach ($invoice as $key => $value) {
                if (is_serialized($value)) {
                    $invoice->{$key} = unserialize($value);
                }
            }
            $this->page_data['invoice'] = $invoice;
            $this->page_data['user'] = $user;
        }
        $format = $this->input->get('format');
        $this->page_data['format'] = $format;
        // print_r($this->page_data['users']);

        if ($format === "pdf") {
            $img = explode("/", parse_url((companyProfileImage(logged('company_id'))) ? companyProfileImage(logged('company_id')) : $url->assets)['path']);
            $this->page_data['profile'] = $img[2] . "/" . $img[3] . "/" . $img[4];
            $filename = "nSmarTrac_invoice_".$id;
            $this->load->library('pdf');
            $this->pdf->load_view('invoice/pdf/template', $this->page_data, $filename, "portrait");
        } else {
            $this->page_data['profile'] = (companyProfileImage(logged('company_id'))) ? companyProfileImage(logged('company_id')) : $url->assets;
            $filename = "nSmarTrac_invoice_".$id;
            $this->load->view('invoice/pdf/template', $this->page_data, "portrait");
        }

    }

    /**
     * Get All Data from this method.
     *
     * @return Response
    */

    public function stripePost()
    {
        require_once('application/libraries/stripe-php/init.php');
        \Stripe\Stripe::setApiKey($this->config->item('stripe_secret'));

        \Stripe\Charge::create ([
                "amount" => 100 * 100,
                "currency" => "usd",
                "source" => $this->input->post('stripeToken'),
                "description" => "Test payment from nsmartrac.com."
        ]);

        $this->session->set_flashdata('alert-type', 'success');
        $this->session->set_flashdata('alert', 'Payment made successfully');

        redirect('invoice/genview/'.post('invoice_id'));
    }
}

/* End of file Invoice.php */
/* Location: ./application/controllers/Invoice.php */
