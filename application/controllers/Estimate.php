<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Estimate extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->hasAccessModule(19);
        $this->page_data['page']->title = 'My Estimates';
        $this->page_data['page']->menu = 'estimates';
        $this->load->model('Estimate_model', 'estimate_model');
        $this->load->model('Jobs_model', 'jobs_model');
        $this->load->model('items_model');
        $this->load->model('accounting_invoices_model');
        $this->load->model('Workorder_model', 'workorder_model');
        $this->load->model('Customer_model', 'customer_model');
        $this->load->model('General_model', 'general');

        $this->checkLogin();

        $user_id = getLoggedUserID();

        add_css([
            'https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css',
            'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css',
            'https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css',
            'assets/css/accounting/sidebar.css',
        ]);

        add_footer_js([
            'https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js',
            'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js',
            'https://code.jquery.com/ui/1.12.1/jquery-ui.js',
            'https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js',
            'assets/frontend/js/estimate/estimate.js',
        ]);
    }

    public function index($tab = '')
    {
        $is_allowed = $this->isAllowedModuleAccess(18);
        if (!$is_allowed) {
            $this->page_data['module'] = 'estimate';
            echo $this->load->view('no_access_module', $this->page_data, true);
            exit;
        }

        $company_id = logged('company_id');
        $role = logged('role');

        /*if ($role == 2 || $role == 1) {
            $this->page_data['jobs'] = $this->jobs_model->getByWhere([]);
        }else{
            $this->page_data['jobs'] = $this->jobs_model->getByWhere(['company_id' => $company_id]);
        } */
        $order_by = 'Newest first';
        if (!empty($tab)) {
            $query_tab = $tab;
            if ($tab == 'declined%20by%20customer') {
                $query_tab = 'Declined By Customer';
            }
            $filter[] = ['field' => 'estimates.status', 'value' => $query_tab];
            $this->page_data['tab'] = $tab;
            $this->page_data['estimates'] = $this->estimate_model->getAllByCompany($company_id, '', $filter);
            // $this->page_data['estimates'] = $this->estimate_model->filterBy(array('status' => lcfirst($query_tab)), $company_id, $role);
        } else {
            // search
            if (!empty(get('search'))) {
                $filter[] = ['field' => 'acs_profile.first_name', 'value' => get('search')];
                $filter[] = ['field' => 'acs_profile.last_name', 'value' => get('search')];
                $filter[] = ['field' => 'estimates.estimate_number', 'value' => get('search')];
                $this->page_data['search'] = get('search');
                $this->page_data['estimates'] = $this->estimate_model->getAllByCompany($company_id, '', $filter);
                // $this->page_data['estimates'] = $this->estimate_model->filterBy(array('search' => get('search')), $company_id, $role);
            } elseif (!empty(get('order'))) {
                switch (get('order')) {
                    case 'added-desc':
                        $order_by = 'Newest first';
                        break;
                    case 'added-asc':
                        $order_by = 'Oldest first';
                        break;
                    case 'date-accepted-desc':
                        $order_by = 'Accepted: newest';
                        break;
                    case 'date-accepted-asc':
                        $order_by = 'Accepted: oldest';
                        break;
                    case 'amount-asc':
                        $order_by = 'Amount: Lowest';
                        break;
                    case 'amount-desc':
                        $order_by = 'Amount: Highest';
                        break;
                    case 'number-desc':
                        $order_by = 'Estimate Number: descending';
                        break;
                    case 'number-asc':
                        $order_by = 'Estimate Number: ascending';
                        break;
                    default:
                        break;
                }
                $this->page_data['search'] = get('search');
                // $this->page_data['estimates'] = $this->estimate_model->filterBy(array('order' => get('order')), $company_id, $role);
                $this->page_data['estimates'] = $this->estimate_model->getAllByCompany($company_id, get('order'));
            } else {
                $this->page_data['estimates'] = $this->estimate_model->getAllByCompany($company_id);
            }
        }

        $this->page_data['order_by'] = $order_by;
        $this->page_data['tab'] = $tab;
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

        $company_id = getLoggedCompanyID();
        $user_id = getLoggedUserID();
        $post = $this->input->post();

        // Generate Estimate Number
        $setting = $this->EstimateSettings_model->getEstimateSettingByCompanyId($company_id);
        if ($setting) {
            $next_num = $setting->estimate_num_next;
            $prefix = $setting->estimate_num_prefix;
        } else {
            $lastInsert = $this->estimate_model->getlastInsertByComp($company_id);
            if ($lastInsert) {
                $next_num = $lastInsert->id + 1;
            } else {
                $next_num = 1;
            }
            $prefix = 'EST-';
        }

        $estimate_number = str_pad($next_num, 9, '0', STR_PAD_LEFT);
        $estimate_number = $prefix.$estimate_number;

        $customer_lead = explode('/', $this->input->post('customer_id'));
        $customer_id = 0;
        $lead_id = 0;

        if ($customer_lead[1] == 'Customer') {
            $customer_id = $customer_lead[0];
        }

        if ($customer_lead[1] == 'Lead') {
            $lead_id = $customer_lead[0];
        }

        $new_data = [
            'customer_id' => $customer_id,
            'lead_id' => $lead_id,
            'job_location' => $this->input->post('job_location'),
            'job_name' => $this->input->post('job_name'),
            'estimate_number' => $estimate_number,
            // 'email' => $this->input->post('email'),
            // 'billing_address' => $this->input->post('billing_address'),
            'estimate_date' => $this->input->post('estimate_date'),
            'expiry_date' => $this->input->post('expiry_date'),
            'business_name' => $this->input->post('business_name'),
            'purchase_order_number' => $this->input->post('purchase_order_number'),
            'status' => $this->input->post('status'),
            'type' => $this->input->post('estimate_type'),
            'estimate_type' => 'Standard',
            // 'type' => $this->input->post('estimate_type'),
            // 'ship_via' => $this->input->post('ship_via'),
            // 'ship_date' => $this->input->post('ship_date'),
            // 'tracking_no' => $this->input->post('tracking_no'),
            // 'ship_to' => $this->input->post('ship_to'),
            // 'tags' => $this->input->post('tags'),
            'attachments' => '',
            // 'message_invoice' => $this->input->post('message_invoice'),
            // 'message_statement' => $this->input->post('message_statement'),
            'status' => $this->input->post('status'),
            // 'deposit_request' => $this->input->post('deposit_request'),
            'deposit_request' => 2, // 1 = amount / 2 = percentage
            'deposit_amount' => $this->input->post('deposit_amount'),
            'customer_message' => $this->input->post('customer_message'),
            'terms_conditions' => $this->input->post('terms_conditions'),
            'instructions' => $this->input->post('instructions'),
            'user_id' => $user_id,
            'company_id' => $company_id,
            // 'created_by' => logged('id'),

            'sub_total' => $this->input->post('subtotal'), //
            // 'deposit_request' => $this->input->post('adjustment_name'),//
            // 'deposit_amount' => $this->input->post('adjustment_input'),//
            'grand_total' => $this->input->post('grand_total'),
            'tax1_total' => $this->input->post('taxes'),

            'adjustment_name' => $this->input->post('adjustment_name'),
            'adjustment_value' => $this->input->post('adjustment_value'),

            'markup_type' => '$',
            'markup_amount' => $this->input->post('markup_input_form'),

            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $addQuery = $this->estimate_model->save_estimate($new_data);

        if ($addQuery > 0) {
            if (isset($_FILES['est_contract_upload']) && $_FILES['est_contract_upload']['tmp_name'] != '') {
                $target_dir = "./uploads/estimates/$addQuery/";
                if (!file_exists($target_dir)) {
                    mkdir($target_dir, 0777, true);
                }

                $tmp_name = $_FILES['est_contract_upload']['tmp_name'];
                $extension = strtolower(end(explode('.', $_FILES['est_contract_upload']['name'])));
                $attachment_name = 'attachment_'.basename($_FILES['est_contract_upload']['name']);
                move_uploaded_file($tmp_name, "./uploads/estimates/$addQuery/$attachment_name");

                $this->estimate_model->update($addQuery, ['attachments' => $attachment_name]);
            }
            // Update estimate setting
            if ($setting) {
                $estimate_setting = ['estimate_num_next' => $next_num + 1];
                $this->EstimateSettings_model->update($setting->id, $estimate_setting);
            }
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

            $temp_items = $this->input->post('temp_items');
            $temp_item_type = $this->input->post('temp_item_type');
            $temp_quantity = $this->input->post('temp_quantity');
            $temp_price = $this->input->post('temp_price');
            $temp_tax = $this->input->post('temp_tax');
            $temp_total = $this->input->post('temp_total');
            $temp_discount = $this->input->post('temp_discount');
            $saveForFuture = $this->input->post('saveForFuture');

            if ($temp_items) {
                $b = 0;
                foreach ($temp_items as $row2) {
                    $data2['title'] = $temp_items[$b];
                    $data2['company_id'] = $company_id;
                    $data2['type'] = $temp_item_type[$b];
                    $data2['qty'] = $temp_quantity[$b];
                    $data2['price'] = $temp_price[$b];
                    $data2['discount'] = $temp_discount[$b];
                    $data2['tax'] = $temp_tax[$b];
                    $data2['total'] = $temp_total[$b];
                    $data2['added_from'] = 'Estimates';
                    $data2['id_form '] = $addQuery;
                    $addQuery3 = $this->estimate_model->add_estimate_temp_items($data2);

                    if ((int) $saveForFuture[$b] == 1) {
                        $data3['company_id'] = $company_id;
                        $data3['title'] = $temp_items[$b];
                        $data3['type'] = $temp_item_type[$b];
                        $data3['qty_order'] = $temp_quantity[$b];
                        $data3['price'] = $temp_price[$b];
                        $data3['retail'] = $temp_price[$b];
                        $data3['is_active'] = 1;
                        $addQuery4 = $this->estimate_model->add_new_items($data3);

                        $data4['items_id'] = $addQuery4;
                        $data4['qty'] = $temp_quantity[$b];
                        $data4['cost'] = $temp_price[$b];
                        $data4['tax'] = $temp_tax[$b];
                        $data4['total'] = $temp_total[$b];
                        $data4['estimates_id '] = $addQuery;
                        $addQuery5 = $this->estimate_model->add_estimate_items($data4);

                        $deleteItem = $this->estimate_model->delete_temp_item($addQuery3);
                    }

                    ++$b;
                }
            }

            $a = $this->input->post('itemid');
            $quantity = $this->input->post('quantity');
            $price = $this->input->post('price');
            $h = $this->input->post('tax');
            $gtotal = $this->input->post('total');
            $discount = $this->input->post('discount');

            $i = 0;
            foreach ($a as $row) {
                $data['items_id'] = $a[$i];
                $data['qty'] = $quantity[$i];
                $data['cost'] = $price[$i];
                $data['tax'] = $h[$i];
                $data['total'] = $gtotal[$i];
                $data['discount'] = $discount[$i];
                $data['estimates_id '] = $addQuery;
                $addQuery2 = $this->estimate_model->add_estimate_items($data);
                ++$i;
            }

            // }
            $userid = logged('id');

            $getname = $this->estimate_model->getname($userid);

            $notif = [
                'user_id' => $userid,
                'title' => 'New Estimates',
                'content' => $getname->FName.' has created new Estimates.'.$this->input->post('estimate_number'),
                'date_created' => date('Y-m-d H:i:s'),
                'status' => '1',
                'company_id' => getLoggedCompanyID(),
            ];

            $notification = $this->estimate_model->save_notification($notif);

            if ($this->input->post('status') === 'Submitted') {
                $this->sendEstimateToCustomer($new_data['customer_id'], $addQuery);
            }

            if ($this->input->post('module') && $this->input->post('module') == 'accounting') {
                redirect('accounting/newEstimateList');
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
        $this->load->model('EstimateSettings_model');

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

        $setting = $this->EstimateSettings_model->getEstimateSettingByCompanyId($company_id);
        $default_terms_condition = '';
        $default_customer_message = 'I would be happy to have an opportunity to work with you.';
        if ($setting) {
            if ($setting->residential_message != '') {
                $default_customer_message = $setting->residential_message;
            }

            if ($setting->residential_terms_and_conditions != '') {
                $default_terms_condition = $setting->residential_terms_and_conditions;
            }
        }
        // $this->page_data['workstatus'] = $this->Workstatus_model->getByWhere(['company_id'=>$company_id]);
        $this->page_data['customers'] = $this->AcsProfile_model->getAllByCompanyId($company_id);

        $this->page_data['clients'] = $this->workorder_model->getclientsById();
        $type = $this->input->get('type');
        $this->page_data['type'] = $type;
        $this->page_data['itemsLocation'] = $this->items_model->getLocationStorage();
        $this->page_data['plans'] = $this->plans_model->getByWhere(['company_id' => $company_id]);
        $this->page_data['number'] = $this->estimate_model->getlastInsert();
        $this->page_data['items'] = $this->items_model->getItemlist();
        $this->page_data['packages'] = $this->estimate_model->getPackagelist($company_id);
        $this->page_data['jobs_data_items'] = $this->jobs_model->get_specific_job_items($id);
        $this->page_data['default_terms_condition'] = $default_terms_condition;
        $this->page_data['default_customer_message'] = $default_customer_message;

        add_css([
            'assets/plugins/font-awesome/css/font-awesome.min.css',
        ]);

        // $this->page_data['file_selection'] = $this->load->view('modals/file_vault_selection', array(), TRUE);
        $this->load->view('estimate/v2/add', $this->page_data);
        // print_r($this->page_data['customers']);
    }

    public function add_description()
    {
        $this->load->model('AcsProfile_model');
        $this->load->model('EstimateSettings_model');

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
        $company_id = logged('company_id');
        $role = logged('role');

        $setting = $this->EstimateSettings_model->getEstimateSettingByCompanyId($company_id);
        $default_terms_condition = '';
        $default_customer_message = 'I would be happy to have an opportunity to work with you.';
        if ($setting) {
            if ($setting->residential_message != '') {
                $default_customer_message = $setting->residential_message;
            }

            if ($setting->residential_terms_and_conditions != '') {
                $default_terms_condition = $setting->residential_terms_and_conditions;
            }
        }
        $this->page_data['customers'] = $this->AcsProfile_model->getAllByCompanyId($company_id);

        $this->page_data['clients'] = $this->workorder_model->getclientsById();
        $type = $this->input->get('type');
        $this->page_data['type'] = $type;
        $this->page_data['itemsLocation'] = $this->items_model->getLocationStorage();
        $this->page_data['plans'] = $this->plans_model->getByWhere(['company_id' => $company_id]);
        $this->page_data['number'] = $this->estimate_model->getlastInsert();
        $this->page_data['items'] = $this->items_model->getItemlist();
        $this->page_data['packages'] = $this->estimate_model->getPackagelist($company_id);
        $this->page_data['jobs_data_items'] = $this->jobs_model->get_specific_job_items($id);
        $this->page_data['default_terms_condition'] = $default_terms_condition;
        $this->page_data['default_customer_message'] = $default_customer_message;

        add_css([
            'assets/plugins/font-awesome/css/font-awesome.min.css',
        ]);

        $this->load->view('estimate/v2/addDescription', $this->page_data);
    }

    public function add_new_inventory_item()
    {
        $this->page_data['page']->title = 'Inventory';
        $this->page_data['page']->parent = 'Tools';

        $input = $this->input->post();
        if ($input) {
            $config = [
                'upload_path' => './uploads/',
                'allowed_types' => 'gif|jpg|png|jpeg',
                'overwrite' => true,
                'max_size' => '2048000',
                'max_height' => '768',
                'max_width' => '1024',
            ];

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('attach_photo')) {
                $product_image = '';
            } else {
                $data = ['upload_data' => $this->upload->data()];
                $product_image = $data['upload_data']['file_name'];
            }

            $data = [
                'company_id' => logged('company_id'),
                'title' => $this->input->post('item_name'),
                'type' => ucfirst($this->input->post('item_type')),
                'model' => $this->input->post('model_number'),
                'COGS' => $this->input->post('cost_of_goods'),
                'cost' => $this->input->post('cost'),
                'brand' => $this->input->post('brand'),
                'price' => $this->input->post('retailField'),
                'rebate' => $this->input->post('rebateField'),
                // 'cost_per' => $this->input->post('cost_per'),
                'description' => $this->input->post('description'),
                'url' => $this->input->post('product_url'),
                'notes' => '',
                'item_categories_id' => $this->input->post('item_category'),
                'is_active' => 1,
                'vendor_id' => $this->input->post('vendor'),
                'units' => $this->input->post('unit'),
                'attached_image' => $product_image,
            ];
            $profile_id = $this->general->add_return_id($data, 'items');
            redirect(base_url('inventory'));
        }

        $get_items_categories = [
            'where' => ['company_id' => logged('company_id')],
            'table' => 'item_categories',
            'select' => '*',
        ];
        $this->page_data['item_categories'] = $this->general->get_data_with_param($get_items_categories);

        $get_vendors = [
            'where' => ['company_id' => logged('company_id')],
            'table' => 'vendor',
            'select' => '*',
        ];
        $this->page_data['vendors'] = $this->general->get_data_with_param($get_vendors);
        $this->page_data['page']->title = 'Inventory';
        $this->page_data['page']->parent = 'Tools';

        $getLocation = [
            'where' => [
                'company_id' => logged('company_id'),
            ],
            'select' => 'loc_id, location_name, default',
            'table' => 'storage_loc',
        ];
        $this->page_data['location'] = $this->general->get_data_with_param($getLocation);
        $this->page_data['custom_fields'] = $this->items_model->get_custom_fields_by_company_id(logged('company_id'));
        $this->load->view('v2/pages/inventory/action/inventory_add_window', $this->page_data);
        // $this->page_data['page_title'] = 'Add Inventory Item';
        // $this->load->view('inventory/add', $this->page_data);
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

        $this->page_data['clients'] = $this->workorder_model->getclientsById();
        $company_id = logged('company_id');
        $role = logged('role');
        // $this->page_data['workstatus'] = $this->Workstatus_model->getByWhere(['company_id'=>$company_id]);
        if ($role == 1 || $role == 2) {
            $this->page_data['customers'] = $this->AcsProfile_model->getAll();
            // $this->page_data['customers'] = $this->AcsProfile_model->getAllByCompanyId($company_id);
        } else {
            // $this->page_data['customers'] = $this->AcsProfile_model->getAll();
            $this->page_data['customers'] = $this->AcsProfile_model->getAllByCompanyId($company_id);
        }
        $type = $this->input->get('type');
        $this->page_data['type'] = $type;
        $this->page_data['plans'] = $this->plans_model->getByWhere(['company_id' => $company_id]);
        $this->page_data['number'] = $this->estimate_model->getlastInsert();
        $this->page_data['items'] = $this->items_model->getItemlist();

        add_css([
            'assets/plugins/font-awesome/css/font-awesome.min.css',
        ]);

        // $this->page_data['file_selection'] = $this->load->view('modals/file_vault_selection', array(), TRUE);
        $this->load->view('estimate/v2/addoptions', $this->page_data);
    }

    public function delete_estimate()
    {
        $id = $this->input->post('id');
        $user_login = logged('FName').' '.logged('LName');
        $estimateInfo = $this->estimate_model->getEstimate($id);

        $data = [
            'id' => $id,
            'view_flag' => '1',
        ];

        // Record Job delete to Customer Activities Module in Customer Dashboard
        $action = "$user_login deleted an estimate. $estimateInfo->estimate_number";

        $customerLogPayload = [
            'date' => date('m/d/Y').'<br>'.date('h:i A'),
            'customer_id' => $estimateInfo->customer_id,
            'user_id' => logged('id'),
            'logs' => "$action",
        ];
        $customerLogsRecording = $this->customer_model->recordActivityLogs($customerLogPayload);

        $delete = $this->estimate_model->deleteEstimate($data);

        echo json_encode($delete);
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

        $this->page_data['clients'] = $this->workorder_model->getclientsById();
        $company_id = logged('company_id');
        $role = logged('role');
        // $this->page_data['workstatus'] = $this->Workstatus_model->getByWhere(['company_id'=>$company_id]);
        if ($role == 1 || $role == 2) {
            // $this->page_data['customers'] = $this->AcsProfile_model->getAllByCompanyId($company_id);
            $this->page_data['customers'] = $this->AcsProfile_model->getAll();
        } else {
            // $this->page_data['customers'] = $this->AcsProfile_model->getAll();
            $this->page_data['customers'] = $this->AcsProfile_model->getAllByCompanyId($company_id);
        }
        $type = $this->input->get('type');
        $this->page_data['type'] = $type;
        $this->page_data['plans'] = $this->plans_model->getByWhere(['company_id' => $company_id]);
        $this->page_data['number'] = $this->estimate_model->getlastInsert();
        $this->page_data['items'] = $this->items_model->getItemlist();

        add_css([
            'assets/plugins/font-awesome/css/font-awesome.min.css',
        ]);

        // $this->page_data['file_selection'] = $this->load->view('modals/file_vault_selection', array(), TRUE);
        $this->load->view('estimate/v2/addbundle', $this->page_data);
    }

    public function savenewestimateBundle()
    {
        $company_id = getLoggedCompanyID();
        $user_id = getLoggedUserID();

        $new_data = [
            'customer_id' => $this->input->post('customer_id'),
            'job_location' => $this->input->post('job_location'),
            'job_name' => $this->input->post('job_name'),
            'business_name' => $this->input->post('business_name'),
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
            // 'deposit_request' => $this->input->post('deposit_request'), // 1 = amount / 2 = percentage
            'deposit_request' => 2, // 1 = amount / 2 = percentage
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
            'deposit_amount' => $this->input->post('adjustment_input'),
            'bundle1_total' => $this->input->post('grand_total'),
            'bundle2_total' => $this->input->post('grand_total2'),
            'sub_total' => $this->input->post('sub_total'),
            'sub_total2' => $this->input->post('sub_total2'),

            'tax1_total' => $this->input->post('total_tax_'),
            'tax2_total' => $this->input->post('total_tax2_'),

            'grand_total' => $this->input->post('supergrandtotal'),

            'adjustment_name' => $this->input->post('adjustment_name'),
            'adjustment_value' => $this->input->post('adjustment_input'),

            'markup_type' => '$',
            'markup_amount' => $this->input->post('markup_input_form'),

            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $addQuery = $this->estimate_model->save_estimate($new_data);

        // GET CUSTOMER AND USER INFO
        $getUserInfo = [
            'where' => ['id' => logged('id')],
            'table' => 'users',
        ];
        $getUserInfo = $this->general->get_data_with_param($getUserInfo, false);

        $getCustomerInfo = [
            'where' => ['prof_id' => $this->input->post('customer_id')],
            'table' => 'acs_profile',
        ];
        $getCustomerInfo = $this->general->get_data_with_param($getCustomerInfo, false);

        // STANDARD ESTIMATE CUSTOMER ACTIVITY LOG RECORDING
        $customerLogsRecording = [
            'date' => date('m/d/Y').'<br>'.date('h:i A'),
            'customer_id' => $this->input->post('customer_id'),
            'user_id' => logged('id'),
            'logs' => "$getUserInfo->FName $getUserInfo->LName created a bundle estimate with you. <a href='#' onclick='window.open(`".base_url('estimate/view/').$addQuery."`, `_blank`, `location=yes,height=1080,width=1500,scrollbars=yes,status=yes`);'>".$this->input->post('estimate_number').'</a>',
        ];
        $customerLogsRecording = $this->customer_model->recordActivityLogs($customerLogsRecording);

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

            $a = $this->input->post('itemid');
            // $packageID  = $this->input->post('packageID');
            $quantity = $this->input->post('quantity');
            $price = $this->input->post('price');
            $h = $this->input->post('tax');
            $discount = $this->input->post('discount');
            $total = $this->input->post('total');

            $i = 0;
            foreach ($a as $row) {
                $data['items_id'] = $a[$i];
                // $data['package_id ']    = $packageID[$i];
                $data['qty'] = $quantity[$i];
                $data['cost'] = $price[$i];
                $data['tax'] = $h[$i];
                $data['discount'] = $discount[$i];
                $data['total'] = $total[$i];
                $data['estimate_type'] = 'Bundle';
                $data['estimates_id '] = $addQuery;
                $data['bundle_option_type'] = '1';
                $addQuery2 = $this->estimate_model->add_estimate_details($data);
                ++$i;
            }

            $a2 = $this->input->post('itemid2');
            // $packageID  = $this->input->post('packageID');
            $quantity2 = $this->input->post('quantity2');
            $price2 = $this->input->post('price2');
            $h2 = $this->input->post('tax2');
            $discount2 = $this->input->post('discount2');
            $total2 = $this->input->post('total2');

            $i2 = 0;
            foreach ($a2 as $row2) {
                $data2['items_id'] = $a2[$i2];
                // $data['package_id ']    = $packageID[$i];
                $data2['qty'] = $quantity2[$i2];
                $data2['cost'] = $price2[$i2];
                $data2['tax'] = $h2[$i2];
                $data2['discount'] = $discount2[$i2];
                $data2['total'] = $total2[$i2];
                $data2['estimate_type'] = 'Bundle';
                $data2['estimates_id '] = $addQuery;
                $data2['bundle_option_type'] = '2';
                $addQuery2 = $this->estimate_model->add_estimate_details($data2);
                ++$i2;
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

            $notif = [
                'user_id' => $userid,
                'title' => 'New Estimates',
                'content' => $getname->FName.' has created new Bundle Estimates.'.$this->input->post('estimate_number'),
                'date_created' => date('Y-m-d H:i:s'),
                'status' => '1',
                'company_id' => getLoggedCompanyID(),
            ];

            $notification = $this->estimate_model->save_notification($notif);

            if ($this->input->post('status') === 'Submitted') {
                $this->sendEstimateToCustomer($new_data['customer_id'], $addQuery);
            }

            redirect('estimate');
        } else {
            echo json_encode(0);
        }
    }

    public function savenewestimateOptions()
    {
        $company_id = getLoggedCompanyID();
        $user_id = getLoggedUserID();

        $new_data = [
            'customer_id' => $this->input->post('customer_id'),
            'job_location' => $this->input->post('job_location'),
            'job_name' => $this->input->post('job_name'),
            'estimate_number' => $this->input->post('estimate_number'),
            'estimate_date' => $this->input->post('estimate_date'),
            'business_name' => $this->input->post('business_name'),
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
            'sub_total' => $this->input->post('sub_total'),
            'sub_total2' => $this->input->post('sub_total2'),

            // 'tax1_total' => $this->input->post('total_tax_'),
            // 'tax2_total' => $this->input->post('total_tax2_'),

            // 'grand_total' => $this->input->post('supergrandtotal'),

            'user_id' => $user_id,
            'company_id' => $company_id,

            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $addQuery = $this->estimate_model->save_estimate($new_data);

        // GET CUSTOMER AND USER INFO
        $getUserInfo = [
            'where' => ['id' => logged('id')],
            'table' => 'users',
        ];
        $getUserInfo = $this->general->get_data_with_param($getUserInfo, false);

        $getCustomerInfo = [
            'where' => ['prof_id' => $this->input->post('customer_id')],
            'table' => 'acs_profile',
        ];
        $getCustomerInfo = $this->general->get_data_with_param($getCustomerInfo, false);

        // STANDARD ESTIMATE CUSTOMER ACTIVITY LOG RECORDING
        $customerLogsRecording = [
            'date' => date('m/d/Y').'<br>'.date('h:i A'),
            'customer_id' => $this->input->post('customer_id'),
            'user_id' => logged('id'),
            'logs' => "$getUserInfo->FName $getUserInfo->LName created an option estimate with you. <a href='#' onclick='window.open(`".base_url('estimate/view/').$addQuery."`, `_blank`, `location=yes,height=1080,width=1500,scrollbars=yes,status=yes`);'>".$this->input->post('estimate_number').'</a>',
        ];
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
        if ($addQuery > 0) {
            $a = $this->input->post('itemid');
            // $packageID  = $this->input->post('packageID');
            $quantity = $this->input->post('quantity');
            $price = $this->input->post('price');
            $h = $this->input->post('tax');
            $discount = $this->input->post('discount');
            $total = $this->input->post('total');

            $i = 0;
            foreach ($a as $row) {
                $data['items_id'] = $a[$i];
                // $data['package_id ']    = $packageID[$i];
                $data['qty'] = $quantity[$i];
                $data['cost'] = $price[$i];
                $data['tax'] = $h[$i];
                $data['discount'] = $discount[$i];
                $data['total'] = $total[$i];
                $data['estimate_type'] = 'Option';
                $data['estimates_id '] = $addQuery;
                $data['bundle_option_type'] = '1';
                $addQuery2 = $this->estimate_model->add_estimate_details($data);
                ++$i;
            }

            $a2 = $this->input->post('itemid2');
            // $packageID  = $this->input->post('packageID');
            $quantity2 = $this->input->post('quantity2');
            $price2 = $this->input->post('price2');
            $h2 = $this->input->post('tax2');
            $discount2 = $this->input->post('discount2');
            $total2 = $this->input->post('total2');

            $i2 = 0;
            foreach ($a2 as $row2) {
                $data2['items_id'] = $a2[$i2];
                // $data['package_id ']    = $packageID[$i];
                $data2['qty'] = $quantity2[$i2];
                $data2['cost'] = $price2[$i2];
                $data2['tax'] = $h2[$i2];
                $data2['discount'] = $discount2[$i2];
                $data2['total'] = $total2[$i2];
                $data2['estimate_type'] = 'Option';
                $data2['estimates_id '] = $addQuery;
                $data2['bundle_option_type'] = '2';
                $addQuery2 = $this->estimate_model->add_estimate_details($data2);
                ++$i2;
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

            $notif = [
                'user_id' => $userid,
                'title' => 'New Estimates',
                'content' => $getname->FName.' has created new Options Estimates.'.$this->input->post('estimate_number'),
                'date_created' => date('Y-m-d H:i:s'),
                'status' => '1',
                'company_id' => getLoggedCompanyID(),
            ];

            $notification = $this->estimate_model->save_notification($notif);

            if ($this->input->post('status') === 'Submitted') {
                $this->sendEstimateToCustomer($new_data['customer_id'], $addQuery);
            }

            redirect('estimate');
        } else {
            echo json_encode(0);
        }
    }

    public function save()
    {
        postAllowed();

        // echo '<pre>'; print_r($this->input->post()); die;

        $user = (object) $this->session->userdata('logged');

        if (count(post('item')) > 0) {
            $items = post('item');
            $quantity = post('quantity');
            $price = post('price');
            $discount = post('discount');
            $type = post('item_type');
            $location = post('location');

            foreach (post('item') as $key => $val) {
                $itemArray[] = [
                    'item' => $items[$key],
                    'item_type' => $type[$key],
                    'quantity' => $quantity[$key],
                    'location' => $location[$key],
                    'discount' => $discount[$key],
                    'price' => $price[$key],
                ];
            }

            $estimate_items = serialize($itemArray);
        } else {
            $estimate_items = '';
        }

        $eqpt_cost = [
            'eqpt_cost' => post('eqpt_cost') ? post('eqpt_cost') : 0,
            'sales_tax' => post('sales_tax') ? post('sales_tax') : 0,
            'inst_cost' => post('inst_cost') ? post('inst_cost') : 0,
            'one_time' => post('one_time') ? post('one_time') : 0,
            'm_monitoring' => post('m_monitoring') ? post('m_monitoring') : 0,
        ];

        // echo '<pre>';print_r($data);die;

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

        $this->activity_model->add('New User $'.$user->id.' Created by User:'.logged('name'), logged('id'));
        $this->session->set_flashdata('alert-type', 'success');
        $this->session->set_flashdata('alert', 'New Estimate Created Successfully');

        redirect('estimate');
    }

    public function edit($id)
    {
        $this->load->model('AcsProfile_model');

        $company_id = logged('company_id');
        $user_id = logged('id');
        $role = logged('role');
        // $parent_id = $this->db->query("select parent_id from users where id=$user_id")->row();

        if ($role == 1 || $role == 2) {
            $this->page_data['users'] = $this->users_model->getAllUsers();
            $this->page_data['customers'] = $this->AcsProfile_model->getAll();
        } else {
            $this->page_data['users'] = $this->users_model->getAllUsersByCompany($user_id);
            $this->page_data['customers'] = $this->AcsProfile_model->getAllByCompanyId($company_id);
        }

        $this->load->model('Customer_model', 'customer_model');

        $this->page_data['estimate'] = $this->estimate_model->getById($id);
        if ($this->page_data['estimate']->status === 'Accepted') {
            $this->session->set_flashdata('message', 'Accepted estimate cannot be edited.');
            $this->session->set_flashdata('alert_class', 'alert-danger');

            return redirect('/estimate');
        }

        $this->page_data['itemsLocation'] = $this->items_model->getLocationStorage();
        $this->page_data['estimate']->customer = $this->customer_model->getCustomer($this->page_data['estimate']->customer_id);
        $this->page_data['plans'] = $this->plans_model->getByWhere(['company_id' => $company_id]);
        $this->page_data['items_data'] = $this->estimate_model->getEstimatesItems($id);

        $this->page_data['items'] = $this->items_model->getItemlist();
        $this->page_data['itemsDetails'] = $this->estimate_model->getItemlistByID($id);
        $this->page_data['packages'] = $this->estimate_model->getPackagelist($company_id);

        add_css([
            'assets/plugins/font-awesome/css/font-awesome.min.css',
        ]);

        $this->load->view('estimate/v2/edit', $this->page_data);
    }

    public function editOption($id)
    {
        $this->load->model('AcsProfile_model');

        $company_id = logged('company_id');
        $user_id = logged('id');
        $role = logged('role');
        // $parent_id = $this->db->query("select parent_id from users where id=$user_id")->row();

        if ($role == 1 || $role == 2) {
            $this->page_data['users'] = $this->users_model->getAllUsers();
            $this->page_data['customers'] = $this->AcsProfile_model->getAll();
        } else {
            $this->page_data['users'] = $this->users_model->getAllUsersByCompany($user_id);
            $this->page_data['customers'] = $this->AcsProfile_model->getAllByCompanyId($company_id);
        }

        $this->load->model('Customer_model', 'customer_model');

        $this->page_data['estimate'] = $this->estimate_model->getById($id);
        if ($this->page_data['estimate']->status === 'Accepted') {
            $this->session->set_flashdata('message', 'Accepted estimate cannot be edited.');
            $this->session->set_flashdata('alert_class', 'alert-danger');

            return redirect('/estimate');
        }

        $this->page_data['estimate']->customer = $this->customer_model->getCustomer($this->page_data['estimate']->customer_id);
        $this->page_data['plans'] = $this->plans_model->getByWhere(['company_id' => $company_id]);
        $this->page_data['items_data'] = $this->estimate_model->getEstimatesItems($id);

        $this->page_data['items'] = $this->items_model->getItemlist();
        $this->page_data['itemsDetails'] = $this->estimate_model->getItemlistByID($id);
        $this->page_data['itemsOption1'] = $this->estimate_model->getItemlistByIDOption1($id);
        $this->page_data['itemsOption2'] = $this->estimate_model->getItemlistByIDOption2($id);
        $this->page_data['packages'] = $this->estimate_model->getPackagelist($company_id);

        add_css([
            'assets/plugins/font-awesome/css/font-awesome.min.css',
        ]);

        $this->load->view('estimate/v2/editOption', $this->page_data);
    }

    public function editBundle($id)
    {
        $this->load->model('AcsProfile_model');

        $company_id = logged('company_id');
        $user_id = logged('id');
        $role = logged('role');
        // $parent_id = $this->db->query("select parent_id from users where id=$user_id")->row();

        if ($role == 1 || $role == 2) {
            $this->page_data['users'] = $this->users_model->getAllUsers();
            $this->page_data['customers'] = $this->AcsProfile_model->getAll();
        } else {
            $this->page_data['users'] = $this->users_model->getAllUsersByCompany($user_id);
            $this->page_data['customers'] = $this->AcsProfile_model->getAllByCompanyId($company_id);
        }

        $this->load->model('Customer_model', 'customer_model');

        $this->page_data['estimate'] = $this->estimate_model->getById($id);
        if ($this->page_data['estimate']->status === 'Accepted') {
            $this->session->set_flashdata('message', 'Accepted estimate cannot be edited.');
            $this->session->set_flashdata('alert_class', 'alert-danger');

            return redirect('/estimate');
        }

        $this->page_data['estimate']->customer = $this->customer_model->getCustomer($this->page_data['estimate']->customer_id);
        $this->page_data['plans'] = $this->plans_model->getByWhere(['company_id' => $company_id]);
        $this->page_data['items_data'] = $this->estimate_model->getEstimatesItems($id);

        $this->page_data['items'] = $this->items_model->getItemlist();
        $this->page_data['itemsDetails'] = $this->estimate_model->getItemlistByID($id);

        $this->page_data['itemsBundle1'] = $this->estimate_model->getItemlistByIDBundle1($id);
        $this->page_data['itemsBundle2'] = $this->estimate_model->getItemlistByIDBundle2($id);

        $this->page_data['packages'] = $this->estimate_model->getPackagelist($company_id);

        add_css([
            'assets/plugins/font-awesome/css/font-awesome.min.css',
        ]);

        $this->load->view('estimate/v2/editBundle', $this->page_data);
    }

    public function update_old($id)
    {
        postAllowed();

        // echo '<pre>'; print_r($this->input->post()); die;

        $user = (object) $this->session->userdata('logged');

        if (count(post('item')) > 0) {
            $items = post('item');
            $quantity = post('quantity');
            $price = post('price');
            $discount = post('discount');
            $type = post('item_type');
            $location = post('location');

            foreach (post('item') as $key => $val) {
                $itemArray[] = [
                    'item' => $items[$key],
                    'item_type' => $type[$key],
                    'quantity' => $quantity[$key],
                    'location' => $location[$key],
                    'discount' => $discount[$key],
                    'price' => $price[$key],
                ];
            }

            $estimate_items = serialize($itemArray);
        } else {
            $estimate_items = '';
        }

        $eqpt_cost = [
            'eqpt_cost' => post('eqpt_cost') ? post('eqpt_cost') : 0,
            'sales_tax' => post('sales_tax') ? post('sales_tax') : 0,
            'inst_cost' => post('inst_cost') ? post('inst_cost') : 0,
            'one_time' => post('one_time') ? post('one_time') : 0,
            'm_monitoring' => post('m_monitoring') ? post('m_monitoring') : 0,
        ];

        // echo '<pre>';print_r($data);die;

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

        $this->activity_model->add('New User $'.$user->id.' Created by User:'.logged('name'), logged('id'));
        $this->session->set_flashdata('alert-type', 'success');
        $this->session->set_flashdata('alert', 'Estimate has been Updated Successfully');

        redirect('estimate');
    }

    public function update($id)
    {
        $company_id = getLoggedCompanyID();
        $user_id = getLoggedUserID();
        $estimate = $this->estimate_model->getById($id);

        $attachment_name = $estimate->attachments;
        if (isset($_FILES['est_contract_upload']) && $_FILES['est_contract_upload']['tmp_name'] != '') {
            $target_dir = "./uploads/estimates/$estimate->id/";
            if (!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true);
            }

            $tmp_name = $_FILES['est_contract_upload']['tmp_name'];
            $extension = strtolower(end(explode('.', $_FILES['est_contract_upload']['name'])));
            $attachment_name = 'attachment_'.basename($_FILES['est_contract_upload']['name']);
            move_uploaded_file($tmp_name, "./uploads/estimates/$estimate->id/$attachment_name");
        }

        $new_data = [
            'id' => $id,
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

            'sub_total' => $this->input->post('subtotal'), //
            // 'deposit_request' => $this->input->post('adjustment_name'),//
            // 'deposit_amount' => $this->input->post('adjustment_input'),//
            'grand_total' => $this->input->post('grand_total'),
            'tax1_total' => $this->input->post('taxes'),

            'adjustment_name' => $this->input->post('adjustment_name'),
            'adjustment_value' => $this->input->post('adjustment_value'),

            'markup_type' => '$',
            'markup_amount' => $this->input->post('markup_input_form'),

            // 'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $addQuery = $this->estimate_model->update_estimate($new_data);

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

        $a = $this->input->post('itemid');
        $quantity = $this->input->post('quantity');
        $price = $this->input->post('price');
        $h = $this->input->post('tax');
        $gtotal = $this->input->post('total');
        $discount = $this->input->post('discount');

        $i = 0;
        foreach ($a as $row) {
            $data['items_id'] = $a[$i];
            $data['qty'] = $quantity[$i];
            $data['cost'] = $price[$i];
            $data['tax'] = $h[$i];
            $data['discount'] = $discount[$i];
            $data['total'] = $gtotal[$i];
            $data['estimates_id '] = $id;
            $addQuery2 = $this->estimate_model->add_estimate_items($data);
            ++$i;
        }

        // }

        redirect('estimate');
        // } else {
        //     echo json_encode(0);
        // }
    }

    public function updateestimateBundle($id)
    {
        $company_id = getLoggedCompanyID();
        $user_id = getLoggedUserID();

        $new_data = [
            'id' => $id,
            'customer_id' => $this->input->post('customer_id'),
            'job_location' => $this->input->post('job_location'),
            'job_name' => $this->input->post('job_name'),
            // 'estimate_number'           => $this->input->post('estimate_number'),
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

            // 'created_by' => logged('id'),

            // 'sub_total' => $this->input->post('sub_total'),
            // 'deposit_request'           => '$',
            'deposit_amount' => $this->input->post('adjustment_input'),
            'bundle1_total' => $this->input->post('grand_total'),
            'bundle2_total' => $this->input->post('grand_total2'),
            'sub_total' => $this->input->post('sub_total'),
            'sub_total2' => $this->input->post('sub_total2'),

            'tax1_total' => $this->input->post('total_tax_'),
            'tax2_total' => $this->input->post('total_tax2_'),

            'grand_total' => $this->input->post('supergrandtotal'),

            'adjustment_name' => $this->input->post('adjustment_name'),
            'adjustment_value' => $this->input->post('adjustment_input'),

            'markup_type' => '$',
            'markup_amount' => $this->input->post('markup_input_form'),

            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $addQuery = $this->estimate_model->update_estimateBundle($new_data);

        // GET CUSTOMER AND USER INFO
        $getUserInfo = [
            'where' => ['id' => logged('id')],
            'table' => 'users',
        ];
        $getUserInfo = $this->general->get_data_with_param($getUserInfo, false);

        $getCustomerInfo = [
            'where' => ['prof_id' => $this->input->post('customer_id')],
            'table' => 'acs_profile',
        ];
        $getCustomerInfo = $this->general->get_data_with_param($getCustomerInfo, false);

        // STANDARD ESTIMATE CUSTOMER ACTIVITY LOG RECORDING
        $customerLogsRecording = [
            'date' => date('m/d/Y').'<br>'.date('h:i A'),
            'customer_id' => $this->input->post('customer_id'),
            'user_id' => logged('id'),
            'logs' => "$getUserInfo->FName $getUserInfo->LName updated a bundle estimate. <a href='#' onclick='window.open(`".base_url('estimate/view/').$id."`, `_blank`, `location=yes,height=1080,width=1500,scrollbars=yes,status=yes`);'>".$this->input->post('estimate_number').'</a>',
        ];
        $customerLogsRecording = $this->customer_model->recordActivityLogs($customerLogsRecording);

        $delete2 = $this->estimate_model->delete_items($id);

        // if ($addQuery > 0) {

        $a = $this->input->post('itemid');
        // $packageID  = $this->input->post('packageID');
        $quantity = $this->input->post('quantity');
        $price = $this->input->post('price');
        $h = $this->input->post('tax');
        $discount = $this->input->post('discount');
        $total = $this->input->post('total');

        $i = 0;
        foreach ($a as $row) {
            $data['items_id'] = $a[$i];
            // $data['package_id ']    = $packageID[$i];
            $data['qty'] = $quantity[$i];
            $data['cost'] = $price[$i];
            $data['tax'] = $h[$i];
            $data['discount'] = $discount[$i];
            $data['total'] = $total[$i];
            $data['estimate_type'] = 'Bundle';
            $data['estimates_id '] = $id;
            $data['bundle_option_type'] = '1';
            $addQuery2 = $this->estimate_model->add_estimate_details($data);
            ++$i;
        }

        $a2 = $this->input->post('itemid2');
        // $packageID  = $this->input->post('packageID');
        $quantity2 = $this->input->post('quantity2');
        $price2 = $this->input->post('price2');
        $h2 = $this->input->post('tax2');
        $discount2 = $this->input->post('discount2');
        $total2 = $this->input->post('total2');

        $i2 = 0;
        foreach ($a2 as $row2) {
            $data2['items_id'] = $a2[$i2];
            // $data['package_id ']    = $packageID[$i];
            $data2['qty'] = $quantity2[$i2];
            $data2['cost'] = $price2[$i2];
            $data2['tax'] = $h2[$i2];
            $data2['discount'] = $discount2[$i2];
            $data2['total'] = $total2[$i2];
            $data2['estimate_type'] = 'Bundle';
            $data2['estimates_id '] = $id;
            $data2['bundle_option_type'] = '2';
            $addQuery2 = $this->estimate_model->add_estimate_details($data2);
            ++$i2;
        }

        redirect('estimate');
        // } else {
        //     echo json_encode(0);
        // }
    }

    public function updateestimateOptions($id)
    {
        $company_id = getLoggedCompanyID();
        $user_id = getLoggedUserID();

        $new_data = [
            'id' => $id,
            'customer_id' => $this->input->post('customer_id'),
            'job_location' => $this->input->post('job_location'),
            'job_name' => $this->input->post('job_name'),
            // 'estimate_number'        => $this->input->post('estimate_number'),
            // 'email'                  => $this->input->post('email'),
            // 'billing_address'        => $this->input->post('billing_address'),
            'estimate_date' => $this->input->post('estimate_date'),
            'expiry_date' => $this->input->post('expiry_date'),
            'purchase_order_number' => $this->input->post('purchase_order_number'),
            'status' => $this->input->post('status'),
            'estimate_type' => 'Option',
            'type' => $this->input->post('estimate_type'),
            'attachments' => 'testing',
            'status' => $this->input->post('status'),
            'deposit_request' => $this->input->post('deposit_request'),
            'deposit_amount' => $this->input->post('deposit_amount'),
            'customer_message' => $this->input->post('customer_message'),
            'terms_conditions' => $this->input->post('terms_conditions'),
            'instructions' => $this->input->post('instructions'),

            // 'estimate_type'          => 'Bundle',
            'option_message' => $this->input->post('option1_message'),
            'option2_message' => $this->input->post('option2_message'),
            // 'bundle1_total'          => $this->input->post('bundle1_total'),
            // 'bundle2_total'          => $this->input->post('bundle2_total'),
            // 'bundle_discount'           => $this->input->post('bundle_discount'),

            // 'created_by'             => logged('id'),

            // 'sub_total'              => $this->input->post('sub_total'),
            // 'deposit_request'        => '$',
            // 'deposit_amount'            => $this->input->post('adjustment_input'),//
            'option1_total' => $this->input->post('grand_total'),
            'option2_total' => $this->input->post('grand_total2'),
            'sub_total' => $this->input->post('sub_total'),
            'sub_total2' => $this->input->post('sub_total2'),

            'tax1_total' => $this->input->post('total_tax_'),
            'tax2_total' => $this->input->post('total_tax2_'),

            // 'grand_total'               => $this->input->post('supergrandtotal'),//

            // 'adjustment_name'           => $this->input->post('adjustment_name'),//
            // 'adjustment_value'          => $this->input->post('adjustment_input'),//

            // 'markup_type'               => '$',//
            // 'markup_amount'             => $this->input->post('markup_input_form'),//

            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $addQuery = $this->estimate_model->update_estimateOptions($new_data);

        // GET CUSTOMER AND USER INFO
        $getUserInfo = [
            'where' => ['id' => logged('id')],
            'table' => 'users',
        ];
        $getUserInfo = $this->general->get_data_with_param($getUserInfo, false);

        $getCustomerInfo = [
            'where' => ['prof_id' => $this->input->post('customer_id')],
            'table' => 'acs_profile',
        ];
        $getCustomerInfo = $this->general->get_data_with_param($getCustomerInfo, false);

        // STANDARD ESTIMATE CUSTOMER ACTIVITY LOG RECORDING
        $customerLogsRecording = [
            'date' => date('m/d/Y').'<br>'.date('h:i A'),
            'customer_id' => $this->input->post('customer_id'),
            'user_id' => logged('id'),
            'logs' => "$getUserInfo->FName $getUserInfo->LName updated an option estimate. <a href='#' onclick='window.open(`".base_url('estimate/view/').$id."`, `_blank`, `location=yes,height=1080,width=1500,scrollbars=yes,status=yes`);'>".$this->input->post('estimate_number').'</a>',
        ];
        $customerLogsRecording = $this->customer_model->recordActivityLogs($customerLogsRecording);

        $delete2 = $this->estimate_model->delete_items($id);

        // if ($addQuery > 0) {

        $a = $this->input->post('itemid');
        // $packageID  = $this->input->post('packageID');
        $quantity = $this->input->post('quantity');
        $price = $this->input->post('price');
        $h = $this->input->post('tax');
        $discount = $this->input->post('discount');
        $total = $this->input->post('total');

        $i = 0;
        foreach ($a as $row) {
            $data['items_id'] = $a[$i];
            // $data['package_id ']    = $packageID[$i];
            $data['qty'] = $quantity[$i];
            $data['cost'] = $price[$i];
            $data['tax'] = $h[$i];
            $data['discount'] = $discount[$i];
            $data['total'] = $total[$i];
            $data['estimate_type'] = 'Option';
            $data['estimates_id '] = $id;
            $data['bundle_option_type'] = '1';
            $addQuery2 = $this->estimate_model->add_estimate_details($data);
            ++$i;
        }

        $a2 = $this->input->post('itemid2');
        // $packageID  = $this->input->post('packageID');
        $quantity2 = $this->input->post('quantity2');
        $price2 = $this->input->post('price2');
        $h2 = $this->input->post('tax2');
        $discount2 = $this->input->post('discount2');
        $total2 = $this->input->post('total2');

        $i2 = 0;
        foreach ($a2 as $row2) {
            $data2['items_id'] = $a2[$i2];
            // $data['package_id ']    = $packageID[$i];
            $data2['qty'] = $quantity2[$i2];
            $data2['cost'] = $price2[$i2];
            $data2['tax'] = $h2[$i2];
            $data2['discount'] = $discount2[$i2];
            $data2['total'] = $total2[$i2];
            $data2['estimate_type'] = 'Option';
            $data2['estimates_id '] = $id;
            $data2['bundle_option_type'] = '2';
            $addQuery2 = $this->estimate_model->add_estimate_details($data2);
            ++$i2;
        }

        redirect('estimate');
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
        $id = $this->input->post('id');
        $wo_id = $this->input->post('est_id');
        $urlLogo = $this->input->post('urlLogo');

        $json_data = $this->sendEstimateToCustomer(
            $id, $wo_id, $urlLogo
        );

        // $this->session->set_flashdata('alert-type', 'success');
        // $this->session->set_flashdata('alert', 'Successfully sent to Customer.');

        echo json_encode($json_data);
        // return true;
        // echo "test";
    }

    public function email_preview()
    {
        // $id = 30694;
        // $wo_id = 249;

        $id = 30694;
        $wo_id = 251;
        $urlLogo = null;
        $this->load->helper(['url', 'hashids_helper']);

        $workData = $this->estimate_model->getEstimate($wo_id);
        $eid = hashids_encrypt($workData->id, '', 15);
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

        $urlApprove = base_url('share_Link/approveEstimate/'.$eid);
        $urlDecline = base_url('share_Link/declineEstimate/'.$eid);

        $business = $this->business_model->getByCompanyId(logged('company_id'));
        $imageUrl = getCompanyBusinessProfileImage();

        $data = [
            // 'workorder'             => $workorder,
            'imageUrl' => $urlLogo,
            'estimateID' => $workData->id,
            'urlApprove' => $urlApprove,
            'urlDecline' => $urlDecline,
            // 'company'                       => $cliets->business_name,
            // 'business_address'              => $cliets->business_address,
            // 'phone_number'                  => $cliets->phone_number,
            // 'email_address'                 => $cliets->email_address,

            'company' => $business->business_name,
            'business_address' => "$business->address, $business->city $business->postal_code",
            'phone_number' => $business->business_phone,
            'email_address' => $business->business_email,

            'acs_name' => $customerData->first_name.' '.$customerData->middle_name.' '.$customerData->last_name,
            'acsemail' => $customerData->email,
            'acsaddress' => $customerData->mail_add,
            'phone_m' => $customerData->phone_m,

            'items_dataOP1' => $items_dataOP1,
            'items_dataOP2' => $items_dataOP2,
            'items_dataBD1' => $items_dataBD1,
            'items_dataBD2' => $items_dataBD2,

            'estimate_number' => $workData->estimate_number,
            'job_location' => $workData->job_location,
            'job_name' => $workData->job_name,
            'estimate_date' => $workData->estimate_date,
            'expiry_date' => $workData->expiry_date,
            'purchase_order_number' => $workData->purchase_order_number,
            'status' => $workData->status,
            'estimate_type' => $workData->estimate_type,
            'type' => $workData->type,
            'deposit_request' => $workData->deposit_request,
            'deposit_amount' => $workData->deposit_amount,
            'customer_message' => $workData->customer_message,
            'terms_conditions' => $workData->terms_conditions,
            'instructions' => $workData->instructions,
            'email' => $workData->email,
            'phone' => $workData->phone_number,
            'mobile' => $workData->mobile_number,
            'terms_and_conditions' => $workData->terms_and_conditions,
            'terms_of_use' => $workData->terms_of_use,
            'job_description' => $workData->job_description,
            'instructions' => $workData->instructions,
            'bundle1_message' => $workData->bundle1_message,
            'bundle2_message' => $workData->bundle2_message,

            'items' => $items,

            'bundle_discount' => $workData->bundle_discount,
            // 'deposit_amount'                => $workData->deposit_amount,
            'bundle1_total' => $workData->bundle1_total,
            'bundle2_total' => $workData->bundle2_total,

            'option_message' => $workData->option_message,
            'option2_message' => $workData->option2_message,
            'option1_total' => $workData->option1_total,
            'option2_total' => $workData->option2_total,

            'sub_total' => $workData->sub_total,
            'sub_total2' => $workData->sub_total2,
            'tax1_total' => $workData->tax1_total,
            'tax2_total' => $workData->tax2_total,

            'grand_total' => $workData->grand_total,
            'adjustment_name' => $workData->adjustment_name,
            'adjustment_value' => $workData->adjustment_value,
            'markup_type' => $workData->markup_type,
            'markup_amount' => $workData->markup_amount,
            'eid' => $eid,
            // 'source' => $source
        ];

        // $recipient  = "emploucelle@gmail.com";
        $recipient = $customerData->email;

        // $message = "This is a test email";
        $this->load->view('estimate/send_email_acs_v3', $data);
    }

    private function sendEstimateToCustomer($id, $wo_id, $urlLogo = null)
    {
        $this->load->helper(['url', 'hashids_helper']);

        $workData = $this->estimate_model->getEstimate($wo_id);
        $eid = hashids_encrypt($workData->id, '', 15);
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

        $urlApprove = base_url('share_Link/approveEstimate/'.$eid);
        $urlDecline = base_url('share_Link/declineEstimate/'.$eid);

        $business = $this->business_model->getByCompanyId(logged('company_id'));
        $imageUrl = getCompanyBusinessProfileImage();

        $data = [
            // 'workorder'             => $workorder,
            'imageUrl' => $urlLogo,
            'estimateID' => $workData->id,
            'urlApprove' => $urlApprove,
            'urlDecline' => $urlDecline,
            // 'company'                       => $cliets->business_name,
            // 'business_address'              => $cliets->business_address,
            // 'phone_number'                  => $cliets->phone_number,
            // 'email_address'                 => $cliets->email_address,

            'company' => $business->business_name,
            'business_address' => "$business->address, $business->city $business->postal_code",
            'phone_number' => $business->business_phone,
            'email_address' => $business->business_email,

            'acs_name' => $customerData->first_name.' '.$customerData->middle_name.' '.$customerData->last_name,
            'acsemail' => $customerData->email,
            'acsaddress' => $customerData->mail_add,
            'phone_m' => $customerData->phone_m,

            'items_dataOP1' => $items_dataOP1,
            'items_dataOP2' => $items_dataOP2,
            'items_dataBD1' => $items_dataBD1,
            'items_dataBD2' => $items_dataBD2,

            'estimate_number' => $workData->estimate_number,
            'job_location' => $workData->job_location,
            'job_name' => $workData->job_name,
            'estimate_date' => $workData->estimate_date,
            'expiry_date' => $workData->expiry_date,
            'purchase_order_number' => $workData->purchase_order_number,
            'status' => $workData->status,
            'estimate_type' => $workData->estimate_type,
            'type' => $workData->type,
            'deposit_request' => $workData->deposit_request,
            'deposit_amount' => $workData->deposit_amount,
            'customer_message' => $workData->customer_message,
            'terms_conditions' => $workData->terms_conditions,
            'instructions' => $workData->instructions,
            'email' => $workData->email,
            'phone' => $workData->phone_number,
            'mobile' => $workData->mobile_number,
            'terms_and_conditions' => $workData->terms_and_conditions,
            'terms_of_use' => $workData->terms_of_use,
            'job_description' => $workData->job_description,
            'instructions' => $workData->instructions,
            'bundle1_message' => $workData->bundle1_message,
            'bundle2_message' => $workData->bundle2_message,

            'items' => $items,

            'bundle_discount' => $workData->bundle_discount,
            // 'deposit_amount'                => $workData->deposit_amount,
            'bundle1_total' => $workData->bundle1_total,
            'bundle2_total' => $workData->bundle2_total,

            'option_message' => $workData->option_message,
            'option2_message' => $workData->option2_message,
            'option1_total' => $workData->option1_total,
            'option2_total' => $workData->option2_total,

            'sub_total' => $workData->sub_total,
            'sub_total2' => $workData->sub_total2,
            'tax1_total' => $workData->tax1_total,
            'tax2_total' => $workData->tax2_total,

            'grand_total' => $workData->grand_total,
            'adjustment_name' => $workData->adjustment_name,
            'adjustment_value' => $workData->adjustment_value,
            'markup_type' => $workData->markup_type,
            'markup_amount' => $workData->markup_amount,
            'eid' => $eid,
            // 'source' => $source
        ];

        // $recipient  = "emploucelle@gmail.com";
        $recipient = $customerData->email;
        // $message = "This is a test email";

        $mail = email__getInstance(['subject' => 'Estimate Details']);
        $mail->addAddress($recipient, $recipient);
        $mail->isHTML(true);
        $mail->Body = $this->load->view('estimate/send_email_acs_v3', $data, true);

        $json_data['is_success'] = 1;
        $json_data['error'] = '';

        if (!$mail->Send()) {
            /*echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
            exit;*/
            $json_data['is_success'] = 0;
            $json_data['error'] = 'Mailer Error: '.$mail->ErrorInfo;
        }

        return $json_data;
    }

    public function print($tab = '')
    {
        $role = logged('role');
        if ($role == 2 || $role == 3) {
            $company_id = logged('company_id');

            if (!empty($tab)) {
                $this->page_data['tab'] = $tab;
                $this->page_data['estimates'] = $this->estimate_model->filterBy(['status' => $tab], $company_id);
            } else {
                // search
                if (!empty(get('search'))) {
                    $this->page_data['search'] = get('search');
                    $this->page_data['estimates'] = $this->estimate_model->filterBy(['search' => get('search')], $company_id);
                } elseif (!empty(get('order'))) {
                    $this->page_data['search'] = get('search');
                    $this->page_data['estimates'] = $this->estimate_model->filterBy(['order' => get('order')], $company_id);
                } else {
                    $this->page_data['estimates'] = $this->estimate_model->getAllByCompany($company_id);
                }
            }

            $this->page_data['estimateStatusFilters'] = $this->estimate_model->getStatusWithCount($company_id);
        }

        if ($role == 4) {
            if (!empty($tab)) {
                $this->page_data['tab'] = $tab;
                $this->page_data['estimates'] = $this->estimate_model->filterBy(['status' => $tab]);
            } elseif (!empty(get('order'))) {
                $this->page_data['order'] = get('order');
                $this->page_data['estimates'] = $this->workorder_model->filterBy(['order' => get('order')], $company_id);
            } else {
                if (!empty(get('search'))) {
                    $this->page_data['search'] = get('search');
                    $this->page_data['estimates'] = $this->workorder_model->filterBy(['search' => get('search')], $company_id);
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
        include APPPATH.'libraries/PHPMailer/PHPMailerAutoload.php';

        $this->load->helper(['url', 'hashids_helper']);

        $this->load->model('AcsProfile_model');

        $post = $this->input->post();
        $estimate = $this->estimate_model->getEstimate($post['eid']);

        if ($estimate) {
            $eid = hashids_encrypt($estimate->id, '', 15);
            $url = base_url('/estimate_customer_view/'.$eid);
            $customer = $this->AcsProfile_model->getByProfId($estimate->customer_id);

            // Email Sending
            $server = MAIL_SERVER;
            $port = MAIL_PORT;
            $username = MAIL_USERNAME;
            $password = MAIL_PASSWORD;
            $from = MAIL_FROM;
            $recipient = $customer->email;
            $subject = 'NsmarTrac : Estimate';
            $msg = '<p>Hi '.$customer->first_name.',</p>';
            $msg .= '<p>Please check the estimate for your approval.</p>';
            $msg .= "<p>Click <a href='".$url."'>Your Estimate</a> to view and approve estimate.</p><br />";
            $msg .= '<p>Thank you <br /><br /> NsmarTrac Team</p>';

            $mail = new PHPMailer();
            $mail->SMTPDebug = 4;
            $mail->isSMTP();
            $mail->Host = $server;
            $mail->SMTPAuth = true;
            $mail->Username = $username;
            $mail->Password = $password;
            $mail->getSMTPInstance()->Timelimit = 5;
            $mail->SMTPSecure = 'ssl';
            $mail->Timeout = 10; // set the timeout (seconds)
            $mail->Port = $port;
            $mail->From = $from;
            $mail->FromName = 'NsmarTrac';
            $mail->addAddress($recipient, $recipient);
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $msg;
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
        $role = logged('role');
        $user_id = getLoggedUserID();
        $company_id = logged('company_id');

        $scheduledEstimates = $this->estimate_model->getAllPendingEstimatesByCompanyId($company_id);

        $this->page_data['scheduledEstimates'] = $scheduledEstimates;
        $this->load->view('v2/pages/estimate/ajax_load_scheduled_estimates', $this->page_data);
    }

    public function view($id)
    {
        $this->load->model('AcsProfile_model');
        $this->load->model('EstimateItem_model');
        $this->load->model('Clients_model');
        $this->load->model('Customer_advance_model');

        $estimate = $this->estimate_model->getById($id);
        $company_id = logged('company_id');

        if ($estimate) {
            $customer = $this->AcsProfile_model->getByProfId($estimate->customer_id);
            // $client   = $this->Clients_model->get_company($company_id);
            $client = $this->Clients_model->getCompanyCompanyId($company_id);
            $lead = $this->Customer_advance_model->getLeadByLeadId($estimate->lead_id);

            $this->page_data['customer'] = $customer;
            $this->page_data['lead'] = $lead;
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
            $this->load->model('Business_model');
            $this->load->model('Customer_advance_model');

            $company_id = $estimate->company_id;
            $customer = $this->AcsProfile_model->getByProfId($estimate->customer_id);
            $lead = $this->Customer_advance_model->getLeadByLeadId($estimate->lead_id);
            // $client   = $this->Clients_model->getById($company_id);
            $business = $this->business_model->getByCompanyId($company_id);
            // $estimateItems = unserialize($estimate->estimate_items);
            $estimateItems = $this->estimate_model->getEstimatesItems($id);

            if ($estimate->customer_id > 0) {
                $firstname = $customer->first_name;
                $lastname = $customer->last_name;
                $phone_m = $customer->phone_m;
                $email = $lead->email;
                $address = $customer->mail_add;
                $city = $customer->city;
                $state = $customer->state;
                $zip = $customer->zip_code;
            } elseif ($estimate->lead_id > 0) {
                $firstname = $lead->firstname;
                $lastname = $lead->lastname;
                $phone_m = $lead->phone_cell;
                $email = $lead->email_add;
                $address = $lead->address;
                $city = $lead->city;
                $state = $lead->state;
                $zip = $lead->zip;
            }

            // <img src="'.(getCompanyBusinessProfileImage() ? getCompanyBusinessProfileImage() : 'assets/images/v2/logo2.png').'" style="margin-top:100px;">

            $html = '
            <div style="height: 50px; width: 50px"></div>
            <table style="padding-top:-40px;">
                <tr>
                    <td >
                    <img src="assets/images/v2/logo2.jpg" style="height: 100px" >
                    </td>
                    <td colspan=1></td>
                    <td style="text-align:right;">
                        <span style="font-weight:bold;color:#6a4a86 ;font-size:20px;margin:0px;">ESTIMATE <br /><small style="font-size: 10px;">#'.$estimate->estimate_number.'</small></span>
                        <br><br>
                        <table>
                          <tr>
                            <td>Estimate Date :</td>
                            <td>'.date('F d, Y', strtotime($estimate->estimate_date)).'</td>
                          </tr>
                          <tr>
                            <td >Expire Due :</td>
                            <td >'.date('F d, Y', strtotime($estimate->expiry_date)).'</td>
                          </tr>
                        </table>
                     
                    </td>
                </tr>
            </table><br><br><br>
            <table>
                <tr>
                    <td>
                        <h5 style="font-size:12px;"><span class="fa fa-user-o"></span> <span style="font-weight:400;font-size: 10px"> From :</span> <br/><span  style="font-size:12px;">'.$business->business_name.'</span></h5>
                        <span class="" style="padding: 100px">'.$business->street.'</span><br />
                        <span class="">'.$business->city.', '.$business->state.' '.$business->postal_code.'</span><br />
                        <span class="">EMAIL: '.$business->business_email.'</span><br />
                        <span class="">PHONE: '.formatPhoneNumber($business->business_phone).'</span>
                    </td>
                    <td colspan="2"></td>
                    <td    style="text-align:right;">
                        <h5 style="font-size:12px"><span class="fa fa-user-o"></span><span style="font-weight:400;font-size: 10px"> To :</span>   <br/><span style="font-size:12px;">'.$firstname.' '.$lastname.'</span></h5>
                        <span class="">'.$address.'<br />'.$city.', '.$state.' '.$zip.'</span><br />
                        <span class="">EMAIL: '.($email ? $email : '---').'</span><br />
                        <span class="">PHONE: '.formatPhoneNumber($phone_m).'</span>
                    </td>
                </tr>
            
            </table>
            <br>    <br>    <br> <br> <br>
            <div >
            <table  style="width: 100% ">
            <tr style="">
            <td style="background-color: #6a4a86;line-height: 30px; color: #fff; width:5%;"><b>#</b></td>
            <td style=" background-color: #6a4a86;line-height: 30px; color: #fff; width:35%; text-align: start;"><b  style="padding: 10px;">Items</b></td>
            <td style=" background-color: #6a4a86;line-height: 30px;  color: #fff; width:12%; text-align: start;"><b   style="padding: 10px;">Item Type</b></td>
            <td style=" background-color: #6a4a86;line-height: 30px;  color: #fff; width:12%; text-align: start;"><b   style="padding: 10px;">Qty</b></td>
            <td style="background-color: #6a4a86; line-height: 30px; color: #fff;  width:12%; text-align: start;"><b   style="padding: 10px;">Price</b></td>
            <td style=" background-color: #6a4a86;line-height: 30px;  color: #fff; width:12%; text-align: start;"><b   style="padding: 10px;">Discount</b></td>
            <td style="background-color: #6a4a86; line-height: 30px; color: #fff;  width:12%; text-align: start;"><b   style="padding: 10px;">Total</b></td>
             </tr>
            <tbody >';
            $total_amount = 0;
            $total_tax = 0;
            $row = 1;
            foreach ($estimateItems as $item) {
                $html .= '<tr style="border: 1px solid black;">
                    <td valign="top" style="line-height: 15px; black;width:5%;">'.$row.'</td>
                    <td valign="top" style="line-height: 15px;  black;width:35%;">'.$item->title.'</td>
                    <td valign="top" style="line-height: 15px;  black;width:12%;">'.$item->type.'</td>
                    <td valign="top" style=" line-height: 15px; black;width:12%;">'.$item->qty.'</td>
                    <td valign="top" style="line-height: 15px;  black;width:12%;">$ '.number_format($item->iCost, 2).'</td>
                    <td valign="top" style="line-height: 15px;  black;width:12%;">$ '.number_format($item->discount, 2).'</td>
                    <td valign="top" style="line-height: 15px;  black;width:12%;">$ '.number_format($item->iTotal, 2).'</td>
                  </tr>
                ';

                ++$row;
                $total_amount += $item->iTotal;
            }
            if (count($estimateItems) < 3) {
                $html .= '<tr style="border: 1px solid black;">
                <td valign="top" style="line-height: 25px; black;width:5%;"></td>
                <td valign="top" style="line-height: 25px;  black;width:35%;"></td>
                <td valign="top" style="line-height: 25px;  black;width:12%;"></td>
                <td valign="top" style=" line-height: 25px; black;width:12%;"></td>
                <td valign="top" style="line-height: 25px;  black;width:12%;"></td>
                <td valign="top" style="line-height: 25px;  black;width:12%;"></td>
                <td valign="top" style="line-height: 25px;  black;width:12%;"></td>
              </tr>';
            }

            $deposit_amount = $estimate->grand_total * ($estimate->deposit_amount / 100);

            $html .= '<br><br>
            <tr>
                <td colspan="3" >
                <p><b  style="font-size:12px;">Message</b><br /><br>'.($estimate->customer_message !== '' && $estimate->customer_message !== null ? $estimate->customer_message : 'If you have any questions or need more information, feel free to contact us at <b style="font-size: 10px; color:#6a4a86">'.formatPhoneNumber($business->business_phone).'</b>.').' </p>
                <p><b style="font-size:12px;">Terms</b><br /><br />'.($estimate->terms_conditions !== '' && $estimate->terms_conditions !== null ? $estimate->terms_conditions : 'This document is strictly <span style="color:#6a4a86">private, confidential </span> and <span style="color:#6a4a86">personal</span> to its recipients and should not be copied, distributed, or reproduced in whole or in part, nor passed to any third party.  This estimate is based on available information at the time of estimation and is subject to change based on unforeseen circumstances or additional requirements.').'</p>
                </td>
                <td></td>
                <td colspan="3">
                    <table>
                        <tr>
                        <td  colspan="2" style="line-height: 20px; black;text-align: start;"><b>Subtotal</b></td>
                        <td  style="line-height: 20px; black;text-align: center;"><b>$'.number_format($estimate->sub_total, 2).'</b></td>
                        </tr>
                        <tr>
                        <td  colspan="2"  style="line-height: 20px; black;text-align: start;">Taxes</td>
                        <td  style="line-height: 20px; black;text-align: center;">$'.number_format($estimate->tax1_total, 2).'</td>
                      </tr>
                      <tr>
                      <td   colspan="2" style="line-height: 20px; black;text-align: start;">Discount</td>
                      <td  style="line-height: 20px; black;text-align: center;">$'.number_format($estimate->adjustment_value, 2).'</td>
                    </tr>
                    <tr>
                    <td  colspan="2" style="background-color: #dad1e0; line-height: 20px; black;text-align: start;"><b>Grand Total</b></td>
                    <td   style="background-color: #dad1e0; line-height: 20px; black;text-align: center;"><b>$'.number_format($estimate->grand_total, 2).'</b></td>
                    </tr>
                    <tr>
                    <td  colspan="2"  style="line-height: 20px; black;text-align: start;">Deposit Amount Requested</td>
                    <td   style="line-height: 20px; black;text-align: center;">$'.number_format($deposit_amount, 2).'</td>
                  </tr>
                  <br><br>
                    <tr style="text-align:center">
                            <p style="text-align:center">Powered By:</p>
                            <img src="assets/images/v2/logo.png" >
                    </tr>
                    </table>
                </td>
            </tr>
            <br> 
            <tr>
                <td colspan="4">
                    <p style="margin-top: -50px;text-align:center"><b  style="font-size:12px;">Instruction</b><br /><br />
                    <span style="font-weight:lighter;">'.($estimate->instructions !== '' && $estimate->instructions !== null ? $estimate->instructions : 'The following estimate request is being submitted for your approval.  Keep in mind, materials costs are subject to change and cannot be guaranteed until approval is received and your order is processed.').'</span></p>
                    <div>
                        <span style="font-size:12px: font-weight: 400">Would you like to proceed with accepting the estimate? </span><br><br>
                        <table>
                            <tr style="text-align:center">
                                <td style="width: 40px"></td>
                                <td style="font-size:10px;background-color:#d9534f; padding:10px 20px; border-radius:25px;line-height: 30px;text-align:center; width:100px"> 
                                    <a style="color:#fff; background-color:#d9534f;   text-decoration: none">Reject</a>
                                </td>
                                <td style="width: 10px"></td>

                                <td style="background-color:#5cb85c;font-size:10px; padding:10px 20px; border-radius:25px;line-height: 30px;text-align:center; width:100px"> 
                                    <a style="color:#fff; background-color:#5cb85c; text-decoration: none">Accept</a>
                                </td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
         
          </tbody>
          </table>
          </div>
          <br /><br />
          
       
        
            ';

            tcpdf();
            $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
            $title = 'Estimates';
            // $obj_pdf->setCellPaddings(5, 5, 5, 5);
            $obj_pdf->SetTitle($title);
            $obj_pdf->setPrintHeader(false);
            $obj_pdf->setPrintFooter(false);
            $obj_pdf->setFooterFont([PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA]);
            $obj_pdf->SetDefaultMonospacedFont('helvetica');
            $obj_pdf->SetFooterMargin(5);
            $obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
            $obj_pdf->SetAutoPageBreak(true, 10);
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
        $this->load->model('Business_model');

        $estimate = $this->estimate_model->getById($id);
        $company_id = logged('company_id');

        if ($estimate) {
            $customer = $this->AcsProfile_model->getByProfId($estimate->customer_id);
            $client = $this->Business_model->getByCompanyId($company_id);

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
        $company_id = getLoggedCompanyID();
        // $user_id        = getLoggedUserID();
        $user_id = logged('id');
        $est_num = $this->input->post('est_num');

        $datas = $this->estimate_model->getDataByESTID($est_num);

        $number = $this->estimate_model->getlastInsertByComp($company_id);
        foreach ($number as $num) {
            $next = $num->estimate_number;
            $arr = explode('-', $next);
            $date_start = $arr[0];
            $nextNum = $arr[1];
            //    echo $number;
        }
        $val = $nextNum + 1;
        $estimate_number = 'EST-'.str_pad($val, 9, '0', STR_PAD_LEFT);

        $curr_date_7 = strtotime('+7 day');
        $current_date_7 = date('Y-m-d', $curr_date_7);

        $new_data = [
             'user_id' => $user_id,
             'event_id' => $datas->event_id,
             'company_id' => $company_id,
             'customer_id' => $datas->customer_id,
             'job_location' => $datas->job_location,
             'job_name' => $datas->job_name,
             'estimate_number' => $estimate_number,
             'estimate_type' => $datas->estimate_type,
             'estimate_value' => $datas->estimate_value,
             'estimate_date' => date('Y-m-d'),
             'expiry_date' => $current_date_7,
             'purchase_order_number' => $datas->purchase_order_number,
             'plan_id' => $datas->plan_id,
             'deposit_request' => $datas->deposit_request,
             'deposit_amount' => $datas->deposit_amount,
             'customer_message' => $datas->customer_message,
             'terms_conditions' => $datas->terms_conditions,
             'attachments' => $datas->attachments,
             'instructions' => $datas->instructions,
             'template_id' => $datas->template_id,
             'status' => $datas->status,
             'email' => $datas->email,
             'billing_address' => $datas->billing_address,
             'ship_via' => $datas->ship_via,
             'ship_date' => $datas->ship_date,
             'tracking_no' => $datas->tracking_no,
             'ship_to' => $datas->ship_to,
             'decline_reason' => $datas->decline_reason,
             'is_accepted' => $datas->is_accepted,
             'accepted_date' => $datas->accepted_date,
             'is_mail_open' => $datas->is_mail_open,
             'mail_open_date' => $datas->mail_open_date,
             'tags' => $datas->tags,
             'option_message' => $datas->option_message,
             'option2_message' => $datas->option2_message,
             'bundle1_message' => $datas->bundle1_message,
             'bundle2_message' => $datas->bundle2_message,
             'bundle_discount' => $datas->bundle_discount,
             'signature' => $datas->signature,
             'sign_date' => $datas->sign_date,
             'created_at' => date('Y-m-d H:i:s'),
             'updated_at' => date('Y-m-d H:i:s'),
             'remarks' => $datas->remarks,
             'estimate_eqpt_cost' => $datas->estimate_eqpt_cost,
             'adjustment_name' => $datas->adjustment_name,
             'adjustment_value' => $datas->adjustment_value,
             'markup_type' => $datas->markup_type,
             'markup_amount' => $datas->markup_amount,
             'bundle1_total' => $datas->bundle1_total,
             'bundle2_total' => $datas->bundle2_total,
             'option1_total' => $datas->option1_total,
             'option2_total' => $datas->option2_total,
             'tax1_total' => $datas->tax1_total,
             'tax2_total' => $datas->tax2_total,
             'sub_total' => $datas->sub_total,
             'grand_total' => $datas->grand_total,
             'view_flag' => $datas->view_flag,
         ];

        $addQuery = $this->estimate_model->save_estimate($new_data);
    }

    public function estimate_settings()
    {
        $this->page_data['page']->title = 'Estimate Settings';
        $this->page_data['page']->parent = 'Sales';
        $this->load->model('EstimateSettings_model');

        $company_id = logged('company_id');
        $setting = $this->EstimateSettings_model->getEstimateSettingByCompanyId($company_id);
        $lastInsert = $this->estimate_model->getlastInsertByComp($company_id);
        if ($lastInsert) {
            $default_next_num = $lastInsert->id + 1;
        } else {
            $default_next_num = 1;
        }

        $this->page_data['setting'] = $setting;
        $this->page_data['default_next_num'] = $default_next_num;
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
                'is_residential_message_default' => $is_residential_default,
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
                'is_residential_message_default' => $is_residential_default,
            ];
            $this->EstimateSettings_model->create($data);
        }

        $this->session->set_flashdata('alert-type', 'success');
        $this->session->set_flashdata('alert', 'Settings was successfully updated');

        redirect('estimate/settings');
    }

    public function approveEstimate()
    {
        $id = $this->input->post('estId');
        $updateQuery = $this->estimate_model->approveEstimate($id);

        echo json_encode($updateQuery);
    }

    public function addNewCustomer()
    {
        $company_id = getLoggedCompanyID();
        $user_id = logged('id');

        $new_data = [
            'company_id' => $company_id,
            'fk_user_id' => $user_id,
            'customer_type' => $this->input->post('customer_type'),
            'first_name' => $this->input->post('first_name'),
            'middle_name' => $this->input->post('middle_name'),
            'last_name' => $this->input->post('last_name'),
            'email' => $this->input->post('contact_email'),
            'mail_add' => $this->input->post('street_address'),
            'city' => $this->input->post('city'),
            'state' => $this->input->post('state'),
            'zip_code' => $this->input->post('postcode'),
            'cross_street' => $this->input->post('street_address'),
            'phone_h' => $this->input->post('contact_phone'),
            'phone_m' => $this->input->post('contact_mobile'),
            'suffix' => $this->input->post('suffix_name'),
            'date_of_birth' => $this->input->post('date_of_birth'),
            'ssn' => $this->input->post('social_security_number'),
            'status' => $this->input->post('status'),
        ];
        $addQuery = $this->estimate_model->addNewCustomer($new_data);

        $success = 'success';
        echo json_encode($addQuery);
    }

    public function ajax_save_estimate_setttings()
    {
        $this->load->model('EstimateSettings_model');

        $is_success = 0;
        $msg = 'Cannot save settings';

        $post = $this->input->post();
        $company_id = logged('company_id');
        $is_valid = 1;

        if ($post['prefix'] == '' || $post['base'] == '') {
            $is_valid = 0;
            $msg = 'Please specify estimate number prefix and next number';
        }

        if ($is_valid == 1) {
            $is_residential_message_default = 0;
            if (isset($post['is_residential_default'])) {
                $is_residential_message_default = 1;
            }

            $settings = $this->EstimateSettings_model->getEstimateSettingByCompanyId($company_id);
            if ($settings) {
                $data = [
                        'estimate_num_prefix' => $post['prefix'],
                        'estimate_num_next' => $post['base'],
                        'residential_message' => $post['residential_message'],
                        'residential_terms_and_conditions' => $post['residential_terms'],
                        'commercial_message' => $post['message_commercial'],
                        'commercial_terms_and_conditions' => $post['terms_commercial'],
                        'is_residential_message_default' => $is_residential_message_default,
                    ];

                $this->EstimateSettings_model->update($settings->id, $data);
            } else {
                $data = [
                    'company_id' => $company_id,
                    'estimate_num_prefix' => $post['prefix'],
                    'estimate_num_next' => $post['base'],
                    'residential_message' => $post['residential_message'],
                    'residential_terms_and_conditions' => $post['residential_terms'],
                    'commercial_message' => $post['message_commercial'],
                    'commercial_terms_and_conditions' => $post['terms_commercial'],
                    'is_residential_message_default' => $is_residential_message_default,
                    'default_expire_period' => 'weeks',
                    'capture_customer_signature' => 1,
                    'hide_item_price' => 1,
                    'hide_item_qty' => 1,
                    'hide_item_tax' => 1,
                    'hide_item_discount' => 1,
                    'hide_item_total' => 1,
                    'hide_grand_total' => 1,
                ];

                $this->EstimateSettings_model->create($data);
            }

            $is_success = 1;
            $msg = '';
        }

        $json_data = ['is_success' => $is_success];

        echo json_encode($json_data);
    }
}
