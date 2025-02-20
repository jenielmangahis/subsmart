<?php

defined('BASEPATH') or exit('No direct script access allowed');


class Estimate_v1 extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->hasAccessModule(19); 
        $this->page_data['page']->title = 'My Estimates';
        $this->page_data['page']->menu = 'estimates';
		$this->page_data['page']->title = 'Estimates';
        $this->page_data['page']->parent = 'Sales';
        $this->load->model('Estimate_model', 'estimate_model');
        $this->load->model('Jobs_model', 'jobs_model');
        $this->load->model('items_model');
        $this->load->model('accounting_invoices_model');
        $this->load->model('Workorder_model', 'workorder_model');
        $this->load->model('General_model', 'general');
        $this->load->model('Customer_model', 'customer_model');
        
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
        if (!$is_allowed) {
            $this->page_data['module'] = 'estimate';
            echo $this->load->view('no_access_module', $this->page_data, true);
            die();
        }

        $company_id = logged('company_id');
        $role = logged('role');

        /*if ($role == 2 || $role == 1) {
            $this->page_data['jobs'] = $this->jobs_model->getByWhere([]);
        }else{
            $this->page_data['jobs'] = $this->jobs_model->getByWhere(['company_id' => $company_id]);
        } */

        if (!empty($tab)) {
            $query_tab = $tab;
            if ($tab == 'declined%20by%20customer') {
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
                if ($role == 1 || $role == 2) {
                    $this->page_data['estimates'] = $this->estimate_model->getAllEstimates();
                } else {
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
        // $this->load->view('estimate/list', $this->page_data);
        $this->load->view('v2/pages/estimate/list', $this->page_data);
    }

    public function savenewestimate()
    {
        $this->load->model('EstimateSettings_model');

        $company_id  = getLoggedCompanyID();
        $user_id  = getLoggedUserID();
        $user_login = logged('FName') . ' ' . logged('LName');
        
        //Generate Estimate Number
        $setting = $this->EstimateSettings_model->getEstimateSettingByCompanyId($company_id);
        if( $setting ){
            $next_num = $setting->estimate_num_next;
            $prefix   = $setting->estimate_num_prefix;
        }else{
            $lastInsert = $this->estimate_model->getlastInsertByComp($company_id);
            if( $lastInsert ){
                $next_num = $lastInsert->id + 1;
            }else{
                $next_num = 1;
            }
            $prefix = 'EST-';            
        }

        $estimate_number = str_pad($next_num, 9, "0", STR_PAD_LEFT);
        $estimate_number = $prefix . $estimate_number;

        $new_data = array(
            'customer_id' => $this->input->post('customer_id'),
            'job_location' => $this->input->post('job_location'),
            'job_name' => $this->input->post('job_name'),
            'estimate_number' => $estimate_number,
            // 'email' => $this->input->post('email'),
            // 'billing_address' => $this->input->post('billing_address'),
            'estimate_date' => $this->input->post('estimate_date'),
            'expiry_date' => $this->input->post('expiry_date'),
            'purchase_order_number' => $this->input->post('purchase_order_number'),
            'status' => $this->input->post('status'),
            'estimate_type' => 'Standard',
            'type' => $this->input->post('estimate_type'),
            // 'ship_via' => $this->input->post('ship_via'),
            // 'ship_date' => $this->input->post('ship_date'),
            // 'tracking_no' => $this->input->post('tracking_no'),
            // 'ship_to' => $this->input->post('ship_to'),
            // 'tags' => $this->input->post('tags'),
            'attachments' => '',
            // 'message_invoice' => $this->input->post('message_invoice'),
            // 'message_statement' => $this->input->post('message_statement'),
            'status' => $this->input->post('status'),
            'deposit_request' => $this->input->post('deposit_request'),
            'deposit_amount' => $this->input->post('deposit_amount'),
            'customer_message' => $this->input->post('customer_message'),
            'terms_conditions' => $this->input->post('terms_conditions'),
            'instructions' => $this->input->post('instructions'),
            'user_id' => $user_id,
            'company_id' => $company_id,
            // 'created_by' => logged('id'),

            'sub_total' => $this->input->post('subtotal'),//
            // 'deposit_request' => $this->input->post('adjustment_name'),//
            // 'deposit_amount' => $this->input->post('adjustment_input'),//
            'grand_total' => $this->input->post('grand_total'),//
            'tax1_total' => $this->input->post('taxes'),

            'adjustment_name' => $this->input->post('adjustment_name'),//
            'adjustment_value' => $this->input->post('adjustment_value'),//

            'markup_type' => '$',//
            'markup_amount' => $this->input->post('markup_input_form'),//

            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        );

        $addQuery = $this->estimate_model->save_estimate($new_data);

        if ($addQuery > 0) {
            //Upload attachment
            if(isset($_FILES['est_contract_upload']) && $_FILES['est_contract_upload']['tmp_name'] != '') {
                $target_dir = "./uploads/estimates/$addQuery/";            
                if(!file_exists($target_dir)) {
                    mkdir($target_dir, 0777, true);
                }

                $tmp_name = $_FILES['est_contract_upload']['tmp_name'];
                $extension = strtolower(end(explode('.',$_FILES['est_contract_upload']['name'])));
                $attachment_name = "attachment_" . basename($_FILES["est_contract_upload"]["name"]);
                move_uploaded_file($tmp_name, "./uploads/estimates/$addQuery/$attachment_name");
                $this->estimate_model->update($addQuery, ['attachments' => $attachment_name]);
            }
            //Update estimate setting
            if( $setting ){
                $estimate_setting = ['estimate_num_next' => $next_num + 1];
                $this->EstimateSettings_model->update($setting->id, $estimate_setting);
            }

            // Record Standard Estimate Save to Customer Activities Module in Customer Dashboard
            $action = "$user_login created a standard estimate with you. <a href='#' onclick='window.open(`".base_url('estimate/view/').$addQuery."`, `_blank`, `location=yes,height=1080,width=1500,scrollbars=yes,status=yes`);'>".$this->input->post('estimate_number')."</a>";

            $customerLogPayload = array(
                'date' => date('m/d/Y')."<br>".date('h:i A'),
                'customer_id' => $this->input->post('customer_id'),
                'user_id' => logged('id'),
                'logs' => "$action"
            );
            $customerLogsRecording = $this->customer_model->recordActivityLogs($customerLogPayload);


            customerAuditLog(logged('id'), $this->input->post('customer_id'), $addQuery, 'Estimate', 'Created estimate #'.$this->input->post('estimate_number'));

            //SMS Notification
            createCronAutoSmsNotification($company_id, $addQuery, 'estimate', $this->input->post('status'), $user_id);

            // $new_data2 = array(
            //     'item_type' => $this->input->post('type'),
            //     'description' => $this->input->post('desc'),
            //     'qty' => $this->input->post('qty'),
            //     'location' => $this->input->post('location'),
            //     'cost' => $this->input->post('cost'),
            //     'discount' => $this->input->post('discount'),
            //     'tax' => $this->input->post('tax'),
            //     'type' => '1',
            //     'type_id' => $addQuery,
            //     'status' => '1',
            //     'created_at' => date("Y-m-d H:i:s"),
            //     'updated_at' => date("Y-m-d H:i:s")
            // );
            // $a = $this->input->post('items');
            // $b = $this->input->post('item_type');
            // // $c = $this->input->post('desc');
            // $d = $this->input->post('quantity');
            // // $e = $this->input->post('location');
            // $f = $this->input->post('price');
            // $g = $this->input->post('discount');
            // $h = $this->input->post('tax');
            // $ii = $this->input->post('total');

            // $i = 0;
            // foreach ($a as $row) {
            //     $data['item'] = $a[$i];
            //     $data['item_type'] = $b[$i];
            //     // $data['description'] = $c[$i];
            //     $data['qty'] = $d[$i];
            //     // $data['location'] = $e[$i];
            //     $data['cost'] = $f[$i];
            //     $data['discount'] = $g[$i];
            //     $data['tax'] = $h[$i];
            //     $data['total'] = $ii[$i];
            //     $data['type'] = 'Standard Estimate';
            //     $data['type_id'] = $addQuery;
            //     $data['status'] = '1';
            //     $data['created_at'] = date("Y-m-d H:i:s");
            //     $data['updated_at'] = date("Y-m-d H:i:s");
            //     $addQuery2 = $this->accounting_invoices_model->additem_details($data);
            //     $i++;

                $a          = $this->input->post('itemid');
                $quantity   = $this->input->post('quantity');
                $price      = $this->input->post('price');
                $tax        = $this->input->post('tax');
                $gtotal     = $this->input->post('total');
                $discount   = $this->input->post('discount');

                $i = 0;
                $a = is_array($a) ? $a : [];
                foreach($a as $row){    
                    if (empty($a[$i])) {
                        continue;
                    }
    
                    $data['items_id'] = $a[$i];
                    $data['qty']   = $quantity[$i];
                    $data['cost']  = $price[$i];
                    $data['tax']   =  $tax[$i];
                    $data['total'] = $gtotal[$i];
                    $data['discount'] = $discount[$i];
                    $data['estimates_id '] = $addQuery;
                    $addQuery2 = $this->estimate_model->add_estimate_items($data);
                    $i++;
                }

            // }
            $userid = logged('id');

            $getname = $this->estimate_model->getname($userid);

                $notif = array(
            
                    'user_id'               => $userid,
                    'title'                 => 'New Estimates',
                    'content'               => $getname->FName. ' has created new Estimates.'. $this->input->post('estimate_number'),
                    'date_created'          => date("Y-m-d H:i:s"),
                    'status'                => '1',
                    'company_id'            => getLoggedCompanyID()
                );
    
                $notification = $this->estimate_model->save_notification($notif);

            if (!is_null($this->input->get('json', TRUE))) {
                header('content-type: application/json');
                exit(json_encode(['id' => $addQuery]));
            } else {
                redirect('estimate');
            }
        } else {
            echo json_encode(0);
        }
    }


    public function add()
    {
        $this->load->model('AcsProfile_model');

        $query_autoincrment = $this->db->query("SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE table_name = 'customer_groups'");
        $result_autoincrement = $query_autoincrment->result_array();

        if (count($result_autoincrement)) {
            if ($result_autoincrement[0]['AUTO_INCREMENT']) {
                $this->page_data['auto_increment_estimate_id'] = 0000001;
            } else {
                $this->page_data['auto_increment_estimate_id'] = $result_autoincrement[0]['AUTO_INCREMENT'];
            }
        } else {
            $this->page_data['auto_increment_estimate_id'] = 0000000;
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
        /*if ($role == 1 || $role == 2) {
            // $this->page_data['customers'] = $this->AcsProfile_model->getAllByCompanyId($company_id);
            $this->page_data['customers'] = $this->AcsProfile_model->getAll();
        } else {
            // $this->page_data['customers'] = $this->AcsProfile_model->getAll();
            $this->page_data['customers'] = $this->AcsProfile_model->getAllByCompanyId($company_id);
        }*/

        $this->page_data['customers'] = $this->AcsProfile_model->getAllByCompanyId($company_id);

        $default_customer_id = 0;
        if( $this->input->get('cus_id') ){
            $default_customer_id = $this->input->get('cus_id');

        }                
        $type = $this->input->get('type');
        $this->page_data['type'] = $type;
        $this->page_data['default_customer_id'] = $default_customer_id;
        $this->page_data['plans'] = $this->plans_model->getByWhere(['company_id' => $company_id]);
        $this->page_data['number'] = $this->estimate_model->getlastInsert();
        $this->page_data['items'] = $this->items_model->getItemlist();
        $this->page_data['packages'] = $this->estimate_model->getPackagelist($company_id);

        // $this->page_data['file_selection'] = $this->load->view('modals/file_vault_selection', array(), TRUE);
        $this->load->view('estimate/add', $this->page_data);
        // print_r($this->page_data['customers']);
    }

    public function addoptions()
    {
        $this->load->model('AcsProfile_model');

        $query_autoincrment = $this->db->query("SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE table_name = 'customer_groups'");
        $result_autoincrement = $query_autoincrment->result_array();

        if (count($result_autoincrement)) {
            if ($result_autoincrement[0]['AUTO_INCREMENT']) {
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
        /*if ($role == 1 || $role == 2) {
            $this->page_data['customers'] = $this->AcsProfile_model->getAll();
        // $this->page_data['customers'] = $this->AcsProfile_model->getAllByCompanyId($company_id);
        } else {
            // $this->page_data['customers'] = $this->AcsProfile_model->getAll();
            $this->page_data['customers'] = $this->AcsProfile_model->getAllByCompanyId($company_id);
        }*/
        $this->page_data['customers'] = $this->AcsProfile_model->getAllByCompanyId($company_id);

        $default_customer_id = 0;
        if( $this->input->get('cus_id') ){
            $default_customer_id = $this->input->get('cus_id');

        } 
        $this->page_data['default_customer_id'] = $default_customer_id;

        $type = $this->input->get('type');
        $this->page_data['type'] = $type;
        $this->page_data['plans'] = $this->plans_model->getByWhere(['company_id' => $company_id]);
        $this->page_data['number'] = $this->estimate_model->getlastInsert();
        $this->page_data['items'] = $this->items_model->getItemlist();

        // $this->page_data['file_selection'] = $this->load->view('modals/file_vault_selection', array(), TRUE);
        $this->load->view('estimate/addoptions', $this->page_data);
    }

    public function delete_estimate()
    {
        $is_success = false;

        $id = $this->input->post('id');        
        $estimate = $this->estimate_model->getById($id);
        if( $estimate ){
            $data = array(
                'id' => $id,
                'view_flag' => '1',
            );

            $is_success = $this->estimate_model->deleteEstimate($data);    

            customerAuditLog(logged('id'), $estimate->customer_id, $estimate->id, 'Estimate', 'Deleted estimate #'.$estimate->estimate_number);
        }  

        echo json_encode($is_success);

        
    }

    public function addbundle()
    {
        $this->load->model('AcsProfile_model');

        $query_autoincrment = $this->db->query("SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE table_name = 'customer_groups'");
        $result_autoincrement = $query_autoincrment->result_array();

        if (count($result_autoincrement)) {
            if ($result_autoincrement[0]['AUTO_INCREMENT']) {
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
        /*if ($role == 1 || $role == 2) {
            // $this->page_data['customers'] = $this->AcsProfile_model->getAllByCompanyId($company_id);
            $this->page_data['customers'] = $this->AcsProfile_model->getAll();
        } else {
            // $this->page_data['customers'] = $this->AcsProfile_model->getAll();
            $this->page_data['customers'] = $this->AcsProfile_model->getAllByCompanyId($company_id);
        }*/
        $this->page_data['customers'] = $this->AcsProfile_model->getAllByCompanyId($company_id);

        $default_customer_id = 0;
        if( $this->input->get('cus_id') ){
            $default_customer_id = $this->input->get('cus_id');

        } 
        $this->page_data['default_customer_id'] = $default_customer_id;

        $type = $this->input->get('type');
        $this->page_data['type'] = $type;
        $this->page_data['plans'] = $this->plans_model->getByWhere(['company_id' => $company_id]);
        $this->page_data['number'] = $this->estimate_model->getlastInsert();
        $this->page_data['items'] = $this->items_model->getItemlist();

        // $this->page_data['file_selection'] = $this->load->view('modals/file_vault_selection', array(), TRUE);
        $this->load->view('estimate/addbundle', $this->page_data);
    }

    public function savenewestimateBundle()
    {
        $company_id  = getLoggedCompanyID();
        $user_id  = getLoggedUserID();

        $new_data = array(
            'customer_id' => $this->input->post('customer_id'),
            'job_location' => $this->input->post('job_location'),
            'job_name' => $this->input->post('job_name'),
            'estimate_number' => $this->input->post('estimate_number'),
            // 'email' => $this->input->post('email'),
            // 'billing_address' => $this->input->post('billing_address'),
            'estimate_date' => $this->input->post('estimate_date'),
            'expiry_date' => $this->input->post('expiry_date'),
            'purchase_order_number' => $this->input->post('purchase_order_number'),
            'status' => $this->input->post('status'),
            'estimate_type' => 'Bundle',
            'type' => $this->input->post('estimate_type'),
            'attachments' => 'testing',
            'status' => $this->input->post('status'),
            'deposit_request' => $this->input->post('deposit_request'),
            'deposit_amount' => $this->input->post('deposit_amount'),
            'customer_message' => $this->input->post('customer_message'),
            'terms_conditions' => $this->input->post('terms_conditions'),
            'instructions' => $this->input->post('instructions'),

            // 'estimate_type' => 'Bundle',
            'bundle1_message' => $this->input->post('bundle1_message'),
            'bundle2_message' => $this->input->post('bundle2_message'),
            // 'bundle1_total' => $this->input->post('bundle1_total'),
            // 'bundle2_total' => $this->input->post('bundle2_total'),
            'bundle_discount' => $this->input->post('bundle_discount'),


            'user_id' => $user_id,
            'company_id' => $company_id,
            // 'created_by' => logged('id'),

            // 'sub_total' => $this->input->post('sub_total'),
            'deposit_request' => '$',
            'deposit_amount' => $this->input->post('adjustment_input'),//
            'bundle1_total' => $this->input->post('grand_total'),//
            'bundle2_total' => $this->input->post('grand_total2'),//
            'sub_total' => $this->input->post('sub_total'),//
            'sub_total2' => $this->input->post('sub_total2'),//

            'tax1_total' => $this->input->post('total_tax_'),
            'tax2_total' => $this->input->post('total_tax2_'),

            'grand_total' => $this->input->post('supergrandtotal'),//

            'adjustment_name' => $this->input->post('adjustment_name'),//
            'adjustment_value' => $this->input->post('adjustment_input'),//

            'markup_type' => '$',//
            'markup_amount' => $this->input->post('markup_input_form'),//

            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        );

        $addQuery = $this->estimate_model->save_estimate($new_data);
        if ($addQuery > 0) {
            // $a = $this->input->post('items');
            // $b = $this->input->post('item_type');
            // $d = $this->input->post('quantity');
            // $f = $this->input->post('price');
            // $g = $this->input->post('discount');
            // $h = $this->input->post('tax');
            // $ii = $this->input->post('total');

            // $i = 0;
            // foreach ($a as $row) {
            //     $data['item'] = $a[$i];
            //     $data['item_type'] = $b[$i];
            //     $data['qty'] = $d[$i];
            //     $data['cost'] = $f[$i];
            //     $data['discount'] = $g[$i];
            //     $data['tax'] = $h[$i];
            //     $data['total'] = $ii[$i];
            //     $data['type'] = 'Bundle Estimate';
            //     $data['type_id'] = $addQuery;
            //     $data['status'] = '1';
            //     $data['estimate_type'] = 'Bundle';
            //     $data['bundle_option_type'] = '1';
            //     $data['created_at'] = date("Y-m-d H:i:s");
            //     $data['updated_at'] = date("Y-m-d H:i:s");
            //     $addQuery2 = $this->accounting_invoices_model->additem_details($data);
            //     $i++;
            // }

            // $j = $this->input->post('items2');
            // $k = $this->input->post('item_type2');
            // $l = $this->input->post('quantity2');
            // $m = $this->input->post('price2');
            // $n = $this->input->post('discount2');
            // $o = $this->input->post('tax2');
            // $p = $this->input->post('total2');

            // $z = 0;
            // foreach ($j as $row2) {
            //     $data2['item'] = $j[$z];
            //     $data2['item_type'] = $k[$z];
            //     $data2['qty'] = $l[$z];
            //     $data2['cost'] = $m[$z];
            //     $data2['discount'] = $n[$z];
            //     $data2['tax'] = $o[$z];
            //     $data2['total'] = $p[$z];
            //     $data2['type'] = 'Bundle Estimate';
            //     $data2['type_id'] = $addQuery;
            //     $data2['status'] = '1';
            //     $data2['estimate_type'] = 'Bundle';
            //     $data2['bundle_option_type'] = '2';
            //     $data2['created_at'] = date("Y-m-d H:i:s");
            //     $data2['updated_at'] = date("Y-m-d H:i:s");
            //     $addQuery3 = $this->accounting_invoices_model->additem_details($data2);
            //     $z++;
            // }
            // redirect('estimate');

            $a          = $this->input->post('itemid');
            // $packageID  = $this->input->post('packageID');
            $quantity   = $this->input->post('quantity');
            $price      = $this->input->post('price');
            $h          = $this->input->post('tax');
            $discount   = $this->input->post('discount');
            $total      = $this->input->post('total');

            $i = 0;
            foreach($a as $row){
                if (empty($a[$i])) {
                    continue;
                }

                $data['items_id']       = $a[$i];
                // $data['package_id ']    = $packageID[$i];
                $data['qty']            = $quantity[$i];
                $data['cost']           = $price[$i];
                $data['tax']            = $h[$i];
                $data['discount']       = $discount[$i];
                $data['total']          = $total[$i];
                $data['estimate_type']  = 'Bundle';
                $data['estimates_id ']  = $addQuery;
                $data['bundle_option_type'] = '1';
                $addQuery2 = $this->estimate_model->add_estimate_details($data);
                $i++;
            }

            $a2          = $this->input->post('itemid2');
            // $packageID  = $this->input->post('packageID');
            $quantity2   = $this->input->post('quantity2');
            $price2      = $this->input->post('price2');
            $h2          = $this->input->post('tax2');
            $discount2   = $this->input->post('discount2');
            $total2      = $this->input->post('total2');

            $i2 = 0;
            foreach($a2 as $row2){
                $data2['items_id']       = $a2[$i2];
                // $data['package_id ']    = $packageID[$i];
                $data2['qty']            = $quantity2[$i2];
                $data2['cost']           = $price2[$i2];
                $data2['tax']            = $h2[$i2];
                $data2['discount']       = $discount2[$i2];
                $data2['total']          = $total2[$i2];
                $data2['estimate_type']  = 'Bundle';
                $data2['estimates_id ']  = $addQuery;
                $data2['bundle_option_type'] = '2';
                $addQuery2 = $this->estimate_model->add_estimate_details($data2);
                $i2++;
            }

            // $getname = $this->workorder_model->getname($user_id);

            // $notif = array(
        
            //     'user_id'               => $user_id,
            //     'title'                 => 'New Work Order',
            //     'content'               => $getname->FName. ' has created new Work Order.'. $this->input->post('workorder_number'),
            //     'date_created'          => date("Y-m-d H:i:s"),
            //     'status'                => '1',
            //     'company_id'            => getLoggedCompanyID()
            // );

            // $notification = $this->workorder_model->save_notification($notif);

            $userid = logged('id');

            $getname = $this->estimate_model->getname($userid);

                $notif = array(
            
                    'user_id'               => $userid,
                    'title'                 => 'New Estimates',
                    'content'               => $getname->FName. ' has created new Bundle Estimates.'. $this->input->post('estimate_number'),
                    'date_created'          => date("Y-m-d H:i:s"),
                    'status'                => '1',
                    'company_id'            => getLoggedCompanyID()
                );
    
                $notification = $this->estimate_model->save_notification($notif);
                
            if (!is_null($this->input->get('json', TRUE))) {
                header('content-type: application/json');
                exit(json_encode(['id' => $addQuery]));
            } else {
                redirect('estimate');
            }
        } else {
            echo json_encode(0);
        }
    }

    public function savenewestimateOptions()
    {
        $company_id  = getLoggedCompanyID();
        $user_id  = getLoggedUserID();

        $new_data = array(
            'customer_id' => $this->input->post('customer_id'),
            'job_location' => $this->input->post('job_location'),
            'job_name' => $this->input->post('job_name'),
            'estimate_number' => $this->input->post('estimate_number'),
            'estimate_date' => $this->input->post('estimate_date'),
            'expiry_date' => $this->input->post('expiry_date'),
            'purchase_order_number' => $this->input->post('purchase_order_number'),
            'status' => $this->input->post('status'),
            'estimate_type' => 'Option',
            'type' => $this->input->post('estimate_type'),
            'attachments' => 'testing',
            // 'status' => $this->input->post('status'),
            'deposit_request' => $this->input->post('deposit_request'),
            'deposit_amount' => $this->input->post('deposit_amount'),
            'customer_message' => $this->input->post('customer_message'),
            'terms_conditions' => $this->input->post('terms_conditions'),
            'instructions' => $this->input->post('instructions'),
            
            'option_message' => $this->input->post('option1_message'),
            'option2_message' => $this->input->post('option2_message'),
            'option1_total' => $this->input->post('grand_total'),
            'option2_total' => $this->input->post('grand_total2'),
            // 'bundle_discount' => $this->input->post('bundle_discount'),
            'tax1_total' => $this->input->post('total_tax_'),
            'tax2_total' => $this->input->post('total_tax2_'),
            'sub_total' => $this->input->post('sub_total'),//
            'sub_total2' => $this->input->post('sub_total2'),//

            // 'tax1_total' => $this->input->post('total_tax_'),
            // 'tax2_total' => $this->input->post('total_tax2_'),

            // 'grand_total' => $this->input->post('supergrandtotal'),
            

            'user_id' => $user_id,
            'company_id' => $company_id,
            
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        );

        $addQuery = $this->estimate_model->save_estimate($new_data);

        // GET CUSTOMER AND USER INFO
            $getUserInfo = array(
                'where' => array('id' => logged('id')),
                'table' => 'users'
            );
            $getUserInfo = $this->general->get_data_with_param($getUserInfo, false);

            $getCustomerInfo = array(
                'where' => array('prof_id' => $this->input->post('customer_id')),
                'table' => 'acs_profile'
            );
            $getCustomerInfo = $this->general->get_data_with_param($getCustomerInfo, false);

            // STANDARD ESTIMATE CUSTOMER ACTIVITY LOG RECORDING
            $customerLogsRecording = array(
                'date' => date('m/d/Y')."<br>".date('h:i A'),
                'customer_id' => $this->input->post('customer_id'),
                'user_id' => logged('id'),
                'logs' => "$getUserInfo->FName $getUserInfo->LName created an option estimate with you. <a href='#' onclick='window.open(`".base_url('estimate/view/').$addQuery."`, `_blank`, `location=yes,height=1080,width=1500,scrollbars=yes,status=yes`);'>".$this->input->post('estimate_number')."</a>"
            );
            $customerLogsRecording = $this->customer_model->recordActivityLogs($customerLogsRecording);


        // if ($addQuery > 0) {
        //     $a = $this->input->post('items');
        //     $b = $this->input->post('item_type');
        //     $d = $this->input->post('quantity');
        //     $f = $this->input->post('price');
        //     $g = $this->input->post('discount');
        //     $h = $this->input->post('tax');
        //     $ii = $this->input->post('total');

        //     $i = 0;
        //     foreach ($a as $row) {
        //         $data['item'] = $a[$i];
        //         $data['item_type'] = $b[$i];
        //         $data['qty'] = $d[$i];
        //         $data['cost'] = $f[$i];
        //         $data['discount'] = $g[$i];
        //         $data['tax'] = $h[$i];
        //         $data['total'] = $ii[$i];
        //         $data['type'] = 'Option Estimate';
        //         $data['type_id'] = $addQuery;
        //         $data['status'] = '1';
        //         $data['estimate_type'] = 'Option';
        //         $data['bundle_option_type'] = '1';
        //         $data['created_at'] = date("Y-m-d H:i:s");
        //         $data['updated_at'] = date("Y-m-d H:i:s");
        //         $addQuery2 = $this->accounting_invoices_model->additem_details($data);
        //         $i++;
        //     }

        //     $j = $this->input->post('items2');
        //     $k = $this->input->post('item_type2');
        //     $l = $this->input->post('quantity2');
        //     $m = $this->input->post('price2');
        //     $n = $this->input->post('discount2');
        //     $o = $this->input->post('tax2');
        //     $p = $this->input->post('total2');

        //     $z = 0;
        //     foreach ($j as $row2) {
        //         $data2['item'] = $j[$z];
        //         $data2['item_type'] = $k[$z];
        //         $data2['qty'] = $l[$z];
        //         $data2['cost'] = $m[$z];
        //         $data2['discount'] = $n[$z];
        //         $data2['tax'] = $o[$z];
        //         $data2['total'] = $p[$z];
        //         $data2['type'] = 'Option Estimate';
        //         $data2['type_id'] = $addQuery;
        //         $data2['status'] = '1';
        //         $data2['estimate_type'] = 'Option';
        //         $data2['bundle_option_type'] = '2';
        //         $data2['created_at'] = date("Y-m-d H:i:s");
        //         $data2['updated_at'] = date("Y-m-d H:i:s");
        //         $addQuery3 = $this->accounting_invoices_model->additem_details($data2);
        //         $z++;
        //     }
    
        //     redirect('estimate');
        // } 
        if($addQuery > 0){
            $a          = $this->input->post('itemid');
            // $packageID  = $this->input->post('packageID');
            $quantity   = $this->input->post('quantity');
            $price      = $this->input->post('price');
            $h          = $this->input->post('tax');
            $discount   = $this->input->post('discount');
            $total      = $this->input->post('total');

            $i = 0;
            foreach($a as $row){
                if (empty($a[$i])) {
                    continue;
                }

                $data['items_id']       = $a[$i];
                // $data['package_id ']    = $packageID[$i];
                $data['qty']            = $quantity[$i];
                $data['cost']           = $price[$i];
                $data['tax']            = $h[$i];
                $data['discount']       = $discount[$i];
                $data['total']          = $total[$i];
                $data['estimate_type']  = 'Option';
                $data['estimates_id ']  = $addQuery;
                $data['bundle_option_type'] = '1';
                $addQuery2 = $this->estimate_model->add_estimate_details($data);
                $i++;
            }

            $a2          = $this->input->post('itemid2');
            // $packageID  = $this->input->post('packageID');
            $quantity2   = $this->input->post('quantity2');
            $price2      = $this->input->post('price2');
            $h2          = $this->input->post('tax2');
            $discount2   = $this->input->post('discount2');
            $total2      = $this->input->post('total2');

            $i2 = 0;
            foreach($a2 as $row2){
                if (empty($a2[$i2])) {
                    continue;
                }

                $data2['items_id']       = $a2[$i2];
                // $data['package_id ']    = $packageID[$i];
                $data2['qty']            = $quantity2[$i2];
                $data2['cost']           = $price2[$i2];
                $data2['tax']            = $h2[$i2];
                $data2['discount']       = $discount2[$i2];
                $data2['total']          = $total2[$i2];
                $data2['estimate_type']  = 'Option';
                $data2['estimates_id ']  = $addQuery;
                $data2['bundle_option_type'] = '2';
                $addQuery2 = $this->estimate_model->add_estimate_details($data2);
                $i2++;
            }

            // $getname = $this->workorder_model->getname($user_id);

            // $notif = array(
        
            //     'user_id'               => $user_id,
            //     'title'                 => 'New Work Order',
            //     'content'               => $getname->FName. ' has created new Work Order.'. $this->input->post('workorder_number'),
            //     'date_created'          => date("Y-m-d H:i:s"),
            //     'status'                => '1',
            //     'company_id'            => getLoggedCompanyID()
            // );

            // $notification = $this->workorder_model->save_notification($notif);

            $userid = logged('id');

            $getname = $this->estimate_model->getname($userid);

                $notif = array(
            
                    'user_id'               => $userid,
                    'title'                 => 'New Estimates',
                    'content'               => $getname->FName. ' has created new Options Estimates.'. $this->input->post('estimate_number'),
                    'date_created'          => date("Y-m-d H:i:s"),
                    'status'                => '1',
                    'company_id'            => getLoggedCompanyID()
                );
    
                $notification = $this->estimate_model->save_notification($notif);


            if (!is_null($this->input->get('json', TRUE))) {
                header('content-type: application/json');
                exit(json_encode(['id' => $addQuery]));
            } else {
                redirect('estimate');
            }
        }
        else {
            echo json_encode(0);
        }
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

        customerAuditLog(logged('id'), post('customer_id'), $id, 'Estimate', 'Created estimate #'.post('estimate_number'));

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
        $this->page_data['items_data'] = $this->estimate_model->getEstimatesItems($id);
        
        $this->page_data['items'] = $this->items_model->getItemlist();
        $this->page_data['itemsDetails'] = $this->estimate_model->getItemlistByID($id);
        $this->page_data['packages'] = $this->estimate_model->getPackagelist($company_id);

        $this->load->view('estimate/edit', $this->page_data);
    }

    public function editOption($id)
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
        $this->page_data['items_data'] = $this->estimate_model->getEstimatesItems($id);
        
        $this->page_data['items'] = $this->items_model->getItemlist();
        $this->page_data['itemsDetails'] = $this->estimate_model->getItemlistByID($id);
        $this->page_data['itemsOption1'] = $this->estimate_model->getItemlistByIDOption1($id);
        $this->page_data['itemsOption2'] = $this->estimate_model->getItemlistByIDOption2($id);
        $this->page_data['packages'] = $this->estimate_model->getPackagelist($company_id);

        $this->load->view('estimate/editOption', $this->page_data);
    }

    public function editBundle($id)
    {
        $this->load->model('AcsProfile_model');

        $company_id = logged('company_id');
        $user_id = logged('id');
        $role    = logged('role');
        //$parent_id = $this->db->query("select parent_id from users where id=$user_id")->row();

        /*if ($role == 1 || $role == 2) {
            $this->page_data['users'] = $this->users_model->getAllUsers();
            $this->page_data['customers'] = $this->AcsProfile_model->getAll();
        } else {
            $this->page_data['users'] = $this->users_model->getAllUsersByCompany($user_id);
            $this->page_data['customers'] = $this->AcsProfile_model->getAllByCompanyId($company_id);
        }*/

        $this->page_data['users'] = $this->users_model->getAllUsersByCompany($user_id);
        $this->page_data['customers'] = $this->AcsProfile_model->getAllByCompanyId($company_id);


        $this->load->model('Customer_model', 'customer_model');

        $this->page_data['estimate'] = $this->estimate_model->getById($id);
        $this->page_data['estimate']->customer = $this->customer_model->getCustomer($this->page_data['estimate']->customer_id);
        $this->page_data['plans'] = $this->plans_model->getByWhere(['company_id' => $company_id]);
        $this->page_data['items_data'] = $this->estimate_model->getEstimatesItems($id);
        
        $this->page_data['items'] = $this->items_model->getItemlist();
        $this->page_data['itemsDetails'] = $this->estimate_model->getItemlistByID($id);

        $this->page_data['itemsBundle1'] = $this->estimate_model->getItemlistByIDBundle1($id);
        $this->page_data['itemsBundle2'] = $this->estimate_model->getItemlistByIDBundle2($id);

        $this->page_data['packages'] = $this->estimate_model->getPackagelist($company_id);

        $this->load->view('estimate/editBundle', $this->page_data);
    }


    public function update_old($id)
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

    public function update($id)
    {
        $company_id  = getLoggedCompanyID();
        $user_id     = getLoggedUserID();
        $estimate    = $this->estimate_model->getById($id);
        $user_login = logged('FName') . ' ' . logged('LName');

        $attachment_name = $estimate->attachments;
        if(isset($_FILES['est_contract_upload']) && $_FILES['est_contract_upload']['tmp_name'] != '') {
            $target_dir = "./uploads/estimates/$estimate->id/";            
            if(!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true);
            }
                        
            $tmp_name = $_FILES['est_contract_upload']['tmp_name'];
            $extension = strtolower(end(explode('.',$_FILES['est_contract_upload']['name'])));
            $attachment_name = "attachment_" . basename($_FILES["est_contract_upload"]["name"]);
            move_uploaded_file($tmp_name, "./uploads/estimates/$estimate->id/$attachment_name");
        }

        $new_data = array(
            'id'        => $id,
            'customer_id' => $this->input->post('customer_id'),
            'job_location' => $this->input->post('job_location'),
            'job_name' => $this->input->post('job_name'),
            'estimate_number' => $estimate->estimate_number,
            // 'email' => $this->input->post('email'),
            // 'billing_address' => $this->input->post('billing_address'),
            'estimate_date' => $this->input->post('estimate_date'),
            'expiry_date' => $this->input->post('expiry_date'),
            'purchase_order_number' => $this->input->post('purchase_order_number'),
            'status' => $this->input->post('status'),
            'estimate_type' => 'Standard',
            'type' => $this->input->post('estimate_type'),
            // 'ship_via' => $this->input->post('ship_via'),
            // 'ship_date' => $this->input->post('ship_date'),
            // 'tracking_no' => $this->input->post('tracking_no'),
            // 'ship_to' => $this->input->post('ship_to'),
            // 'tags' => $this->input->post('tags'),
            'attachments' => $attachment_name,
            // 'message_invoice' => $this->input->post('message_invoice'),
            // 'message_statement' => $this->input->post('message_statement'),
            // 'status' => $this->input->post('status'),
            'deposit_request' => $this->input->post('deposit_request'),
            'deposit_amount' => $this->input->post('deposit_amount'),
            'customer_message' => $this->input->post('customer_message'),
            'terms_conditions' => $this->input->post('terms_conditions'),
            'instructions' => $this->input->post('instructions'),
            'user_id' => $user_id,
            'company_id' => $company_id,
            // 'created_by' => logged('id'),

            'sub_total' => $this->input->post('subtotal'),//
            // 'deposit_request' => $this->input->post('adjustment_name'),//
            // 'deposit_amount' => $this->input->post('adjustment_input'),//
            'grand_total' => $this->input->post('grand_total'),//
            'tax1_total' => $this->input->post('taxes'),

            'adjustment_name' => $this->input->post('adjustment_name'),//
            'adjustment_value' => $this->input->post('adjustment_value'),//

            'markup_type' => '$',//
            'markup_amount' => $this->input->post('markup_input_form'),//

            // 'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        );

        $addQuery = $this->estimate_model->update_estimate($new_data);

        if ($addQuery) {
            // Record Standard Estimate Update to Customer Activities Module in Customer Dashboard
            $action = "$user_login updated a standard estimate. <a href='#' onclick='window.open(`".base_url('estimate/view/').$id."`, `_blank`, `location=yes,height=1080,width=1500,scrollbars=yes,status=yes`);'>".$this->input->post('estimate_number')."</a>";

            $customerLogPayload = array(
                'date' => date('m/d/Y')."<br>".date('h:i A'),
                'customer_id' => $this->input->post('customer_id'),
                'user_id' => logged('id'),
                'logs' => "$action"
            );
            $customerLogsRecording = $this->customer_model->recordActivityLogs($customerLogPayload);
        }

        //SMS Notification
        createCronAutoSmsNotification($company_id, $id, 'estimate', $this->input->post('status'), $user_id);

        // if ($addQuery > 0) {
            // $new_data2 = array(
            //     'item_type' => $this->input->post('type'),
            //     'description' => $this->input->post('desc'),
            //     'qty' => $this->input->post('qty'),
            //     'location' => $this->input->post('location'),
            //     'cost' => $this->input->post('cost'),
            //     'discount' => $this->input->post('discount'),
            //     'tax' => $this->input->post('tax'),
            //     'type' => '1',
            //     'type_id' => $addQuery,
            //     'status' => '1',
            //     'created_at' => date("Y-m-d H:i:s"),
            //     'updated_at' => date("Y-m-d H:i:s")
            // );
            // $a = $this->input->post('items');
            // $b = $this->input->post('item_type');
            // // $c = $this->input->post('desc');
            // $d = $this->input->post('quantity');
            // // $e = $this->input->post('location');
            // $f = $this->input->post('price');
            // $g = $this->input->post('discount');
            // $h = $this->input->post('tax');
            // $ii = $this->input->post('total');

            // $i = 0;
            // foreach ($a as $row) {
            //     $data['item'] = $a[$i];
            //     $data['item_type'] = $b[$i];
            //     // $data['description'] = $c[$i];
            //     $data['qty'] = $d[$i];
            //     // $data['location'] = $e[$i];
            //     $data['cost'] = $f[$i];
            //     $data['discount'] = $g[$i];
            //     $data['tax'] = $h[$i];
            //     $data['total'] = $ii[$i];
            //     $data['type'] = 'Standard Estimate';
            //     $data['type_id'] = $addQuery;
            //     $data['status'] = '1';
            //     $data['created_at'] = date("Y-m-d H:i:s");
            //     $data['updated_at'] = date("Y-m-d H:i:s");
            //     $addQuery2 = $this->accounting_invoices_model->additem_details($data);
            //     $i++;

            $delete2 = $this->estimate_model->delete_items($id);

                $a          = $this->input->post('itemid');
                $quantity   = $this->input->post('quantity');
                $price      = $this->input->post('price');
                $h          = $this->input->post('tax');
                $gtotal     = $this->input->post('total');
                $discount   = $this->input->post('discount');

                $i = 0;
                $a = is_array($a) ? $a : [];
                foreach($a as $row){
                    if (empty($a[$i])) {
                        continue;
                    }

                    $data['items_id'] = $a[$i];
                    $data['qty'] = $quantity[$i];
                    $data['cost'] = $price[$i];
                    $data['tax'] = $h[$i];
                    $data['total'] = $gtotal[$i];
                    $data['discount'] = $discount[$i];
                    $data['estimates_id '] = $id;
                    $addQuery2 = $this->estimate_model->add_estimate_items($data);
                    $i++;
                }

            // }

            if (!is_null($this->input->get('json', TRUE))) {
                header('content-type: application/json');
                exit(json_encode(['id' => $addQuery]));
            } else {
                redirect('estimate');
            }
        // } else {
        //     echo json_encode(0);
        // }
    }

    public function updateestimateBundle($id)
    {
        $company_id  = getLoggedCompanyID();
        $user_id  = getLoggedUserID();
        if( $this->input->post('customer_id') > 0 ){
            $new_data = array(
                'id'                        => $id,
                'customer_id'               => $this->input->post('customer_id'),
                'job_location'              => $this->input->post('job_location'),
                'job_name'                  => $this->input->post('job_name'),
                // 'estimate_number'           => $this->input->post('estimate_number'),
                // 'email' => $this->input->post('email'),
                // 'billing_address' => $this->input->post('billing_address'),
                'estimate_date'             => $this->input->post('estimate_date'),
                'expiry_date'               => $this->input->post('expiry_date'),
                'purchase_order_number'     => $this->input->post('purchase_order_number'),
                'status'                    => $this->input->post('status'),
                'estimate_type'             => 'Bundle',
                'type'                      => $this->input->post('estimate_type'),
                'attachments'               => 'testing',
                'status'                    => $this->input->post('status'),
                'deposit_request'           => $this->input->post('deposit_request'),
                'deposit_amount'            => $this->input->post('deposit_amount'),
                'customer_message'          => $this->input->post('customer_message'),
                'terms_conditions'          => $this->input->post('terms_conditions'),
                'instructions'              => $this->input->post('instructions'),

                // 'estimate_type' => 'Bundle',
                'bundle1_message'           => $this->input->post('bundle1_message'),
                'bundle2_message'           => $this->input->post('bundle2_message'),
                // 'bundle1_total' => $this->input->post('bundle1_total'),
                // 'bundle2_total' => $this->input->post('bundle2_total'),
                'bundle_discount'           => $this->input->post('bundle_discount'),

                // 'created_by' => logged('id'),

                // 'sub_total' => $this->input->post('sub_total'),
                // 'deposit_request'           => '$',
                'deposit_amount'            => $this->input->post('adjustment_input'),//
                'bundle1_total'             => $this->input->post('grand_total'),//
                'bundle2_total'             => $this->input->post('grand_total2'),//
                'sub_total'                 => $this->input->post('sub_total'),//
                'sub_total2'                => $this->input->post('sub_total2'),//

                'tax1_total'                => $this->input->post('total_tax_'),
                'tax2_total'                => $this->input->post('total_tax2_'),

                'grand_total'               => $this->input->post('supergrandtotal'),//

                'adjustment_name'           => $this->input->post('adjustment_name'),//
                'adjustment_value'          => $this->input->post('adjustment_input'),//

                'markup_type'               => '$',//
                'markup_amount'             => $this->input->post('markup_input_form'),//

                'updated_at'                => date("Y-m-d H:i:s")
            );


            $addQuery = $this->estimate_model->update_estimateBundle($new_data);

            $objEstimate = $this->estimate_model->getById($id);

            customerAuditLog(logged('id'), $objEstimate->customer_id, $objEstimate->id, 'Credit Note', 'Updated estimate #'.$objEstimate->estimate_number);

            $delete2 = $this->estimate_model->delete_items($id);

            // if ($addQuery > 0) {

                $a          = $this->input->post('itemid');
                // $packageID  = $this->input->post('packageID');
                $quantity   = $this->input->post('quantity');
                $price      = $this->input->post('price');
                $h          = $this->input->post('tax');
                $discount   = $this->input->post('discount');
                $total      = $this->input->post('total');

                $i = 0;
                $a = is_array($a) ? $a : [];
                foreach($a as $row){
                    if (empty($a[$i])) {
                        continue;
                    }

                    $data['items_id']       = $a[$i];
                    // $data['package_id ']    = $packageID[$i];
                    $data['qty']            = $quantity[$i];
                    $data['cost']           = $price[$i];
                    $data['tax']            = $h[$i];
                    $data['discount']       = $discount[$i];
                    $data['total']          = $total[$i];
                    $data['estimate_type']  = 'Bundle';
                    $data['estimates_id ']  = $id;
                    $data['bundle_option_type'] = '1';
                    $addQuery2 = $this->estimate_model->add_estimate_details($data);
                    $i++;
                }

                $a2          = $this->input->post('itemid2');
                // $packageID  = $this->input->post('packageID');
                $quantity2   = $this->input->post('quantity2');
                $price2      = $this->input->post('price2');
                $h2          = $this->input->post('tax2');
                $discount2   = $this->input->post('discount2');
                $total2      = $this->input->post('total2');

                $i2 = 0;
                $a2 = is_array($a2) ? $a2 : [];
                foreach($a2 as $row2){
                    if (empty($a2[$i2])) {
                        continue;
                    }

                    $data2['items_id']       = $a2[$i2];
                    // $data['package_id ']    = $packageID[$i];
                    $data2['qty']            = $quantity2[$i2];
                    $data2['cost']           = $price2[$i2];
                    $data2['tax']            = $h2[$i2];
                    $data2['discount']       = $discount2[$i2];
                    $data2['total']          = $total2[$i2];
                    $data2['estimate_type']  = 'Bundle';
                    $data2['estimates_id ']  = $id;
                    $data2['bundle_option_type'] = '2';
                    $addQuery2 = $this->estimate_model->add_estimate_details($data2);
                    $i2++;
                }


            if (!is_null($this->input->get('json', TRUE))) {
                header('content-type: application/json');
                exit(json_encode(['id' => $addQuery]));
            } else {
                redirect('estimate');
            }
        }else{
            $this->session->set_flashdata('alert-type', 'danger');
            $this->session->set_flashdata('alert', 'Please select customer.');

            redirect('estimate/editBundle/'.$id);
        }        
        // } else {
        //     echo json_encode(0);
        // }
    }

    public function updateestimateOptions($id)
    {
        $company_id  = getLoggedCompanyID();
        $user_id  = getLoggedUserID();

        $new_data = array(
            'id'                        => $id,
            'customer_id'               => $this->input->post('customer_id'),
            'job_location'              => $this->input->post('job_location'),
            'job_name'                  => $this->input->post('job_name'),
            // 'estimate_number'        => $this->input->post('estimate_number'),
            // 'email'                  => $this->input->post('email'),
            // 'billing_address'        => $this->input->post('billing_address'),
            'estimate_date'             => $this->input->post('estimate_date'),
            'expiry_date'               => $this->input->post('expiry_date'),
            'purchase_order_number'     => $this->input->post('purchase_order_number'),
            'status'                    => $this->input->post('status'),
            'estimate_type'             => 'Option',
            'type'                      => $this->input->post('estimate_type'),
            'attachments'               => 'testing',
            'status'                    => $this->input->post('status'),
            'deposit_request'           => $this->input->post('deposit_request'),
            'deposit_amount'            => $this->input->post('deposit_amount'),
            'customer_message'          => $this->input->post('customer_message'),
            'terms_conditions'          => $this->input->post('terms_conditions'),
            'instructions'              => $this->input->post('instructions'),

            // 'estimate_type'          => 'Bundle',
            'option_message'            => $this->input->post('option1_message'),
            'option2_message'           => $this->input->post('option2_message'),
            // 'bundle1_total'          => $this->input->post('bundle1_total'),
            // 'bundle2_total'          => $this->input->post('bundle2_total'),
            // 'bundle_discount'           => $this->input->post('bundle_discount'),

            // 'created_by'             => logged('id'),

            // 'sub_total'              => $this->input->post('sub_total'),
            // 'deposit_request'        => '$',
            // 'deposit_amount'            => $this->input->post('adjustment_input'),//
            'option1_total'             => $this->input->post('grand_total'),//
            'option2_total'             => $this->input->post('grand_total2'),//
            'sub_total'                 => $this->input->post('sub_total'),//
            'sub_total2'                => $this->input->post('sub_total2'),//

            'tax1_total'                => $this->input->post('total_tax_'),
            'tax2_total'                => $this->input->post('total_tax2_'),

            // 'grand_total'               => $this->input->post('supergrandtotal'),//

            // 'adjustment_name'           => $this->input->post('adjustment_name'),//
            // 'adjustment_value'          => $this->input->post('adjustment_input'),//

            // 'markup_type'               => '$',//
            // 'markup_amount'             => $this->input->post('markup_input_form'),//

            'updated_at'                => date("Y-m-d H:i:s")
        );

        $addQuery = $this->estimate_model->update_estimateOptions($new_data);

        $delete2 = $this->estimate_model->delete_items($id);

        // if ($addQuery > 0) {

            $a          = $this->input->post('itemid');
            // $packageID  = $this->input->post('packageID');
            $quantity   = $this->input->post('quantity');
            $price      = $this->input->post('price');
            $h          = $this->input->post('tax');
            $discount   = $this->input->post('discount');
            $total      = $this->input->post('total');

            $i = 0;
            $a = is_array($a) ? $a : [];
            foreach($a as $row){
                if (empty($a[$i])) {
                    continue;
                }

                $data['items_id']       = $a[$i];
                // $data['package_id ']    = $packageID[$i];
                $data['qty']            = $quantity[$i];
                $data['cost']           = $price[$i];
                $data['tax']            = $h[$i];
                $data['discount']       = $discount[$i];
                $data['total']          = $total[$i];
                $data['estimate_type']  = 'Option';
                $data['estimates_id ']  = $id;
                $data['bundle_option_type'] = '1';
                $addQuery2 = $this->estimate_model->add_estimate_details($data);
                $i++;
            }

            $a2          = $this->input->post('itemid2');
            // $packageID  = $this->input->post('packageID');
            $quantity2   = $this->input->post('quantity2');
            $price2      = $this->input->post('price2');
            $h2          = $this->input->post('tax2');
            $discount2   = $this->input->post('discount2');
            $total2      = $this->input->post('total2');

            $i2 = 0;
            $a2 = is_array($a2) ? $a2 : [];
            foreach($a2 as $row2){
                if (empty($a2[$i2])) {
                    continue;
                }

                $data2['items_id']       = $a2[$i2];
                // $data['package_id ']    = $packageID[$i];
                $data2['qty']            = $quantity2[$i2];
                $data2['cost']           = $price2[$i2];
                $data2['tax']            = $h2[$i2];
                $data2['discount']       = $discount2[$i2];
                $data2['total']          = $total2[$i2];
                $data2['estimate_type']  = 'Option';
                $data2['estimates_id ']  = $id;
                $data2['bundle_option_type'] = '2';
                $addQuery2 = $this->estimate_model->add_estimate_details($data2);
                $i2++;
            }


        if (!is_null($this->input->get('json', TRUE))) {
            header('content-type: application/json');
            exit(json_encode(['id' => $addQuery]));
        } else {
            redirect('estimate');
        }
        // } else {
        //     echo json_encode(0);
        // }
    }


    public function tab($index)
    {
        $this->index($index);
    }

    public function sendEstimateToAcs()
    {
        $this->load->helper(array('hashids_helper'));

        $id = $this->input->post('id');
        $wo_id = $this->input->post('est_id');

        $workData = $this->estimate_model->getEstimate($wo_id);
        // var_dump($workData);

        // $items = $this->estimate_model->getItemlistByID($wo_id);
        $c_id = $workData->company_id;
        $p_id = $workData->customer_id;

        $cliets = $this->estimate_model->get_cliets_data($c_id);
        $customerData = $this->estimate_model->get_customerData_data($p_id);

        $items_dataOP1 = $this->estimate_model->getItemlistByIDOption1($wo_id);
        $items_dataOP2 = $this->estimate_model->getItemlistByIDOption2($wo_id);

        $items_dataBD1 = $this->estimate_model->getItemlistByIDBundle1($wo_id);
        $items_dataBD2 = $this->estimate_model->getItemlistByIDBundle2($wo_id);
        $items = $this->estimate_model->getEstimatesItems($wo_id);

        $eid = hashids_encrypt($workData->id, '', 15);

        $data = array(
            // 'workorder'             => $workorder,
            'company'                       => $cliets->business_name,
            'business_address'              => $cliets->business_address,
            'phone_number'                  => $cliets->phone_number,
            'email_address'                 => $cliets->email_address,

            'acs_name'                      => $customerData->first_name.' '.$customerData->middle_name.' '.$customerData->last_name,
            'acsemail'                      => $customerData->email,
            'acsaddress'                    => $customerData->mail_add,
            'phone_m'                       => $customerData->phone_m,

            'items_dataOP1'                 => $items_dataOP1,
            'items_dataOP2'                 => $items_dataOP2,
            'items_dataBD1'                 => $items_dataBD1,
            'items_dataBD2'                 => $items_dataBD2,

            'estimate_number'               => $workData->estimate_number,
            'job_location'                  => $workData->job_location,
            'job_name'                      => $workData->job_name,
            'estimate_date'                 => $workData->estimate_date,
            'expiry_date'                   => $workData->expiry_date,
            'purchase_order_number'         => $workData->purchase_order_number,
            'status'                        => $workData->status,
            'estimate_type'                 => $workData->estimate_type,
            'type'                          => $workData->type,
            'deposit_request'               => $workData->deposit_request,
            'deposit_amount'                => $workData->deposit_amount,
            'customer_message'              => $workData->customer_message,
            'terms_conditions'              => $workData->terms_conditions,
            'instructions'                  => $workData->instructions,
            'email'                         => $workData->email,
            'phone'                         => $workData->phone_number,
            'mobile'                        => $workData->mobile_number,
            'terms_and_conditions'          => $workData->terms_and_conditions,
            'terms_of_use'                  => $workData->terms_of_use,
            'job_description'               => $workData->job_description,
            'instructions'                  => $workData->instructions,
            'bundle1_message'               => $workData->bundle1_message,
            'bundle2_message'               => $workData->bundle2_message,

            'items'                         => $items,

            'bundle_discount'               => $workData->bundle_discount,
            'deposit_amount'                => $workData->deposit_amount,
            'bundle1_total'                 => $workData->bundle1_total,
            'bundle2_total'                 => $workData->bundle2_total,

            'option_message'                => $workData->option_message,
            'option2_message'               => $workData->option2_message,
            'option1_total'                 => $workData->option1_total,
            'option2_total'                 => $workData->option2_total,

            'sub_total'                     => $workData->sub_total,
            'sub_total2'                    => $workData->sub_total2,
            'tax1_total'                    => $workData->tax1_total,
            'tax2_total'                    => $workData->tax2_total,

            'grand_total'                   => $workData->grand_total,
            'adjustment_name'               => $workData->adjustment_name,
            'adjustment_value'              => $workData->adjustment_value,
            'markup_type'                   => $workData->markup_type,
            'markup_amount'                 => $workData->markup_amount,
            'eid'                           => $eid,
            // 'source' => $source
        );

        // $recipient  = "emploucelle@gmail.com";
        $recipient  = $customerData->email;
        // $message = "This is a test email";


    $message2 = $this->load->view('estimate/send_email_acs', $data, true);
    $filename = $workData->company_representative_signature;

        include APPPATH . 'libraries/PHPMailer/PHPMailerAutoload.php';
            $server    = MAIL_SERVER;
            $port      = MAIL_PORT ;
            $username  = MAIL_USERNAME;
            $password  = MAIL_PASSWORD;
            $from      = MAIL_FROM;
            $subject   = 'nSmarTrac: Estimate Details';
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

            $mail->addAddress($recipient, $recipient);
            $mail->isHTML(true);
            // $email->attach("/home/yoursite/location-of-file.jpg", "inline");
            $mail->Subject = $subject;
            $mail->Body    = $message2;
            // $cid = $email->attachment_cid($filename);


            $json_data['is_success'] = 1;
            $json_data['error']      = '';

            if(!$mail->Send()) {
                /*echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
                exit;*/
                $json_data['is_success'] = 0;
                $json_data['error']      = 'Mailer Error: ' . $mail->ErrorInfo;
            }

            customerAuditLog(logged('id'), $workData->customer_id, $workData->id, 'Estimate', 'Sent to email estimate #'.$workData->estimate_number);

            $this->session->set_flashdata('alert-type', 'success');
            $this->session->set_flashdata('alert', 'Successfully sent to Customer.');

            echo json_encode($json_data);
        // return true;
        // echo "test";
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

        if ($estimate) {
            $eid = hashids_encrypt($estimate->id, '', 15);
            $url = base_url('/estimate_customer_view/' . $eid);
            $customer = $this->AcsProfile_model->getByProfId($estimate->customer_id);

            //Email Sending
            $server    = MAIL_SERVER;
            $port      = MAIL_PORT ;
            $username  = MAIL_USERNAME;
            $password  = MAIL_PASSWORD;
            $from      = MAIL_FROM;
            $recipient = $customer->email;
            $subject = "NsmarTrac : Estimate";
            $msg = "<p>Hi " . $customer->first_name . ",</p>";
            $msg .= "<p>Please check the estimate for your approval.</p>";
            $msg .= "<p>Click <a href='".$url."'>Your Estimate</a> to view and approve estimate.</p><br />";
            $msg .= "<p>Thank you <br /><br /> NsmarTrac Team</p>";

            $mail = new PHPMailer;
            $mail->SMTPDebug = 4;
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
            $mail->addAddress($recipient, $recipient);
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $msg;
            if (!$mail->Send()) {
                $this->session->set_flashdata('alert-type', 'danger');
                $this->session->set_flashdata('alert', 'Cannot send email.');
            } else {
                $this->estimate_model->update($estimate->id, ['status' => 'Submitted']);

                $this->session->set_flashdata('alert-type', 'success');
                $this->session->set_flashdata('alert', 'Your estimate was successfully sent');
            }
        } else {
            $this->session->set_flashdata('alert-type', 'danger');
            $this->session->set_flashdata('alert', 'Cannot find estimate');
        }

        redirect('estimate');
    }

    public function ajax_load_scheduled_estimates()
    {
        $role    = logged('role');
        $user_id = getLoggedUserID();

        if ($role == 1 || $role == 2) {
            $scheduledEstimates = $this->estimate_model->getAllPendingEstimates();
        } else {
            $scheduledEstimates = $this->estimate_model->getAllPendingEstimatesByUserId($user_id);
        }

        $this->page_data['scheduledEstimates'] = $scheduledEstimates;
        // $this->load->view('estimate/ajax_load_scheduled_estimates', $this->page_data);
        $this->load->view('v2/pages/estimate/ajax_load_scheduled_estimates', $this->page_data);
    }

    public function view($id)
    {        
        $this->load->model('AcsProfile_model');
        $this->load->model('EstimateItem_model');
        $this->load->model('Clients_model');

        $estimate = $this->estimate_model->getById($id);
        $company_id = logged('company_id');

        if ($estimate) {
            $customer = $this->AcsProfile_model->getByProfId($estimate->customer_id);
            // $client   = $this->Clients_model->getById($company_id);
            $client = $this->workorder_model->getCompanyCompanyId($company_id);

            $this->page_data['customer'] = $customer;
            $this->page_data['client'] = $client;
            $this->page_data['estimate'] = $estimate;

            // $this->page_data['items_data'] = $this->estimate_model->getItems($id);
            $this->page_data['items_data'] = $this->estimate_model->getEstimatesItems($id);
            $this->page_data['items_dataOP1'] = $this->estimate_model->getItemlistByIDOption1($id);
            $this->page_data['items_dataOP2'] = $this->estimate_model->getItemlistByIDOption2($id);

            $this->page_data['items_dataBD1'] = $this->estimate_model->getItemlistByIDBundle1($id);
            $this->page_data['items_dataBD2'] = $this->estimate_model->getItemlistByIDBundle2($id);

            $this->load->view('estimate/view', $this->page_data);
        } else {
            $this->session->set_flashdata('message', 'Record not found.');
            $this->session->set_flashdata('alert_class', 'alert-danger');
            redirect('estimate');
        }
    }

    public function pdf_estimate($id)
    {
        $estimate = $this->estimate_model->getById($id);
        if ($estimate) {
            $this->load->helper('pdf_helper');
            $this->load->model('AcsProfile_model');
            $this->load->model('Clients_model');

            $company_id = $estimate->company_id;
            $customer = $this->AcsProfile_model->getByProfId($estimate->customer_id);
            // $client   = $this->Clients_model->getById($company_id);
            $client = $this->workorder_model->getCompanyCompanyId($company_id);
            // $estimateItems = unserialize($estimate->estimate_items);
            $estimateItems = $this->estimate_model->getEstimatesItems($id);

            $html = '
            <table style="padding-top:10px;">
                <tr>
                    <td><br />
                        <b style="font-size:12px;">From <br /><span>'.$client->business_name.'</span></b>
                        <br />
                        <span class="">'.$client->street.'</span><br />
                        <span class="">'.$client->city .', '.$client->state.' '. $client->postal_code.'</span><br />
                        <span class="">Email:'.$client->email_address.'</span><br />
                        <span class="">Phone:'.$client->phone_number.'</span>
                        <br /><br /><br />
                        <b style="font-size:12px;">To <br /><span>'.$customer->first_name . ' ' .$customer->last_name.'</span></b>
                        <br />
                        <span class="">'.$customer->mail_add . " " . $customer->city.', '. $customer->state .' '. $customer->zip_code.'</span><br />
                        <span class="">EMAIL: '.$customer->email.'</span><br />
                        <span class="">PHONE: '.$customer->phone_w.'</span>
                    </td>
                    <td colspan=1></td>
                </tr>
            </table>
            <table style="padding-top:-230px;">
                <tr>
                    <td style="text-align:right;">
                        <h6 style="font-size:20px;margin:0px;margin-top:-400px;">ESTIMATE <br /><small style="font-size: 10px;">#'.$estimate->estimate_number.'</small></h6>
                        <br />Estimate Date: '.date("F d, Y", strtotime($estimate->estimate_date)).'
                        <br />Expire Due: '.date("F d, Y", strtotime($estimate->expiry_date)).'
                    </td>
                </tr>
            </table>
            <br /><br /><br />

            <table style="width="100%;>
            <thead>
                <tr>
                    <th style="width:5%;"><b>#</b></th>
                    <th style="width:35%;"><b>Items</b></th>
                    <th style="width:12%;"><b>Item Type</b></th>
                    <th style="width:12%;text-align: right;"><b>Qty</b></th>
                    <th style="width:12%;text-align: right;"><b>Price</b></th>
                    <th style="width:12%;text-align: right;"><b>Discount</b></th>
                    <th style="width:12%;text-align: right;"><b>Total</b></th>
                </tr>
            </thead>
            <tbody>';
            $total_amount = 0;
            $total_tax = 0;
            $row = 1;
            foreach ($estimateItems as $item) {
                $html .= '<tr>
                    <td valign="top" style="width:5%;">'.$row.'</td>
                    <td valign="top" style="width:35%;">'.$item->title.'</td>
                    <td valign="top" style="width:12%;">'.$item->type.'</td>
                    <td valign="top" style="width:12%;text-align: right;">'.$item->qty.'</td>
                    <td valign="top" style="width:12%;text-align: right;">'.number_format($item->iCost, 2).'</td>
                    <td valign="top" style="width:12%;text-align: right;">'.number_format($item->discount, 2).'</td>
                    <td valign="top" style="width:12%;text-align: right;">'.number_format($item->iTotal, 2).'</td>
                  </tr>
                ';
                $row++;
                $total_amount += $item->iTotal;
            }

            $total_amount = ($estimate->sub_total + $estimate->tax1_total) + $estimate->adjustment_value;

            $adjustment_name = 'Adjustment';
            if( $estimate->adjustment_name != '' ){
                $adjustment_name = $estimate->adjustment_name;
            }
            $html .= '
            <tr><br><br>
              <td colspan="6" style="text-align: right;"><b>Subtotal</b></td>
              <td style="text-align: right;"><b>$'.number_format($estimate->sub_total, 2).'</b></td>
            </tr>
            <tr>
              <td colspan="6" style="text-align: right;"><b>Taxes</b></td>
              <td style="text-align: right;"><b>$'.number_format($estimate->tax1_total, 2).'</b></td>
            </tr>
            <tr>
              <td colspan="6" style="text-align: right;"><b>'.$adjustment_name.'</b></td>
              <td style="text-align: right;"><b>$'.number_format($estimate->adjustment_value, 2).'</b></td>
            </tr>
            <tr>
              <td colspan="6" style="text-align: right;"><b>Grand Total</b></td>
              <td style="text-align: right;"><b>$'.number_format($total_amount, 2).'</b></td>
            </tr>
          </tbody>
          </table>
          <br /><br /><br /><br /><br />
          <b>Instructions</b>'.$estimate->instructions.'<br />
          <b>Message</b>'.$estimate->customer_message.'<br />
          <b>Terms</b>'.$estimate->terms_conditions.'
            ';

            tcpdf();
            $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
            $title = "Estimates";
            $obj_pdf->SetTitle($title);
            $obj_pdf->setPrintHeader(false);
            $obj_pdf->setPrintFooter(false);
            $obj_pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
            $obj_pdf->SetDefaultMonospacedFont('helvetica');
            $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
            $obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
            $obj_pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
            $obj_pdf->SetFont('helvetica', '', 9);
            $obj_pdf->setFontSubsetting(false);
            $obj_pdf->AddPage();
            ob_end_clean();
            $obj_pdf->writeHTML($html, true, false, true, false, '');
            $obj_pdf->Output('Estimates.pdf', 'I');
        } else {
            $this->session->set_flashdata('message', 'Record not found.');
            $this->session->set_flashdata('alert_class', 'alert-danger');
            // redirect('Estimates');
            redirect('estimate');
        }
    }

    public function print_estimate($id)
    {
        $this->load->model('AcsProfile_model');
        $this->load->model('EstimateItem_model');
        $this->load->model('Clients_model');

        $estimate = $this->estimate_model->getById($id);
        $company_id = logged('company_id');

        if ($estimate) {
            $customer = $this->AcsProfile_model->getByProfId($estimate->customer_id);
            $client   = $this->Clients_model->getById($company_id);

            $this->page_data['customer'] = $customer;
            $this->page_data['client'] = $client;
            $this->page_data['estimate'] = $estimate;
            $this->page_data['Items'] = $this->estimate_model->getEstimatesItems($id);

            $this->load->view('estimate/print_estimate', $this->page_data);
        } else {
            $this->session->set_flashdata('message', 'Record not found.');
            $this->session->set_flashdata('alert_class', 'alert-danger');
            redirect('estimate');
        }
    }

    public function duplicate_estimate()
    {
        $company_id     = getLoggedCompanyID();
        // $user_id        = getLoggedUserID();
        $user_id        = logged('id');
        $est_num = $this->input->post('est_num');

        $datas = $this->estimate_model->getDataByESTID($est_num);

        $number = $this->estimate_model->getlastInsertByComp($company_id);
        foreach ($number as $num){
            $next = $num->estimate_number;
            $arr = explode("-", $next);
            $date_start = $arr[0];
            $nextNum = $arr[1];
        //    echo $number;
        }
       $val = $nextNum + 1;
       $estimate_number = 'EST-'.str_pad($val,9,"0",STR_PAD_LEFT);

       $curr_date_7 = strtotime("+7 day");
       $current_date_7 = date('Y-m-d', $curr_date_7);

       $new_data = array(
            
            'user_id'                       => $user_id,
            'event_id'                      => $datas->event_id,
            'company_id'                    => $company_id,
            'customer_id'                   => $datas->customer_id,
            'job_location'                  => $datas->job_location,
            'job_name'                      => $datas->job_name,
            'estimate_number'               => $estimate_number,
            'estimate_type'                 => $datas->estimate_type,
            'estimate_value'                => $datas->estimate_value,
            'estimate_date'                 => date("Y-m-d"),
            'expiry_date'                   => $current_date_7,
            'purchase_order_number'         => $datas->purchase_order_number,
            'plan_id'                       => $datas->plan_id,
            'deposit_request'               => $datas->deposit_request,//
            'deposit_amount'                => $datas->deposit_amount,
            'customer_message'              => $datas->customer_message,
            'terms_conditions'              => $datas->terms_conditions,
            'attachments'                   => $datas->attachments,
            'instructions'                  => $datas->instructions,
            'template_id'                   => $datas->template_id,
            'status'                        => $datas->status,
            'email'                         => $datas->email,
            'billing_address'               => $datas->billing_address,
            'ship_via'                      => $datas->ship_via,
            'ship_date'                     => $datas->ship_date,
            'tracking_no'                   => $datas->tracking_no,
            'ship_to'                       => $datas->ship_to,
            'decline_reason'                => $datas->decline_reason,
            'is_accepted'                   => $datas->is_accepted,      
            'accepted_date'                 => $datas->accepted_date,
            'is_mail_open'                  => $datas->is_mail_open,
            'mail_open_date'                => $datas->mail_open_date,
            'tags'                          => $datas->tags,
            'option_message'                => $datas->option_message,
            'option2_message'               => $datas->option2_message,
            'bundle1_message'               => $datas->bundle1_message,
            'bundle2_message'               => $datas->bundle2_message,
            'bundle_discount'               => $datas->bundle_discount,
            'signature'                     => $datas->signature,      
            'sign_date'                     => $datas->sign_date,
            'created_at'                    => date("Y-m-d H:i:s"),
            'updated_at'                    => date("Y-m-d H:i:s"),
            'remarks'                       => $datas->remarks,
            'estimate_eqpt_cost'            => $datas->estimate_eqpt_cost,
            'adjustment_name'               => $datas->adjustment_name,
            'adjustment_value'              => $datas->adjustment_value,      
            'markup_type'                   => $datas->markup_type,
            'markup_amount'                 => $datas->markup_amount,
            'bundle1_total'                 => $datas->bundle1_total,
            'bundle2_total'                 => $datas->bundle2_total,
            'option1_total'                 => $datas->option1_total,
            'option2_total'                 => $datas->option2_total,
            'tax1_total'                    => $datas->tax1_total,
            'tax2_total'                    => $datas->tax2_total,
            'sub_total'                     => $datas->sub_total,
            'grand_total'                   => $datas->grand_total,    
            'view_flag'                     => $datas->view_flag,             
        );

        $addQuery = $this->estimate_model->save_estimate($new_data);

        customerAuditLog(logged('id'), $datas->customer_id, $datas->id, 'Estimate', 'Cloned estimate #'.$datas->estimate_number);
    }

    public function estimate_settings()
    {
		$this->page_data['page']->title = 'Estimate Settings';
        $this->page_data['page']->parent = 'Sales';
        $this->load->model('EstimateSettings_model');

        $company_id = logged('company_id');
        $setting = $this->EstimateSettings_model->getEstimateSettingByCompanyId($company_id);

        $this->page_data['setting'] = $setting;
        $this->load->view('v2/pages/estimate/settings', $this->page_data);
    }

    public function save_setting()
    {
        $post = $this->input->post();

        $this->load->model('EstimateSettings_model');

        $company_id = logged('company_id');
        $setting = $this->EstimateSettings_model->getEstimateSettingByCompanyId($company_id);

        if ($setting) {
            $is_residential_default = 0;
            if (isset($post['is_residential_default'])) {
                $is_residential_default = 1;
            }
            $data = [
                'estimate_num_prefix' => $post['prefix'],
                'estimate_num_next' => $post['base'],
                'residential_message' => $post['residential_message'],
                'residential_terms_and_conditions' => $post['residential_terms'],
                'commercial_message' => $post['message_commercial'],
                'commercial_terms_and_conditions' => $post['terms_commercial'],
                'is_residential_message_default' => $is_residential_default
            ];
            $this->EstimateSettings_model->update($setting->id, $data);
        } else {
            $data = [
                'company_id' => $company_id,
                'estimate_num_prefix' => $post['prefix'],
                'estimate_num_next' => $post['base'],
                'residential_message' => $post['residential_message'],
                'residential_terms_and_conditions' => $post['residential_terms'],
                'commercial_message' => $post['message_commercial'],
                'commercial_terms_and_conditions' => $post['terms_commercial'],
                'is_residential_message_default' => $is_residential_default
            ];
            $this->EstimateSettings_model->create($data);
        }

        $this->session->set_flashdata('alert-type', 'success');
        $this->session->set_flashdata('alert', 'Settings was successfully updated');

        redirect('estimate/settings');
    }
}
