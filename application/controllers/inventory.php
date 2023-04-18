<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Inventory extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->checkLogin();
        $this->hasAccessModule(51);

        $this->page_data['page']->title = 'Inventory Management';
        $this->page_data['page']->menu = 'items';
        $this->load->model('Items_model', 'items_model');
        $this->load->model('Vendor_model', 'vendor_model');
        $this->load->model('ItemCategory_model', 'itemcategory_model');
        $this->load->library('form_validation');
        $this->load->helper('file');
        $this->load->model('General_model', 'general');
        $this->load->helper('functions_helper');

        add_css(array(
            'https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css',
            'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css',
            'https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css',
			"assets/css/accounting/sidebar.css",
        ));


        // JS to add only Customer module
        add_footer_js(array(
            'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js',
            'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js',
            'https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js',
            'https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js',
            'assets/frontend/js/inventory/main.js',
        ));
    }

    public function index()
    {
        
        $this->page_data['page']->title = 'Inventory';
        $this->page_data['page']->parent = 'Tools';

        $get = $this->input->get();
        $this->page_data['items'] = $this->items_model->get();
        $comp_id = logged('company_id');
        $this->page_data['active_category'] = "Show All";
        $type    = $this->page_data['type']  = (!empty($get['type'])) ? $get['type'] : "product";
        $role_id = intval(logged('role'));
        if (!empty($get['category'])) {
            /*if( $role_id == 1 || $role_id == 2 ){
                $comp_id = 0;
            }*/
            $this->page_data['category'] = $get['category'];
            $this->page_data['active_category'] = $get['category'];
            $items = $this->items_model->filterBy(['category' => $get['category'], 'is_active' => "1"], $comp_id, ucfirst($type));
        } else {
            /*if( $role_id == 1 || $role_id == 2 ){
                $arg = array('type'=>ucfirst($type), 'is_active'=>1); 
            }else{
                $arg = array('company_id'=>$comp_id, 'type'=>ucfirst($type), 'is_active'=>1); 
            }*/

            $arg   = array('company_id'=>$comp_id, 'type'=>ucfirst($type)); 
            $items = $this->items_model->getByWhere($arg);
        }
        $ITEM_DATA = $this->page_data['items'] = $this->categorizeNameAlphabetically($items);
        $comp = array(
            'company_id' => $comp_id
        );
        $this->page_data['items_categories'] = $this->db->get_where($this->items_model->table_categories, $comp)->result();

        $ITEM_LOCATION_ARRAY = array();
        foreach ($ITEM_DATA as $ITEM_DATAS) {
            array_push($ITEM_LOCATION_ARRAY, $this->items_model->getLocationByItemId($ITEM_DATAS[10]));
        }
        $location_param = array(
            "where" => array(
                'company_id' => $comp_id
            ),
            "table" => "storage_loc"
        );
        $this->page_data['locations'] = $this->general->get_data_with_param($location_param);
        $this->page_data['items_location'] = $ITEM_LOCATION_ARRAY;
        $this->page_data['items_transaction_history'] = $this->items_model->getAllRecordItemTransaction();
        $this->load->view('v2/pages/inventory/list', $this->page_data);
    }

    public function services($page = null)
    {
        $this->page_data['page']->title = 'Services';
        $this->page_data['page']->parent = 'Tools';

        $get = $this->input->get();
        $this->page_data['items'] = $this->items_model->get();
        $comp_id = logged('company_id');
        $this->page_data['active_category'] = "Show All";
        $type    = $this->page_data['type']  = "service";
        $role_id = logged('role');
        if (!empty($get['category'])) {
            if( $role_id == 1 || $role_id == 2 ){
                $comp_id = 0;
            }
            $this->page_data['category'] = $get['category'];
            $this->page_data['active_category'] = $get['category'];
            $items = $this->items_model->filterBy(['category' => $get['category'], 'is_active' => "1"], $comp_id, ucfirst($type));
        } else {

            if( $role_id == 1 || $role_id == 2 ){
                $arg = array('type'=>ucfirst($type), 'is_active'=>1);
            }else{
                $arg = array('company_id'=>$comp_id, 'type'=>ucfirst($type), 'is_active'=>1);
            }

            $items = $this->items_model->getByWhere($arg);
        }

        $this->page_data['items'] = $this->categorizeNameAlphabetically($items);
        $comp = array(
            'company_id' => $comp_id
        );
        $this->page_data['items_categories'] = $this->db->get_where($this->items_model->table_categories, $comp)->result();

        if($page == null){
            $this->load->view('v2/pages/inventory/services', $this->page_data);
        }else if ($page == 'add'){
            // $this->load->view('inventory/services_add', $this->page_data);
            $this->load->view('v2/pages/inventory/action/services_add', $this->page_data);
        }
    }

    public function edit_services($id)
    {
        $this->page_data['page']->title = 'Services';
        $comp_id = logged('company_id');        
        $arg     = array('company_id'=>$comp_id, 'id' => $id, 'is_active'=>1);
        $item    = $this->items_model->getCompanyItemById($comp_id, $id);

        $this->page_data['item'] = $item;
        // $this->load->view('inventory/services_edit', $this->page_data);
        $this->load->view('v2/pages/inventory/action/services_edit', $this->page_data);
    }

    public function fees($page = null)
    {
        $this->page_data['page']->title = 'Fees';
        $this->page_data['page']->parent = 'Tools';

        $get = $this->input->get();
        $this->page_data['items'] = $this->items_model->get();
        $comp_id = logged('company_id');
        $this->page_data['active_category'] = "Show All";
        $type    = $this->page_data['type']  = "fees";
        $role_id = logged('role');
        if (!empty($get['category'])) {
            if( $role_id == 1 || $role_id == 2 ){
                $comp_id = 0;
            }
            $this->page_data['category'] = $get['category'];
            $this->page_data['active_category'] = $get['category'];
            $items = $this->items_model->filterBy(['category' => $get['category'], 'is_active' => "1"], $comp_id, ucfirst($type));
        } else {

            if( $role_id == 1 || $role_id == 2 ){
                //$arg = array('type'=>ucfirst($type), 'is_active'=>1);
                $arg = array('company_id'=>$comp_id, 'type'=>ucfirst($type), 'is_active'=>1);
            }else{
                $arg = array('company_id'=>$comp_id, 'type'=>ucfirst($type), 'is_active'=>1);
            }
            $items = $this->items_model->getByWhere($arg);
        }

        $this->page_data['items'] = $this->categorizeNameAlphabetically($items);

        if($page == null){
            $this->load->view('v2/pages/inventory/fees', $this->page_data);
        }else if ($page == 'add'){
            // $this->load->view('inventory/fees_add', $this->page_data);
            $this->load->view('v2/pages/inventory/action/fees_add', $this->page_data);
        }
    }

    public function item_groups($page = null)
    {
        $this->page_data['page']->title = 'Item Categories';
        $this->page_data['page']->parent = 'Tools';

        $comp_id = logged('company_id');

        $get_items_categories = array(
            'where' => array('company_id' => $comp_id),
            'table' => 'item_categories',
            'select' => '*',
        );
        $this->page_data['item_categories'] = $this->general->get_data_with_param($get_items_categories);

        if($page == null){
            $this->load->view('v2/pages/inventory/item_groups', $this->page_data);
        }else if ($page == 'add'){
            // $this->load->view('inventory/item_groups_add', $this->page_data);
            $this->load->view('v2/pages/inventory/action/item_groups_add', $this->page_data);
        }
    }

    public function plans($page = null)
    {
        $role = logged('role');
        if( $role == 1 || $role == 2 ){
            $this->page_data['plans'] = $this->plans_model->getByWhere([]);
        }else{
            $company_id =  logged('company_id');
            $this->page_data['plans'] = $this->plans_model->getByWhere(['company_id'=>$company_id]);
        }

        // ifPermissions('plan_list');

        // $this->page_data['items'] = $this->items_model->get();
        //$company_id =  logged('company_id');
        // $this->page_data['plans'] = $this->plans_model->getByWhere(['company_id'=>$company_id]);
        //$this->page_data['plans'] = array();
        /* echo "<pre>"; print_r($this->page_data['items']); die; */
        if($page == null){
            $this->load->view('inventory/plans', $this->page_data);
        }else if ($page == 'add'){
            $this->load->view('inventory/plans_add', $this->page_data);
        }
    }

    public function vendors($page = null)
    {
        $this->page_data['page']->title = 'Vendors';
        $this->page_data['page']->parent = 'Tools';

        $get_vendors = array(
            'where' => array('company_id' => logged('company_id')),
            'table' => 'vendor',
            'select' => '*',
        );
        $this->page_data['vendors'] = $this->general->get_data_with_param($get_vendors);
        if($page == null){
            $this->load->view('v2/pages/inventory/vendors', $this->page_data);
        }else if ($page == 'add'){
            $this->load->view('inventory/plans_add', $this->page_data);
        }
    }

    public function import() {
        $this->page_data['page']->title = 'Inventory';
        $this->page_data['page']->parent = 'Tools';
        $this->load->view('v2/pages/inventory/import', $this->page_data);
        // $get = $this->input->get();
        // $this->page_data['items'] = $this->items_model->get();
        // $comp_id = logged('company_id');
        // $this->page_data['active_category'] = "Show All";
        // $type    = $this->page_data['type']  = (!empty($get['type'])) ? $get['type'] : "product";
        // $role_id = logged('role');
        // if (!empty($get['category'])) {
        //     if( $role_id == 1 || $role_id == 2 ){
        //         $comp_id = 0;
        //     }
        //     $this->page_data['category'] = $get['category'];
        //     $this->page_data['active_category'] = $get['category'];
        //     $items = $this->items_model->filterBy(['category' => $get['category'], 'is_active' => "1"], $comp_id, ucfirst($type));
        // } else {

        //     if( $role_id == 1 || $role_id == 2 ){
        //         $arg = array('type'=>ucfirst($type), 'is_active'=>1);
        //     }else{
        //         $arg = array('company_id'=>$comp_id, 'type'=>ucfirst($type), 'is_active'=>1);
        //     }

        //     $items = $this->items_model->getByWhere($arg);
        // }

        // $this->page_data['items'] = $this->categorizeNameAlphabetically($items);
        // $comp = array(
        //     'company_id' => $comp_id
        // );
        // $this->page_data['items_categories'] = $this->db->get_where($this->items_model->table_categories, $comp)->result();
        // //print_r($this->page_data['items']);
        // $this->load->view('inventory/import_items', $this->page_data);
    }

    public function importCSV(){
        $csvHeaders = json_decode($this->input->post('headers'), true);
        $csvRows = json_decode($this->input->post('rows'), true);
        $csvColumnLength = $this->input->post('columnLength');
        $csvRowLength = $this->input->post('rowLength');

        $data = array();
        $data['company_id'] = logged('company_id');

        for ($i = 0; $i < $csvRowLength ; $i++) { 

            for ($j = 0; $j < $csvColumnLength ; $j++) { 
                $data[$csvHeaders[$j]] = $csvRows[$i][$j];
            }
            $dataInsert = $this->general->add_return_id($data, 'items');
        }    
        echo 'true';
    }

    public function add()
    {
        $this->page_data['page']->title = 'Inventory';
        $this->page_data['page']->parent = 'Tools';

        $input = $this->input->post();
        if($input){
            $config = array(
                'upload_path' => "./uploads/",
                'allowed_types' => "gif|jpg|png|jpeg",
                'overwrite' => TRUE,
                'max_size' => "2048000",
                'max_height' => "768",
                'max_width' => "1024"
            );

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('attach_photo')) {
                $product_image = '';
            } else {
                $data = array('upload_data' => $this->upload->data());
                $product_image = $data['upload_data']['file_name'];
            }

            $data = array(
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
                'attached_image' => $product_image
            );
            $profile_id = $this->general->add_return_id($data, 'items');
            redirect(base_url('inventory'));
        }

        $get_items_categories = array(
            'where' => array('company_id' => logged('company_id')),
            'table' => 'item_categories',
            'select' => '*',
        );
        $this->page_data['item_categories'] = $this->general->get_data_with_param($get_items_categories);

        $get_vendors = array(
            'where' => array('company_id' => logged('company_id')),
            'table' => 'vendor',
            'select' => '*',
        );
        $this->page_data['vendors'] = $this->general->get_data_with_param($get_vendors);
        $this->page_data['page']->title = 'Inventory';
        $this->page_data['page']->parent = 'Tools';

        $getLocation = array(
            'where' => array(
                'company_id' => logged('company_id')
            ),
            'select' => 'loc_id, location_name, default',
            'table' => 'storage_loc'
        );
        $this->page_data['location'] = $this->general->get_data_with_param($getLocation);
        $this->page_data['custom_fields'] = $this->items_model->get_custom_fields_by_company_id(logged('company_id'));
        $this->load->view('v2/pages/inventory/action/inventory_add', $this->page_data);
        // $this->page_data['page_title'] = 'Add Inventory Item';
        // $this->load->view('inventory/add', $this->page_data);
    }
  
    public function saveItemsCategories()
    {
        postAllowed();
        $comp_id = logged('company_id');
        $data = array(
            'company_id' => $comp_id,
            'name' => $this->input->post('groupName'),
            'description' => $this->input->post('descriptionItemCat'),
            'parent_id' => $comp_id
        );
        if($this->db->insert($this->items_model->table_categories, $data)){
            echo 'sucess';
            $this->activity_model->add("New item Categories ".$this->input->post('groupName')." Created by User: #" . logged('id'));
        }else{
            echo 'error';
        }
    }

    public function ajax_create_item_category()
    {
        $this->load->model('Vendor_model');

        $post = $this->input->post();
        $cid  = logged('company_id');

        $data = array(
            'company_id' => $cid,
            'name' => $this->input->post('category_name'),
            'description' => $this->input->post('category_description'),
            'parent_id' => $cid
        );

        $this->db->insert($this->items_model->table_categories, $data);

        $json_data = ['is_success' => 1];

        echo json_encode($json_data);

    }

    public function save_new_item()
    {
        $input = $this->input->post();
        $input['is_active'] =  1;
        $input['company_id'] =  logged('company_id');
        $comp_id = logged('company_id');
        $data = array(
            'company_id' => $comp_id,
            'initial_qty' => $this->input->post('qty'),
            'qty' => $this->input->post('qty'),
            'loc_id' => $this->input->post('loc_id'),
            'insert_date' => date('Y-m-d H:i:s')
        );
    
        $customFields = $input['custom_field'];
        unset($input['custom_field']);

        unset($input['loc_id']);
        unset($input['qty']);
        $itemId = $this->items_model->insert($input);

        $data['item_id'] = $itemId;
        $this->items_model->saveNewItemLocation($data);

        if ($itemId) {
            if($customFields) {
                $customFieldsValue = [];
                foreach($customFields as $fieldId => $value) {
                    $customFieldsValue[] = [
                        'custom_field_id' => $fieldId,
                        'value' => $value,
                        'item_id' => $itemId
                    ];
                }

                $this->items_model->insert_custom_fields_value($customFieldsValue);
            }

            echo "1";
        } else {
            echo "0";
        }

        redirect('inventory');
    }

    public function edit_item( $id )
    {
        $this->page_data['page']->title = 'Inventory';
        $this->page_data['page']->parent = 'Tools';
        $get_vendors = array(
            'where' => array('company_id' => logged('company_id')),
            'table' => 'vendor',
            'select' => '*',
        );
        $this->page_data['vendors'] = $this->general->get_data_with_param($get_vendors);
        $get_items_categories = array(
            'where' => array('company_id' => logged('company_id')),
            'table' => 'item_categories',
            'select' => '*',
        );
        $this->page_data['item_categories'] = $this->general->get_data_with_param($get_items_categories);
        $this->page_data['item'] = $this->items_model->getByID($id);
        $this->page_data['custom_fields'] = $this->items_model->get_custom_fields_by_company_id(logged('company_id'));
        $this->load->view('v2/pages/inventory/action/inventory_edit', $this->page_data);
    }

    public function update_item() {
        $data = $this->input->post();
        $id   = $data['id'];
        unset($data['id']);        
        $company_id =  logged('company_id');
        if ( $this->items_model->update($data, array("id" => $id, 'company_id' => $company_id)) ) {
            echo "1";
        } else {
            echo "0";
        }
    }

    public function  update_service_item()
    {
        $data = $this->input->post();
        $id   = $data['sid'];
        unset($data['sid']);        
        $company_id =  logged('company_id');
        if ( $this->items_model->update($data, array("id" => $id, 'company_id' => $company_id)) ) {
            echo "1";
        } else {
            echo "0";
        }
    }

    public function  save_new_service()
    {
        $input = $this->input->post();
        $input['is_active'] =  1;
        $input['company_id'] =  logged('company_id');
        if ($this->general->add_($input, "items")) {
            echo "1";
        } else {
            echo "0";
        }
    }

    public function deleteLocation(){
        $post = $this->input->post();
        $id   = $post['id'];
        $item = $this->items_model->deleteLocation($id, TRUE);
    }
    public function deleteItemLocation(){
        $post = $this->input->post();
        $id   = $post['id'];
        $item = $this->items_model->deleteLocation($id);
    }
    public function delete()
    {
        $post = $this->input->post();
        $id   = $post['id'];
        $company_id =  logged('company_id');

        $item = $this->items_model->getItemById($id)[0];

        $attempt = 0;
        do {
            $name = $attempt > 0 ? "$item->title (deleted - $attempt)" : "$item->title (deleted)";
            $checkName = $this->items_model->check_name($company_id, $name, 1);

            $attempt++;
        } while(!is_null($checkName));

        $data = [
            'id' => $id,
            'name' => $name,
            'company_id' => logged('company_id')
        ];

        $delete = $this->items_model->inactiveItem($data);

        // $remove_item = array(
        //     'where' => array('id' =>$id, 'company_id' => $company_id),
        //     'table' => 'items'
        // );
        if ($delete) {

            $this->session->set_flashdata('alert-type', 'success');
            $this->session->set_flashdata('alert', 'Record was successfully deleted');

            echo '1';
        }
    }


    public function saveItems()
    {
        //postAllowed();
        $comp_id = logged('company_id');
        $id = $this->input->post('item_id');
        
        $config = array(
            'upload_path' => "./uploads/",
            'allowed_types' => "gif|jpg|png|jpeg",
            'overwrite' => TRUE,
            'max_size' => "2048000",
            'max_height' => "768",
            'max_width' => "1024"
        );

		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('attach_photo')) {
			$product_image = '';
		} else {
			$data = array('upload_data' => $this->upload->data());
			$product_image = $data['upload_data']['file_name'];
        }

        $data = array(
            'company_id' => $comp_id,
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
            'attached_image' => $product_image
        );

        $message_1 = "New";
        $message_2 = "New item Created Successfully";

        if ($id == "0") {
            $permission = $this->items_model->create($data);
        } else {
            $this->items_model->update($data, array("id" => $id));
            $message_1 = "Updated";
            $message_2 = "Item Updated Successfully";
        }

        $this->activity_model->add($message_1 . " item #$permission Created by User: #" . logged('id'));
        $this->session->set_flashdata('alert-type', 'success');
        $this->session->set_flashdata('alert', $message_2);
        
        redirect('inventory');
    }

    public function getItemById()
    {
        postAllowed();
        $id = $this->input->post('item_id');
        $item = $this->items_model->getItemById($id);

        echo json_encode($item);
    }

    public function saveServiceItems() 
    {
        postAllowed();

        $comp_id = logged('company_id');
        $permission = $this->items_model->create([
            'company_id' => $comp_id,
            'title' => $this->input->post('service_name'),
            'type' => $this->input->post('service_item_type'),
            'price' => $this->input->post('service_cost'),
            'description' => $this->input->post('service_description'),
            'frequency' => $this->input->post('service_frequency'),
            'is_active' => 1
        ]);

        $this->activity_model->add("New item #$permission Created by User: #" . logged('id'));
        $this->session->set_flashdata('alert-type', 'success');
        $this->session->set_flashdata('alert', 'New item Created Successfully');
        
        redirect('inventory?type=service');
    }
    
    public function saveFeeItems()
    {
        postAllowed();

        $comp_id = logged('company_id');
        $permission = $this->items_model->create([
            'company_id' => $comp_id,
            'title' => $this->input->post('fee_name'),
            'type' => $this->input->post('fee_item_type'),
            'price' => $this->input->post('fee_cost'),
            'description' => $this->input->post('fee_desc'),
            'frequency' => $this->input->post('fee_frequency'),
            'is_active' => 1
        ]);

        $this->activity_model->add("New item #$permission Created by User: #" . logged('id'));
        $this->session->set_flashdata('alert-type', 'success');
        $this->session->set_flashdata('alert', 'New item Created Successfully');
        
        redirect('inventory?type=fees');
    }

    public function exportItems()
    {
        $items = $this->items_model->getByCompanyId(logged('company_id'));
        $delimiter = ",";
        $filename = getLoggedName()."_items.csv";

        $f = fopen('php://memory', 'w');
  
        $fields = array('Model #', 'Name', 'Price', 'Description', 'Brand', 'Item Vendor', 'Item Type', 'Item Cost', 'Link/Url', 'Image', 'QTH-OH', 'Locations');
        fputcsv($f, $fields, $delimiter);

        if (!empty($items)) {       
            foreach ($items as $item) {
                $locations = $this->items_model->getLocationByItemId($item->id);
                $qty = 0;
                $loc = "";
                foreach ($locations as $location) {
                    $qty += intval($location['qty']);
                    $loc .= $location['name'] . '->' . $location['qty'] . '|';
                }
                $csvData = array($item->model, $item->title, '$'.number_format($item->price,2,".",","), $item->description, $item->brand, $item->vendor_id, $item->type, $item->COGS, $item->url, '', $qty, $loc);
                fputcsv($f, $csvData, $delimiter);
            }
        } else {
            $csvData = array('');
            fputcsv($f, $csvData, $delimiter);
        }

        fseek($f, 0);

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '";');

        fpassthru($f);
    }

    public function importItems () {
        $data = array();
        $itemData = array();
        $last_id = 0;
        
        if ($this->input->post('importSubmit')) {
            $this->form_validation->set_rules('file', 'CSV file', 'callback_file_check');
            
            if ($this->form_validation->run() == true) {
                $insertCount = $updateCount = $rowCount = $notAddCount = 0;
                
                if (is_uploaded_file($_FILES['file']['tmp_name'])) {
                    $this->load->library('CSVReader');
                    
                    $csvData = $this->csvreader->parse_csv($_FILES['file']['tmp_name']);
                    
                    if (!empty($csvData)) {
                        foreach ($csvData as $row) { 
                            $rowCount++;
                            
                            $price = explode("$",$row['Price']);
                            $itemData = array(
                                'company_id' => logged('company_id'),
                                'title' => $row['Name'],
                                'model' => $row['Model #'],
                                'brand' => $row['Brand'],
                                'price' => intval($price[1]),
                                'description' => $row['Description'],
                                'vendor_id' => intval($row['Item Vendor']),
                                'COGS' => intval($row['Item Cost']),
                                'url' => $row['Link/Url'],
                                'type' => "product",
                                'is_active' => 1
                            );
                            
                            $con = array(
                                'where' => array(
                                    'title' => $row['Name']
                                ),
                                'returnType' => 'count'
                            );
                            $prevCount = $this->items_model->getRows($con);
                            
                            if ($prevCount > 0) {
                                $condition = array('title' => $row['Name']);
                                $update = $this->items_model->update($itemData, $condition);
                                $updateItem = $this->items_model->getByName($row['Name']);
                                $last_id = $updateItem[0]->id;
                                if ($update) {
                                    $updateCount++;
                                }
                            } else {
                                $insert = $this->items_model->insert($itemData);
                                $last_id = $insert;
                                
                                if ($insert) {
                                    $insertCount++;
                                }
                            }
                            $locations = explode("|",$row['Locations']);

                            foreach($locations as $location) {
                                if($locations[0] != "") {
                                    $location_quantities = explode("->",$location);
    
                                    $data = array(
                                        'company_id' => logged('company_id'),
                                        'initial_qty' => $location_quantities[1],
                                        'qty' => $location_quantities[1],
                                        'name' => $location_quantities[0],
                                        'item_id' => $last_id,
                                        'insert_date' => date('Y-m-d H:i:s')
                                    );
                                    $this->items_model->saveNewItemLocation($data);
                                }
                            }
                        }
                        
                        $notAddCount = ($rowCount - ($insertCount + $updateCount));
                        $successMsg = 'inventory imported successfully. Total Rows ('.$rowCount.') | Inserted ('.$insertCount.') | Updated ('.$updateCount.') | Not Inserted ('.$notAddCount.')';
                        $this->session->set_userdata('success_msg', $successMsg);

                        $this->activity_model->add($successMsg);
                        $this->session->set_flashdata('alert-type', 'success');
                        $this->session->set_flashdata('alert', $successMsg);
                    }
                } else {
                    $this->session->set_userdata('error_msg', 'Error on file upload, please try again.');
                }
            } else {
                $this->session->set_userdata('error_msg', 'Invalid file, please select only CSV file.');
            }
        }
        redirect('inventory');
    }
    
    /*
     * Callback function to check file value and type during validation
     */
    public function file_check($str){
        $allowed_mime_types = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
        if(isset($_FILES['file']['name']) && $_FILES['file']['name'] != ""){
            $mime = get_mime_by_extension($_FILES['file']['name']);
            $fileAr = explode('.', $_FILES['file']['name']);
            $ext = end($fileAr);
            if(($ext == 'csv') && in_array($mime, $allowed_mime_types)){
                return true;
            }else{
                $this->form_validation->set_message('file_check', 'Please select only CSV file to upload.');
                return false;
            }
        }else{
            $this->form_validation->set_message('file_check', 'Please select a CSV file to upload.');
            return false;
        }
    }


    public function categorizeNameAlphabetically($items) {
        $result = array();

        $cat = array(
            '#' => array(),
            'A' => array(),
            'B' => array(),
            'C' => array(),
            'D' => array(),
            'E' => array(),
            'F' => array(),
            'G' => array(),
            'H' => array(),
            'I' => array(),
            'J' => array(),
            'K' => array(),
            'L' => array(),
            'M' => array(),
            'N' => array(),
            'O' => array(),
            'P' => array(),
            'Q' => array(),
            'R' => array(),
            'S' => array(),
            'T' => array(),
            'U' => array(),
            'V' => array(),
            'W' => array(),
            'X' => array(),
            'Y' => array(),
            'Z' => array()
        );

        foreach($items as $item) {
            $letter = ucfirst(substr($item->title,0,1));
            foreach($cat as $key => $c) {
                if ($letter == $key) {
                    array_push($cat[$key], $item);
                } else if (is_numeric($letter)) {
                    if (!in_array($item, $cat["#"]))
                        array_push($cat["#"], $item);
                }
            }
        }
        
        foreach($cat as $key => $c) {
            if(!empty($c)) {
                // $header = array($key, "header", "", "");
                // array_push($result,$header);

                foreach($c as $v) {
                    $value = array($v->title, $v->description, $v->brand, $v->id, $v->price, $v->frequency, $v->estimated_time, $v->model,$v->qty_order,$v->re_order_points, $v->id);
                    array_push($result,$value);
                }
            }
        }
        
        return $result;
    }

    public function deleteMultiple() {
        postAllowed();
        $ids = explode(",",$this->input->post('ids'));
        
        foreach($ids as $id) {
            $item = $this->items_model->getItemById($id)[0];

            $attempt = 0;
            do {
                $name = $attempt > 0 ? "$item->title (deleted - $attempt)" : "$item->title (deleted)";
                $checkName = $this->items_model->check_name(logged('company_id'), $name, 1);

                $attempt++;
            } while(!is_null($checkName));

            $condition = ['id' => $id, 'company_id' => logged('company_id')];
            $update = $this->items_model->update($data, $condition);
            $this->items_model->delete($id);
        }

        echo json_encode(true);
    }

    public function deleteMultipleVendor() {
        postAllowed();
        $ids = explode(",",$this->input->post('ids'));
        
        foreach($ids as $id) {
            $this->vendor_model->deleteByVendorId($id);
        }

        echo json_encode(true);
    }

    public function deleteMultipleItemGroup() {
        postAllowed();
        $ids = explode(",",$this->input->post('ids'));
        
        foreach($ids as $id) {
            $this->itemcategory_model->deleteByItemCategoryId($id);
        }

        echo json_encode(true);
    }

    public function addNewLocation(){
        postAllowed();
        $COMPANY_ID = logged('company_id');
        $LOCATION_NAME = $this->input->post('name');
        $DEFAULT = $this->input->post('DEFAULT_LOCATION');

        if ($DEFAULT == "true") {
            $this->items_model->clearDefaultLocation();
            $LOCATION_DATA = array(
                'company_id'=> $COMPANY_ID,
                'location_name' => $LOCATION_NAME,
                'default' => $DEFAULT,
            );
        } else {
            $LOCATION_DATA = array(
                'company_id'=> $COMPANY_ID,
                'location_name' => $LOCATION_NAME,
                'default' => "",
            );
        }

        $result = $this->general->add_($LOCATION_DATA, 'storage_loc');
        echo json_encode($result);
    }
    public function addNewItemLocation() {
        $executeOnce = 0;
        postAllowed();

        $comp_id = logged('company_id');
        $data = array(
            'company_id' => $comp_id,
            'initial_qty' => $this->input->post('qty'),
            'qty' => $this->input->post('qty'),
            'loc_id' => $this->input->post('loc_id'),
            'item_id' => $this->input->post('item_id'),
            'insert_date' => date('Y-m-d H:i:s')
        );

        // $this->items_model->saveNewItemLocation($data);
        $result = $this->items_model->getLocationByItemId($this->input->post('item_id'));

        if ($executeOnce == 0) {
            $executeOnce = 1;
            $this->items_model->recordItemTransaction($this->input->post('item_id'), $this->input->post('qty'), $this->input->post('loc_id'), "add");
        }
        echo json_encode($result);
    }
    public function editLocation() {
        postAllowed();
        $ID = $this->input->post('loc_id');
        $LOCATION_NAME = $this->input->post('location_name');
        $DEFAULT = $this->input->post('DEFAULT_LOCATION');

        if ($DEFAULT == "true") {
            $this->items_model->clearDefaultLocation();
            $LOCATION_DATA = array(
                'location_name' => $LOCATION_NAME,
                'default' => $DEFAULT,
            );
        } else {
            $LOCATION_DATA = array(
                'location_name' => $LOCATION_NAME,
                'default' => "",
            );
        }

        // $this->items_model->updateLocation($id, $data, 'storage_loc');
        $this->general->update_with_key_field($LOCATION_DATA, $ID, 'storage_loc', 'loc_id');

        echo json_encode(["message" => "success"]);
    }

    public function getItemLocations() {
        postAllowed();
        $result = $this->items_model->getLocationByItemId($this->input->post('item_id'));
        echo json_encode($result);
    }

    public function inventory_export()
    {
        $cid   = logged('company_id');
        $items = $this->items_model->getByCompanyId($cid);    

        $delimiter = ",";
        $time      = time();
        $filename  = "inventory_list_".$time.".csv";

        $f = fopen('php://memory', 'w');

        $fields = array('Item Name', 'Type', 'Model', 'Brand', 'Price', 'Retail', 'Rebate', 'units', 'Qty Order');
        fputcsv($f, $fields, $delimiter);

        if (!empty($items)) {
            foreach ($items as $i) {
                $csvData = array(
                    $i->title,
                    $i->type,
                    $i->model,
                    $i->brand,
                    number_format($i->price,2),
                    number_format($i->retail,2),
                    number_format($i->rebate, 2),
                    $i->units,
                    $i->qty_order
                );
                fputcsv($f, $csvData, $delimiter);
            }
        } else {
            $csvData = array('');
            fputcsv($f, $csvData, $delimiter);
        }

        fseek($f, 0);

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '";');

        fpassthru($f);
    }

    public function edit_fee( $id  ){
        // $this->page_data['page']->title = 'Fees';
        // $this->page_data['page']->parent = 'Tools';
        // $cid = logged('company_id');
        // $item = $this->items_model->getCompanyItemById($cid, $id);
        // $this->page_data['item'] = $item;
        // $this->load->view('inventory/fees_edit', $this->page_data);

        $this->page_data['page']->title = 'Fees';
        $this->page_data['page']->parent = 'Tools';
        $comp_id = logged('company_id');        
        $arg     = array('company_id'=>$comp_id, 'id' => $id, 'is_active'=>1);
        $item    = $this->items_model->getCompanyItemById($comp_id, $id);
        $this->page_data['item'] = $item;
        // $this->load->view('inventory/fees_edit', $this->page_data);
        $this->load->view('v2/pages/inventory/action/fees_edit', $this->page_data);
    }

    public function update_fees(){
        $post = $this->input->post();
        $cid  = logged('company_id');
        $item = $this->items_model->getCompanyItemById($cid, $post['fid']);

        if( $item ){
            $data = [
                'title' => $post['title'],
                'description' => $post['description'],
                'price' => $post['price'],
                'frequency' => $post['frequency']
            ];

            $this->items_model->update($data, array("id" => $item->id, 'company_id' => $cid));

            $this->session->set_flashdata('alert-type', 'success');
            $this->session->set_flashdata('alert', 'Record was successfully udpated');
        }else{
            $this->session->set_flashdata('message', 'Record not found.');
            $this->session->set_flashdata('alert_class', 'alert-danger');            
        }

        redirect('v2/pages/inventory/fees');
    }

    public function add_vendor()
    {
        $this->page_data['page']->title = 'Vendors';
        $this->page_data['page']->parent = 'Tools';
        // $this->load->view('inventory/vendor_add', $this->page_data);
        $this->load->view('v2/pages/inventory/action/vendors_add', $this->page_data);
    }

    public function ajax_create_vendor()
    {
        $this->load->model('Vendor_model');

        $post = $this->input->post();
        $cid  = logged('company_id');

        $data = [
            'company_id' => $cid,
            'vendor_name' => $post['vendor_name'],
            'status' => 0,
            'business_URL' => $post['vendor_website'],
            'email' => $post['vendor_email'],
            'mobile' => $post['vendor_mobile'],
            'phone' => $post['vendor_phone'],
            'street_address' => $post['vendor_address'],
            'suite_unit' => $post['vendor_suite_unit'],
            'city' => $post['vendor_city'],
            'postal_code' => $post['vendor_postal_code'],
            'state' => $post['vendor_state']
        ];

        $this->Vendor_model->create($data);

        $json_data = ['is_success' => 1];

        echo json_encode($json_data);

    }

    public function edit_vendor( $id )
    {
        $this->load->model('Vendor_model');
        $this->page_data['page']->title = 'Vendors';
        $this->page_data['page']->parent = 'Tools';

        $cid  = logged('company_id');
        $vendor = $this->Vendor_model->getByIdAndCompanyId($id, $cid);
        if( $vendor ){
            $this->page_data['vendor'] = $vendor;
            // $this->load->view('inventory/vendor_edit', $this->page_data);
            $this->load->view('v2/pages/inventory/action/vendors_edit', $this->page_data);
        }else{
            
            $this->session->set_flashdata('message', 'Record not found.');
            $this->session->set_flashdata('alert_class', 'alert-danger');   

            redirect('v2/pages/inventory/vendors');
        }
    }

    public function edit_item_category( $id )
    {
        $this->load->model('ItemCategory_model');
        $this->page_data['page']->title = 'Item Categories';
        $this->page_data['page']->parent = 'Tools';

        $cid  = logged('company_id');
        $itemCategory = $this->ItemCategory_model->getByIdAndCompanyId($id, $cid);
        if( $itemCategory ){
            $this->page_data['itemCategory'] = $itemCategory;
            $this->load->view('v2/pages/inventory/action/item_groups_edit', $this->page_data);
        }else{
            
            $this->session->set_flashdata('message', 'Record not found.');
            $this->session->set_flashdata('alert_class', 'alert-danger');   

            redirect('v2/pages/inventory/item_groups');
        }
    }

    public function ajax_update_vendor()
    {
        $this->load->model('Vendor_model');

        $is_success = 0;

        $post = $this->input->post();
        $cid  = logged('company_id');

        $vendor = $this->Vendor_model->getByIdAndCompanyId($post['vid'], $cid);
        if( $vendor ){
            $data = [
                'vendor_name' => $post['vendor_name'],
                'business_URL' => $post['vendor_website'],
                'email' => $post['vendor_email'],
                'mobile' => $post['vendor_mobile'],
                'phone' => $post['vendor_phone'],
                'street_address' => $post['vendor_address'],
                'suite_unit' => $post['vendor_suite_unit'],
                'city' => $post['vendor_city'],
                'postal_code' => $post['vendor_postal_code'],
                'state' => $post['vendor_state']
            ];

            $this->Vendor_model->updateVendor($post['vid'],$data);

            $is_success = 1;
        }

        $json_data = ['is_success' => $is_success];

        echo json_encode($json_data);

    }

    public function ajax_update_item_category()
    {
        $this->load->model('ItemCategory_model');

        $is_success = 0;

        $post = $this->input->post();
        $cid  = logged('company_id');

        $itemCategory = $this->ItemCategory_model->getByIdAndCompanyId($post['icid'], $cid);
        if( $itemCategory ){
            $data = [
                'name' => $post['category_name'],
                'description' => $post['category_description']
            ];

            $this->ItemCategory_model->updateItemCategory($post['icid'],$data);

            $is_success = 1;
        }

        $json_data = ['is_success' => $is_success];

        echo json_encode($json_data);

    }

    public function ajax_delete_vendor()
    {
        $this->load->model('Vendor_model');

        $is_success = 0;

        $post = $this->input->post();
        $cid  = logged('company_id');

        $vendor = $this->Vendor_model->getByIdAndCompanyId($post['id'], $cid);
        if( $vendor ){
            
            $this->Vendor_model->deleteByVendorId($post['id']);

            $is_success = 1;
        }

        $json_data = ['is_success' => $is_success];

        echo json_encode($json_data);
    }

    public function ajax_delete_item_category()
    {
        $this->load->model('ItemCategory_model');

        $is_success = 0;

        $post = $this->input->post();
        $cid  = logged('company_id');

        $itemCategory = $this->ItemCategory_model->getByIdAndCompanyId($post['id'], $cid);
        if( $itemCategory ){
            
            $this->ItemCategory_model->deleteByItemCategoryId($post['id']);

            $is_success = 1;
        }

        $json_data = ['is_success' => $is_success];

        echo json_encode($json_data);
    }

    public function settings()  
    {
        $this->page_data['page']->title = 'Inventory Settings';
		$this->page_data['page']->parent = 'Tools';

        $this->page_data['fields'] = $this->items_model->get_custom_fields_by_company_id(logged('company_id'));
        $this->load->view('v2/pages/inventory/settings', $this->page_data);
    }

    public function location() 
    {
        $this->page_data['page']->title = 'Location';
		$this->page_data['page']->parent = 'Tools';
        $company_id = logged('company_id');
        $data = array(
            'where' => array(
                'company_id' => $company_id
            ),
            "table" => 'storage_loc'
        );
        $this->page_data['location']  = $this->general->get_data_with_param($data);
        $this->load->view('v2/pages/inventory/location/list', $this->page_data);
    }

    public function getItemLocationNameById(){
        $input = $this->input->post();
        $company_id = logged('company_id');
        $data = array(
            'where' => array(
                'id' => $input['id']
            ),
            'table' => 'items_has_storage_loc',
            'select' => 'loc_id'
        );
        $LOCATION  = $this->general->get_data_with_param($data, FALSE);
        $get_location_name = array(
            'where' => array(
                'loc_id' => $LOCATION->loc_id,
                'company_id' => $company_id
            ),
            'table' => 'storage_loc',
        );
        $LOCATION_NAME  = $this->general->get_data_with_param($get_location_name, FALSE);
        $json_data = ['locations' => $LOCATION_NAME];
        echo json_encode($json_data);
        
    }

    public function getLocationNameById(){
        $input = $this->input->post();
        $data = array(
            'where' => array(
                'loc_id' => $input['id']
            ),
            'table' => 'storage_loc',
            'select' => 'location_name'
        );
        $LOCATION_NAME  = $this->general->get_data_with_param($data, FALSE);
        $json_data = ['location' => $LOCATION_NAME];
        echo json_encode($json_data);
    }

    public function addInventoryLocation() 
    {
        $this->page_data['page']->title = 'Location';
		$this->page_data['page']->parent = 'Tools';

        $this->load->view('v2/pages/inventory/location/add', $this->page_data);
    }
    public function editInventoryLocation($id) 
    {
        $this->page_data['page']->title = 'Location';
		$this->page_data['page']->parent = 'Tools';
        $this->page_data['location'] = $this->items_model->getLocationById($id);
        $this->load->view('v2/pages/inventory/location/edit', $this->page_data);
    }
    public function updateItemLocationQty(){
        $input = $this->input->post();
        $data = array(
            'qty' => $input['qty']
        );
        $this->general->update_with_key_field($data, $input['id'], 'items_has_storage_loc', 'id');
        echo json_encode(["message" => "success"]);

    }
    public function selectLocation()
    {
        $company_id = logged('company_id');
        $data = array(
            'where' => array(
                'company_id' => $company_id
            ),
            "table" => 'storage_loc'
        );
        $items = $this->general->get_data_with_param($data);

        foreach($items as $item){
            $result[] = [
                'loc_id' => $item->loc_id,
                'location_name' => $item->location_name
            ]; 
        }   
    

        die(json_encode($result));   
    }

    public function add_custom_field()
    {
        $data = [
            'name' => $this->input->post('custom_field_name'),
            'company_id' => logged('company_id')
        ];

        $customFieldId = $this->items_model->add_custom_field($data);

        redirect('inventory/settings');
    }

    public function update_custom_field($id)
    {
        $data = [
            'name' => $this->input->post('custom_field_name')
        ];

        $update = $this->items_model->update_custom_field_name($id, $data);

        redirect($_SERVER['HTTP_REFERER']);
    }

    // public function TEST_SERVERSIDE() {
    //     $comp_id                            = logged('company_id');
    //     $role_id                            = logged('role');
    //     if ($role_id == 1 || $role_id == 2) {
    //         $this->page_data['SERVERSIDE_QUERY'] = "SELECT * FROM items WHERE is_active = '1'";
    //         // $arg = array(
    //         //     'type' => ucfirst($type),
    //         //     'is_active' => 1
    //         // );
    //     } else {
    //         $this->page_data['SERVERSIDE_QUERY'] = "SELECT * FROM items WHERE is_active = '1' AND company_id = '$comp_id'";
    //         // $arg = array(
    //         //     'company_id' => $comp_id,
    //         //     'type' => ucfirst($type),
    //         //     'is_active' => 1
    //         // );
    //     }
    //     $this->load->view('v2/pages/inventory/TABLE_SERVERSIDE/INVENTORY_TABLE', $this->page_data);
    // }
}
/* End of file items.php */

/* Location: ./application/controllers/items.php */
