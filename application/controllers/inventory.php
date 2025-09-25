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
        if(!checkRoleCanAccessModule('inventory', 'read')){
			show403Error();
			return false;
		}

        $is_archived = 0;

        $this->page_data['page']->title = 'Inventory';
        $this->page_data['page']->parent = 'Tools';

        $get = $this->input->get();
        $this->page_data['items'] = $this->items_model->get();
        $comp_id = logged('company_id');
        $this->page_data['active_category'] = "Show All";
        $type    = $this->page_data['type']  = (!empty($get['type'])) ? $get['type'] : "product";
        $role_id = intval(logged('role'));
        if (!empty($get['category'])) {
            $this->page_data['category'] = $get['category'];
            $this->page_data['active_category'] = $get['category'];
            $items = $this->items_model->filterBy(['category' => $get['category'], 'type' => 'product', 'is_active' => "1", 'is_archived' => $is_archived], $comp_id, ucfirst($type));
        } else {
            $arg   = array('company_id'=>$comp_id, 'type' => 'product', 'is_active' => 1, 'is_archived' => $is_archived); 
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
        $this->page_data['user_item_transaction_history'] = $this->items_model->getItemTransactionHistory("USER");
        $this->page_data['customer_transaction_history'] = $this->items_model->getItemTransactionHistory("CUSTOMER");
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
            $this->page_data['category'] = $get['category'];
            $this->page_data['active_category'] = $get['category'];
            $items = $this->items_model->filterBy(['category' => $get['category'], 'is_active' => "1"], $comp_id, ucfirst($type));
        } else {                        
            $items = $this->items_model->getAllActiveServicesByCompanyId($comp_id);
        }
        $this->page_data['items'] = $this->categorizeNameAlphabetically($items);
        $comp = array(
            'company_id' => $comp_id
        );
        $this->page_data['items_categories'] = $this->db->get_where($this->items_model->table_categories, $comp)->result();

        if($page == null){
            if(!checkRoleCanAccessModule('inventory', 'read')){
                show403Error();
                return false;
            }
            $this->load->view('v2/pages/inventory/services', $this->page_data);
        }else if ($page == 'add'){
            if(!checkRoleCanAccessModule('inventory', 'write')){
                show403Error();
                return false;
            }
            $this->load->view('v2/pages/inventory/action/services_add', $this->page_data);
        }
    }

    public function edit_services($id)
    {
        $this->page_data['page']->title = 'Services';
        $comp_id = logged('company_id');        
        $arg     = array('company_id' => $comp_id, 'id' => $id, 'is_active' => 1);
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
            $this->page_data['category'] = $get['category'];
            $this->page_data['active_category'] = $get['category'];
            $items = $this->items_model->filterBy(['category' => $get['category'], 'is_active' => "1"], $comp_id, ucfirst($type));
        } else {
            $arg = array('company_id'=>$comp_id, 'type'=>ucfirst($type), 'is_active'=>1);
            $items = $this->items_model->getByWhere($arg);
        }

        $this->page_data['items'] = $this->categorizeNameAlphabetically($items);

        if($page == null){
            if(!checkRoleCanAccessModule('inventory', 'read')){
                show403Error();
                return false;
            }
            $this->load->view('v2/pages/inventory/fees', $this->page_data);
        }else if ($page == 'add'){
            if(!checkRoleCanAccessModule('inventory', 'write')){
                show403Error();
                return false;
            }
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
            if(!checkRoleCanAccessModule('inventory', 'read')){
                show403Error();
                return false;
            }

            $this->load->view('v2/pages/inventory/item_groups', $this->page_data);
        }else if ($page == 'add'){
            if(!checkRoleCanAccessModule('inventory', 'write')){
                show403Error();
                return false;
            }

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
        if(!checkRoleCanAccessModule('inventory', 'read')){
            show403Error();
            return false;
        }

        $get_vendors = array(
            'where' => array('company_id' => logged('company_id')),
            'table' => 'vendor',
            'select' => '*',
        );

        $this->page_data['page']->title = 'Vendors';
        $this->page_data['page']->parent = 'Tools';
        $this->page_data['vendors'] = $this->general->get_data_with_param($get_vendors);
        $this->load->view('v2/pages/inventory/vendors', $this->page_data);
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
            $data['is_active'] = 1;
            $dataInsert = $this->general->add_return_id($data, 'items');
        }    
        echo 'true';
    }

    public function add()
    {        
        if(!checkRoleCanAccessModule('inventory', 'write')){
			show403Error();
			return false;
		}

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

        $is_success = 0;
        $msg = 'Cannot save data';

        $post = $this->input->post();
        $company_id = logged('company_id');

        $isExists = $this->items_model->findItemCategoryByName($post['category_name']);
        if( $isExists && $isExists->company_id == $company_id ){
            $msg = 'Category name ' . $post['category_name'] . ' already exists';
        }else{
            $data = array(
                'company_id' => $company_id,
                'name' => $post['category_name'],
                'description' => $post['category_description'],
                'parent_id' => 0
            );
            $this->items_model->createItemCategory($data);

            //Activity Logs
            $activity_name = 'Inventory : Created item category '.$post['category_name']; 
            createActivityLog($activity_name);

            $is_success = 1;
            $msg = '';

        }

        $json_data = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($json_data);

    }

    public function save_new_item()
    {
        $is_success = 0;
        $msg = 'Cannot save data.';

        $input = $this->input->post();

        $input['is_active'] = 1;
        $input['company_id'] = logged('company_id');
        
        $item = $this->items_model->getByItemTitleAndCompanyId($input['title'], $input['company_id']);
        if( !$item ){
            $ITEM_DATA = array(
                'company_id' => $input['company_id'],
                'title' => $input['title'],
                'brand' => $input['brand'],
                'price' => $input['price'],
                'retail' => $input['retail'],
                'cost_per' => $input['cost_per'],
                'units' => $input['units'],
                'vendor_id' => $input['vendor_id'],
                'type' => $input['type'],
                'url' => $input['url'],
                'COGS' => $input['COGS'],
                'model' => $input['model'],
                'serial_number' => $input['serial_number'],
                'points' => $input['points'],
                'qty_order' => $input['qty_order'],
                're_order_points' => $input['re_order_points'],
                'item_categories_id' => $input['item_categories_id'],
                'description' => $input['description'],
                'is_active' => $input['is_active'],
            );
            $ITEM_ID = $this->items_model->insert($ITEM_DATA);
    
            for ($i = 0; $i < count($input['loc_id']); $i++) { 
                $STORAGE_LOCATION_DATA = array(
                    'item_id' => $ITEM_ID,
                    'company_id' => $input['company_id'],
                    'initial_qty' => $input['initial_quantity'],
                    'qty' => $input['initial_quantity'],
                    'loc_id' => $input['loc_id'][$i],
                    'insert_date' => date('Y-m-d H:i:s'),
                );
                $this->items_model->saveNewItemLocation($STORAGE_LOCATION_DATA);
            }
    
            $customFields = $input['custom_field'];
            unset($input['custom_field']);
    
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
            } 

            //Activity Logs
            $activity_name = 'Inventory : Created item '.$input['title']; 
            createActivityLog($activity_name);

            $is_success = 1;
            $msg = '';
        }else{
            $msg = 'Item name already exists.';
        }
        
        $json_data = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($json_data);
    }

    public function edit_item( $id )
    {
        if(!checkRoleCanAccessModule('inventory', 'write')){
			show403Error();
			return false;
		}

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
        $getAllLocation = array(
            'where' => array(
                'company_id' => logged('company_id')
            ),
            'select' => 'loc_id, location_name, default',
            'table' => 'storage_loc'
        );
        $this->page_data['getAllLocation'] = $this->general->get_data_with_param($getAllLocation);
        $this->page_data['selectedLocation'] = $this->items_model->getSelectedLocation($id);
        $this->page_data['item_categories'] = $this->general->get_data_with_param($get_items_categories);
        $this->page_data['item'] = $item = $this->items_model->getByID($id);
        $this->page_data['custom_fields'] = $this->items_model->get_custom_fields_by_company_id(logged('company_id'));
        
        $this->load->view('v2/pages/inventory/action/inventory_edit', $this->page_data);
    }

    public function update_item() {
        $input = $this->input->post();
    
        $ITEM_DATA = array(
            'title' => $input['title'],
            'brand' => $input['brand'],
            'price' => $input['price'],
            'retail' => $input['retail'],
            'cost_per' => $input['cost_per'],
            'units' => $input['units'],
            'vendor_id' => $input['vendor_id'],
            'type' => $input['type'],
            'url' => $input['url'],
            'COGS' => $input['COGS'],
            'model' => $input['model'],
            'serial_number' => $input['serial_number'],
            'points' => $input['points'],
            'qty_order' => $input['qty_order'],
            're_order_points' => $input['re_order_points'],
            'item_categories_id' => $input['item_categories_id'],
            'description' => $input['description'],
        );
        $UPDATE_ITEM_DATA = $this->items_model->update($ITEM_DATA, array(
            "id" => $input['item_id']
        ));

        //Activity Logs
        $activity_name = 'Inventory : Update Item '. $input['title']; 
        createActivityLog($activity_name);

       // echo $UPDATE_ITEM_DATA;
    }

    public function create_service_item() {
        $input = $this->input->post();

        $input['is_active'] = 1;
        $input['company_id'] = logged('company_id');
    
        $ITEM_DATA = array(
            'company_id' => $input['company_id'],
            'title' => $input['title'],            
            'price' => $input['price'],
            'estimated_time' => $input['estimated_time'],
            'frequency' => $input['frequency'],
            'vendor_id' => 0,
            'type' => 'Service',            
            'description' => $input['description'],
            'is_active' => $input['is_active'],
        );
        $ITEM_ID = $this->items_model->insert($ITEM_DATA);
        echo "1";
    }

    public function ajax_create_service() 
    {
        $is_success = 0;
        $msg   = 'Cannot create data';

        $input      = $this->input->post();
        $company_id = logged('company_id');

        $isItemExists = $this->items_model->getItemByTitleAndCompanyId($input['title'], $company_id);
        if( !$isItemExists ){
            $data = array(
                'company_id' => $company_id,
                'title' => $input['title'],            
                'price' => $input['price'],
                'estimated_time' => $input['estimated_time'],
                'frequency' => $input['frequency'],
                'vendor_id' => 0,
                'type' => 'Service',            
                'description' => $input['description'],
                'is_active' => 1,
            );
            $this->items_model->insert($data);
            
            //Activity Logs
            $activity_name = 'Inventory : Created item '.$input['title']; 
            createActivityLog($activity_name);

            $is_success = 1;
            $msg = '';

        }else{
            $msg = 'Item name already exists.';
        }
        
        $json_data = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($json_data);
    }

    public function create_fee_item() {
        $input = $this->input->post();

        $input['is_active'] = 1;
        $input['company_id'] = logged('company_id');
    
        $ITEM_DATA = array(
            'company_id' => $input['company_id'],
            'title' => $input['title'],            
            'price' => $input['price'],
            'estimated_time' => 0,
            'frequency' => $input['frequency'],
            'vendor_id' => 0,
            'type' => 'Fees',            
            'description' => $input['description'],
            'is_active' => $input['is_active'],
        );
        $ITEM_ID = $this->items_model->insert($ITEM_DATA);
        echo "1";
    }

    public function  update_service_item()
    {
        $data = $this->input->post();

        $is_success = 0;
        $msg        = 'Cannot save data';

        if($data['estimated_time'] >= 0) {
            $id = $data['sid'];
            unset($data['sid']);        
            $company_id = logged('company_id');
            if ( $this->items_model->update($data, array("id" => $id, 'company_id' => $company_id)) ) {
                $is_success = 1;
                $msg        = "Service was updated successfully!";
            } else {
                $is_success = 0;
            }
        } else {
            $is_success = 0;
        }

        $json_data = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($json_data);
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

        //Activity Logs
        $activity_name = 'Inventory Location : Deleted location ' . $item->location_name;
        createActivityLog($activity_name);           
    }

    public function deleteItemLocation(){
        $is_success = 0;
        $msg = '';
        $item_id = 0;

        $post = $this->input->post();
        $id   = $post['id'];
        $cid  = logged('company_id');

        $storageLocation = $this->items_model->getItemStorageLocationByIdAndCompanyId($id, $cid);
        if( $storageLocation ){
            $item_id = $storageLocation->item_id;
            $item = $this->items_model->deleteLocation($id);

            $is_success = 1;
            $msg = '';         
        }
        
        $json_data = [
            'is_success' => $is_success,
            'msg' => $msg,
            'item_id' => $item_id
        ];

        echo json_encode($json_data);
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

        $name = $item->title;
        $data = [
            'id' => $id,
            'name' => $name,
            'company_id' => logged('company_id')
        ];

        $is_inactived = $this->items_model->inactiveItem($data);
        $is_archived  = $this->items_model->archivedItem($data);
        

        if ($is_archived) {

            //Activity Logs
            $activity_name = 'Inventory : Archived item '. $item->title; 
            createActivityLog($activity_name);
            
            echo '1';
        }
    }

    public function ajax_delete()
    {
        $is_success = 0;
        $msg = 'Cannot find data';
        $post = $this->input->post();
        $id   = $post['id'];
        $company_id =  logged('company_id');

        $item = $this->items_model->getByID($id);
        if( $item && $item->company_id == $company_id ){
            $data = [
                'id' => $id,
                'company_id' => $company_id
            ];

            $delete = $this->items_model->inactiveItem($data);
            $is_archived  = $this->items_model->archivedItem($data);

            //Activity Logs
            $activity_name = 'Inventory : Archived item '.$item->title; 
            createActivityLog($activity_name);

            $is_success = 1;
            $msg = '';
        }

        $json_data = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($json_data);
    }

    public function ajax_delete_selected()
    {
        $is_success = 0;
        $msg = 'Please select item(s).';

        $post = $this->input->post();

        if( $post['items'] ){
            foreach($post['items'] as $id) {    
                $item = $this->items_model->getByID($id);
                if( $item ){
                    $attempt = 0;
                    do {
                        $name = $attempt > 0 ? "$item->title (deleted - $attempt)" : "$item->title (deleted)";
                        $checkName = $this->items_model->check_name(logged('company_id'), $name, 1);
    
                        $attempt++;
                    } while(!is_null($checkName));
    
                    $data = ['is_active' => 0, 'is_archived' => 1, 'modified' => date("Y-m-d H:i:s")];
                    $this->items_model->updateItem($item->id, $data);
    
                    //Activity Logs
                    $activity_name = 'Inventory : Archived item '.$item->title; 
                    createActivityLog($activity_name);
                } 
                
            }

            $is_success = 1;
            $msg = '';
        } 

        $return = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($return);
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

    public function deleteMultiple() 
    {   
        $is_success = 0;
        $msg = 'Please select item(s).';

        $post = $this->input->post();

        if( $post['items'] ){
            foreach($post['items'] as $id) {    
                $item = $this->items_model->getByID($id);
                if( $item ){
                    $attempt = 0;
                    do {
                        $name = $attempt > 0 ? "$item->title (deleted - $attempt)" : "$item->title (deleted)";
                        $checkName = $this->items_model->check_name(logged('company_id'), $name, 1);
    
                        $attempt++;
                    } while(!is_null($checkName));
    
                    $data = ['is_active' => 0, 'is_archived' => 1, 'modified' => date("Y-m-d H:i:s")];
                    $this->items_model->updateItem($item->id, $data);
    
                    //Activity Logs
                    $activity_name = 'Inventory : Archived item '. $item->title; 
                    createActivityLog($activity_name);
                } 
                
            }

            $is_success = 1;
            $msg = '';
        } 

        $return = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($return);
    }

    public function ajax_delete_selected_storage_location() {
        postAllowed();

        $is_success = 0;
        $msg = 'Cannot find data';

        $company_id = logged('company_id');
        $ids        = $this->input->post('storageLocations');
        $deleted    = 0;
        foreach($ids as $id) {
            $storageDelete = $this->items_model->deleteCompanyStorageLocationById($company_id, $id);        
            if( $storageDelete ){
                $deleted++;
            }                
        }

        if( $deleted > 0 ){
            $is_success = 1;
            $msg = '';

			//Activity Logs
			$activity_name = 'Inventory Location : Deleted multiple location successfull';
			createActivityLog($activity_name);            
        }

        $json_data = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($json_data);
    }

    public function deleteMultipleVendor() {
        $is_success = 0;
        $msg = 'Cannot find data';

        $cid = logged('company_id');
        $ids = explode(",",$this->input->post('ids'));   
        $total_deleted = 0;

        foreach($ids as $id) {
            $vendor = $this->Vendor_model->getByIdAndCompanyId($id, $cid);
            if( $vendor ){
                $this->vendor_model->deleteByVendorId($id);
                
                //Activity Logs
                $activity_name = 'Inventory : Created vendor '.$vendor->vendor_name; 
                createActivityLog($activity_name);
                
                $total_deleted++;
            }            
        }

        if( $total_deleted > 0 ){
            $is_success = 1;
            $msg = '';            
        }else{
            $msg = 'Nothing to delete';
        }

        $json_data = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($json_data);
    }

    public function ajax_delete_selected_vendor() {
        $is_success = 0;
        $msg = 'Cannot find data';

        $post = $this->input->post();

        $cid = logged('company_id');
        $ids = explode(",",$this->input->post('ids'));   
        $total_deleted = 0;

        foreach($ids as $id) {
            $vendor = $this->vendor_model->getByIdAndCompanyId($id, $cid);
            if( $vendor ){
                $this->vendor_model->deleteByVendorId($id);
                
                //Activity Logs
                $activity_name = 'Inventory : Deleted Vendor '. $vendor->vendor_name; 
                createActivityLog($activity_name);
                
                $total_deleted++;
            }            
        }

        if( $total_deleted > 0 ){
            $is_success = 1;
            $msg = '';            
        }else{
            $msg = 'Nothing to delete';
        }

        $json_data = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($json_data);        
    }

    public function deleteMultipleItemGroup() 
    {
        $this->load->model('ItemCategory_model');
            
        $is_success = 0;
        $msg = 'Cannot find data';
        $company_id = logged('company_id');

        $total_deleted = 0;
        $ids = explode(",",$this->input->post('ids'));
        foreach($ids as $id) {
            $itemCategory = $this->ItemCategory_model->getById($id);
            if( $itemCategory && $itemCategory->company_id == $company_id ){
                $this->itemcategory_model->deleteByItemCategoryId($id);

                //Activity Logs
                $activity_name = 'Inventory : Deleted item category '.$itemCategory->name; 
                createActivityLog($activity_name);

                $total_deleted++;
            }            
        }

        if( $total_deleted > 0 ){
            $is_success = 1;
            $msg = '';
        }else{
            $msg = 'Nothing to delete';
        }

        $json_data = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($json_data);
    }

    public function addNewLocation(){
        $is_success = 0;
        $msg        = 'Cannot save data';

        postAllowed();

        $post          = $this->input->post();
        $company_id    = logged('company_id');
        $location_name = $this->input->post('name');
        $default       = $this->input->post('DEFAULT_LOCATION');

        if($location_name != null) {

            $isStorageLocationExists = $this->items_model->getLocationByNameAndCompanyId($location_name, $company_id);
            if( !$isStorageLocationExists ){

                if ($DEFAULT == "true") {
                    $this->items_model->clearDefaultLocation();
                    $location_data = array(
                        'company_id'=> $company_id,
                        'location_name' => $location_name,
                        'default' => $default,
                    );
                } else {
                    $location_data = array(
                        'company_id'=> $company_id,
                        'location_name' => $location_name,
                        'default' => "",
                    );
                }

                $result = $this->general->add_($location_data, 'storage_loc'); 
                
                $is_success = 1;
                $msg = '';     

            } else {
                $is_success = 0;
                $msg = 'Storage location <b>' . $location_name . '</b> already exists.';  
            }

        }

        $return = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($return);
        exit;            
    }

    public function ajax_create_location() {
        $is_success = 0;
        $msg        = 'Cannot save data';

        postAllowed();

        $post          = $this->input->post();
        $company_id    = logged('company_id');
        $location_name = $this->input->post('name');
        $default       = $this->input->post('DEFAULT_LOCATION');

        if($location_name != null) {

            $isStorageLocationExists = $this->items_model->getLocationByNameAndCompanyId($location_name, $company_id);
            if( !$isStorageLocationExists ){

                if ($DEFAULT == "true") {
                    $this->items_model->clearDefaultLocation();
                    $location_data = array(
                        'company_id'=> $company_id,
                        'location_name' => $location_name,
                        'default' => $default,
                    );
                } else {
                    $location_data = array(
                        'company_id'=> $company_id,
                        'location_name' => $location_name,
                        'default' => "",
                    );
                }

                $result = $this->general->add_($location_data, 'storage_loc'); 
                
                $is_success = 1;
                $msg = '';     

                //Activity Logs
                $activity_name = 'Inventory Location : Created location ' . $location_name; 
                createActivityLog($activity_name);
		                      
            } else {
                $is_success = 0;
                $msg = 'Storage location <b>' . $location_name . '</b> already exists.';  
            }

        }

        $return = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($return);
        exit;     
    }

    public function addNewItemLocation() {
        $executeOnce = 0;
        postAllowed();

        $user = logged('FName') . ' ' . logged('LName');

        $comp_id  = logged('company_id');
        $location = $this->items_model->getLocationById($this->input->post('loc_id'));
        $data = array(
            'company_id' => $comp_id,
            'initial_qty' => $this->input->post('qty'),
            'qty' => $this->input->post('qty'),
            'loc_id' => $this->input->post('loc_id'),
            'item_id' => $this->input->post('item_id'),
            'location_name' => $location->location_name,
            'insert_date' => date('Y-m-d H:i:s')
        );

        $this->items_model->checkAndSaveItemLocation($this->input->post('item_id'), $this->input->post('loc_id'), $this->input->post('qty'), $data);
        $result = $this->items_model->getLocationByItemId($this->input->post('item_id'));

        if ($executeOnce == 0) {
            $executeOnce = 1;
            $this->items_model->recordItemTransaction($this->input->post('item_id'), $this->input->post('qty'), $this->input->post('loc_id'), "add", $user, "USER");
        }

        $return = ['result' => $result, 'item_id' => $this->input->post('item_id')];
        echo json_encode($return);
    }

    public function editLocation() {

        $is_success = 0;
        $msg        = 'Cannot save data';
        postAllowed();

        $post          = $this->input->post();
        $location_name = $this->input->post('location_name');
        $default_location_name = $this->input->post('default_location_name');
        $default       = $this->input->post('DEFAULT_LOCATION');
        $id            = $this->input->post('loc_id');
        $company_id    = logged('company_id');

        if($location_name != null) {

            if( $post['location_name'] == $post['default_location_name'] ) {
                $isStorageLocationExists = false;
            } else {
                $isStorageLocationExists = $this->items_model->getLocationByNameAndCompanyId($location_name, $company_id);
            }
            
            if( !$isStorageLocationExists ){

                if ($default == "true") {
                    $this->items_model->clearDefaultLocation();
                    $location_data = array(
                        'location_name' => $location_name,
                        'default' => $default,
                    );
                } else {
                    $location_data = array(
                        'location_name' => $location_name,
                        'default' => "",
                    );
                }

                $this->general->update_with_key_field($location_data, $id, 'storage_loc', 'loc_id');        
                
                $is_success = 1;
                $msg = '';
                
            } else {
                $is_success = 0;
                $msg = 'Storage location <b>' . $location_name . '</b> already exists.';  
            }

        }

        $return = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($return);
        exit;  
    }

    public function ajax_update_location() {
        $is_success = 0;
        $msg        = 'Cannot save data';

        postAllowed();

        $post          = $this->input->post();
        $location_name = $this->input->post('name');
        $default_location_name = $this->input->post('default_name');
        $is_default       = $this->input->post('default_location');
        $id            = $this->input->post('lid');
        $company_id    = logged('company_id');

        if($location_name != null) {

            if( $post['name'] == $post['default_name'] ) {
                $isStorageLocationExists = false;
            } else {
                $isStorageLocationExists = $this->items_model->getLocationByNameAndCompanyId($location_name, $company_id);
            }
            
            if( !$isStorageLocationExists ){

                if (isset($is_default) && $is_default == 1) {
                    $this->items_model->clearDefaultLocation();
                    $location_data = array(
                        'location_name' => $location_name,
                        'default' => 'true',
                    );
                } else {
                    $location_data = array(
                        'location_name' => $location_name,
                        'default' => "",
                    );
                }

                $this->general->update_with_key_field($location_data, $id, 'storage_loc', 'loc_id');        
                
                $is_success = 1;
                $msg = 'Storage location has been upated successfully.';

                //Activity Logs
                $activity_name = 'Inventory Location : Update location ' . $location_name; 
                createActivityLog($activity_name);                
                
            } else {
                $is_success = 0;
                $msg = 'Storage location <b>' . $location_name . '</b> already exists.';  
            }

        }        

        $return = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($return);
        exit;            
    } 

    public function getItemLocations() {
        postAllowed();
        $result = $this->items_model->getLocationByItemId($this->input->post('item_id'));
        echo json_encode($result);
    }

    public function inventory_export()
    {
        $cid   = logged('company_id');
        $filters[] = ['field' => 'is_active', 'value' => 1]; 
        $items = $this->items_model->getByCompanyId($cid, $filters);    

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
                    number_format((float)$i->price,2),
                    number_format((float)$i->retail,2),
                    number_format((float)$i->rebate, 2),
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
        if(!checkRoleCanAccessModule('inventory', 'write')){
            show403Error();
            return false;
        }

        $this->page_data['page']->title = 'Vendors';
        $this->page_data['page']->parent = 'Tools';
        $this->load->view('v2/pages/inventory/action/vendors_add', $this->page_data);
    }

    public function ajax_create_vendor()
    {
        $this->load->model('Vendor_model');

        $is_success = 0;
        $msg = 'Cannot save data';

        $post = $this->input->post();
        $company_id = logged('company_id');

        $isExists = $this->Vendor_model->getByVendorName($post['vendor_name']);
        if( $isExists && $isExists->company_id == $company_id ){
            $msg = 'Vendor name ' . $post['vendor_name'] . ' already exists';
        }else{
            $data = [
                'company_id' => $company_id,
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

            //Activity Logs
            $activity_name = 'Inventory : Created vendor '.$input['vendor_name']; 
            createActivityLog($activity_name);

            $is_success = 1;
            $msg = '';
        }        

        $json_data = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($json_data);

    }

    public function edit_vendor( $id )
    {
        $this->load->model('Vendor_model');

        if(!checkRoleCanAccessModule('inventory', 'write')){
            show403Error();
            return false;
        }
        
        $this->page_data['page']->title = 'Vendors';
        $this->page_data['page']->parent = 'Tools';

        $cid  = logged('company_id');
        $vendor = $this->Vendor_model->getByIdAndCompanyId($id, $cid);
        if( $vendor ){
            $this->page_data['vendor'] = $vendor;
            $this->load->view('v2/pages/inventory/action/vendors_edit', $this->page_data);
        }else{
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
        $msg = 'Cannot find data';

        $post = $this->input->post();
        $cid  = logged('company_id');
        
        $isExists = $this->Vendor_model->getByVendorNameAndCompanyId($post['vendor_name'], $cid);
        if( $isExists && $isExists->id != $post['vid'] ){
            $msg = 'Vendor name ' . $post['vendor_name'] . ' already exists';
        }else{
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
                
                //Activity Logs
                $activity_name = 'Inventory : Updated vendor '.$vendor->vendor_name; 
                createActivityLog($activity_name);

                $is_success = 1;
                $msg = '';
            }
        }

        $json_data = ['is_success' => $is_success, 'msg' => $msg];

        echo json_encode($json_data);

    }

    public function ajax_update_item_category()
    {
        $this->load->model('ItemCategory_model');

        $is_success = 0;
        $msg = 'Cannot find data';

        $post = $this->input->post();
        $cid  = logged('company_id');

        if($post['default_category_name'] == $post['category_name']) {
            $isExists = false;
        } else {
            $isExists = $this->ItemCategory_model->getByNameAndCompanyId($post['category_name'], $cid);
        }

        if( $isExists && $isExists->id != $post['icid'] ){
            $msg = 'Category name ' . $post['category_name'] . ' already exists';
        }else{
            $itemCategory = $this->ItemCategory_model->getById($post['icid']);
            if( $itemCategory && $itemCategory->company_id == $cid ){
                $data = [
                    'name' => $post['category_name'],
                    'description' => $post['category_description']
                ];
    
                $this->ItemCategory_model->updateItemCategory($post['icid'],$data);

                //Activity Logs
                $activity_name = 'Inventory : Updated item category '.$itemCategory->name; 
                createActivityLog($activity_name);
    
                $is_success = 1;
                $msg = '';
            }
        }
        

        $json_data = ['is_success' => $is_success, 'msg' => $msg];
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
        $msg = 'Cannot find data';

        $post = $this->input->post();
        $cid  = logged('company_id');

        $itemCategory = $this->ItemCategory_model->getByIdAndCompanyId($post['id'], $cid);
        if( $itemCategory ){
            $this->ItemCategory_model->deleteByItemCategoryId($post['id']);

            //Activity Logs
            $activity_name = 'Inventory : Deleted item category '.$itemCategory->name; 
            createActivityLog($activity_name);

            $is_success = 1;
            $msg = '';
        }

        $json_data = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($json_data);
    }

    public function settings()  
    {
        $this->page_data['page']->title = 'Inventory Settings';
		$this->page_data['page']->parent = 'Tools';        
        $this->page_data['inventoryCustomFields'] = $inventoryCustomFields = $this->items_model->get_custom_fields_by_company_id(logged('company_id'));

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

        echo json_encode(['item_id' => $input['item_id'], "message" => "success"]);

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

    public function ajax_create_custom_field()
    {
        $is_success = 0;
        $msg = 'Cannot save data';

        $company_id = logged('company_id');
        $post       = $this->input->post();

        if( $post['custom_field_name'] != '' ){

            $isCustomFieldExists = $this->items_model->getCustomFieldByNameAndCompanyId($post['custom_field_name'], $company_id);
            if( !$isCustomFieldExists ){

                $data = [
                    'name' => $post['custom_field_name'],
                    'company_id' => $company_id
                ];
        
                $customFieldId = $this->items_model->add_custom_field($data);
                
                $is_success = 1;
                $msg = '';         
                
                //Activity Logs
                $activity_name = 'Inventory Settings : Created settings ' . $post['custom_field_name'];
                createActivityLog($activity_name);                

            } else {

                $is_success = 0;
                $msg = 'Custom Field Name <b>' . $post['custom_field_name'] . '</b> already exists.';  

            }            
        }

        $return = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($return);
        exit;    
    }

    public function ajax_update_custom_field()
    {
        $is_success = 0;
        $msg = 'Cannot save data';

        $company_id = logged('company_id');
        $post       = $this->input->post();

        if( $post['custom_field_name'] != '' ){

            if( $post['custom_field_name'] == $post['default_custom_field_name'] ) {
                $isCustomFieldExists = false;
            } else {
                $isCustomFieldExists = $this->items_model->getCustomFieldByNameAndCompanyId($post['custom_field_name'], $company_id);
            }

            if( !$isCustomFieldExists ){
                $customField = $this->items_model->get_custom_field_by_id($post['cfid']);
                if( $customField ){
                    $data = ['name' => $post['custom_field_name']];
                    $this->items_model->update_custom_field_name($post['cfid'], $data);
                    
                    $is_success = 1;
                    $msg = '';

                    //Activity Logs
                    $activity_name = 'Inventory Settings : Update setting ' . $post['custom_field_name'];
                    createActivityLog($activity_name);                          
                }else{
                    $msg = 'Cannot find data';
                }                    
            } else {
                $is_success = 0;
                $msg = 'Custom Field Name <b>' . $post['custom_field_name'] . '</b> already exists.';                      
            }            
            
        }else{
            $msg = 'Please specify custom field name';
        }

        $return = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($return);
        exit;    
    }

    public function ajax_delete_custom_field()
    {
        $is_success = 0;
        $msg = 'Cannot find data';

        $company_id = logged('company_id');
        $post       = $this->input->post();

        if( $post['cfid'] != '' ){
            $customField = $this->items_model->get_custom_field_by_id($post['cfid']);
            if( $customField ){                
                $this->items_model->delete_custom_field_by_id($post['cfid']);
                
                $is_success = 1;
                $msg = '';

                //Activity Logs
                $activity_name = 'Inventory Settings : Deleted ' . $customField->name;
                createActivityLog($activity_name);     
            }else{
                $msg = 'Cannot find data';
            }
        }else{
            $msg = 'Please specify custom field name';
        }

        $return = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($return);
        exit;    
    }

    public function ajax_delete_selected_custom_field()
    {
        $is_success = 0;
        $msg = 'Please select item(s).';

        $post = $this->input->post();
        if( $post['items'] ){
            $count_del = 0;
            foreach($post['items'] as $id) {    
                
                $item    = $this->items_model->get_custom_field_by_id($id);
                if( $item ){
                    $this->items_model->delete_custom_field_by_id($id);
                    $count_del++;
                } 
            }

            if($count_del) {
                $is_success = 1;
                $msg = '';

                //Activity Logs
                $activity_name = 'Inventory Settings : Deleted multiple custom field';
                createActivityLog($activity_name); 
            } 
        } 

        $return = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($return);
    }    

    public function ajax_vendor_send_email(){
        $is_success = 1;
        $msg = 'Cannot send email';

        $post = $this->input->post();
        if( $post['vendor_email_subject'] == '' ){
            $msg = 'Please enter email subject';
            $is_success = 0;
        }

        if( $post['vendor_email'] == '' ){
            $msg = 'Please enter vendor email';
            $is_success = 0;
        }

        if( $post['vendor_email_message'] == '' ){
            $msg = 'Please enter email message';
            $is_success = 0;
        }       
        
        if( $is_success == 1 ){
            //Send Email
            $mail = email__getInstance();
            $mail->FromName = 'nSmarTrac';
            $mail->addAddress($post['vendor_email'], $post['vendor_email']);
            $mail->isHTML(true);
            $mail->Subject = $post['vendor_email_subject'];
            $mail->Body    = $post['vendor_email_message'];
            $sendEmail = $mail->Send();
            
            $is_success = 1;
            $msg = '';
        }

        $return = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($return);
        exit;
    }

    public function vendor_export()
    {
        $cid   = logged('company_id');

        $get_vendors = array(
            'where' => array('company_id' => $cid),
            'table' => 'vendor',
            'select' => '*',
        );
        $vendors = $this->general->get_data_with_param($get_vendors);

        $delimiter = ",";
        $time      = time();
        $filename  = "vendor_list_".$time.".csv";

        $f = fopen('php://memory', 'w');

        $fields = array('Vendor Name', 'Email', 'Website', 'Mobile Number', 'Phone Number', 'City', 'State', 'Postal Code', 'Address', 'Suite / Unit');
        fputcsv($f, $fields, $delimiter);

        if (!empty($vendors)) {
            foreach ($vendors as $v) {
                $csvData = array(
                    $v->vendor_name,
                    $v->email,
                    $v->business_URL,
                    formatPhoneNumber($v->mobile),
                    formatPhoneNumber($v->phone),
                    $v->city,
                    $v->state,
                    $v->postal_code,
                    $v->street_address,
                    $v->suite_unit
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

    public function ajax_item_location_list()
    {
        $post = $this->input->post();
        $itemLocations = $this->items_model->getLocationByItemId($post['item_id']);

        $this->page_data['itemLocations'] = $itemLocations;
        $this->load->view('v2/pages/inventory/ajax_item_location_list', $this->page_data);
    }

    public function ajax_create_inventory_fee()
    {
        $is_success = 0;
        $msg   = 'Cannot create data';

        $input      = $this->input->post();
        $company_id = logged('company_id');

        $isItemExists = $this->items_model->getItemByTitleAndCompanyId($input['title'], $company_id);
        if( !$isItemExists ){
            $data = array(
                'company_id' => $company_id,
                'title' => $input['title'],            
                'price' => $input['price'],
                'estimated_time' => 0,
                'frequency' => $input['frequency'],
                'vendor_id' => 0,
                'type' => 'Fees',            
                'description' => $input['description'],
                'is_active' => 1,
            );
            
            $this->items_model->insert($data);
            
            //Activity Logs
            $activity_name = 'Inventory : Created inventory fee '.$input['title']; 
            createActivityLog($activity_name);

            $is_success = 1;
            $msg = '';

        }else{
            $msg = 'Inventory fee '. $input['title'] .' already exists.';
        }
        
        $json_data = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($json_data);
    }

    public function ajax_edit_inventory_fee()
    {   
        $post = $this->input->post();
        $company_id = logged('company_id');

        $item = $this->items_model->getCompanyItemById($company_id, $post['id']);

        $this->page_data['page']->title = 'Fees';
        $this->page_data['page']->parent = 'Tools';
        $this->page_data['item'] = $item;
        $this->load->view('v2/pages/inventory/action/ajax_edit_inventory_fee', $this->page_data);
    }

    public function ajax_update_inventory_fee()
    {
        $is_success = 0;
        $msg   = 'Cannot find data';
 
        $post       = $this->input->post();
        $company_id = logged('company_id');
        $item = $this->items_model->getCompanyItemById($company_id, $post['fid']);
        if( $item ){
            $isItemExists = $this->items_model->getItemByTitleAndCompanyId($post['title'], $company_id);
            if( $isItemExists && $isItemExists->id != $post['fid'] ){
                $msg = 'Inventory fee '. $post['title'] .' already exists.';
            }else{
                $data = [
                    'title' => $post['title'],
                    'description' => $post['description'],
                    'price' => $post['price'],
                    'frequency' => $post['frequency']
                ];
                
                $this->items_model->updateItem($item->id, $data);
                
                //Activity Logs
                $activity_name = 'Inventory : Updated inventory fee '.$post['title']; 
                createActivityLog($activity_name);

                $is_success = 1;
                $msg = '';
            }
        }
        
        $json_data = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($json_data);
    }

    public function ajax_edit_item_category()
    {
        $post = $this->input->post();
        $company_id = logged('company_id');

        $itemCategory = $this->itemcategory_model->getById($post['id']);
        if( $itemCategory && $itemCategory->company_id == $company_id ){
            $this->page_data['itemCategory'] = $itemCategory;
            $this->load->view('v2/pages/inventory/action/ajax_edit_item_category', $this->page_data);
        }else{
            echo 'Data not found.';
        }
    }

    public function ajax_archived_list()
    {
        $post = $this->input->post();
        $company_id  = logged('company_id');
        $is_archived = 1;

        $conditions  = array('company_id'=> $company_id, 'type' => 'product', 'is_archived' => $is_archived); 
        $items = $this->items_model->getByWhere($conditions);            

        $this->page_data['items'] = $items;
        $this->load->view("v2/pages/inventory/ajax_archived_list", $this->page_data);
    }      
    
    public function ajax_restore_archived()
    {
        $is_success = 0;
        $msg = 'Cannot find item data';

        $company_id = logged('company_id');
        $post       = $this->input->post();

        $item = $this->items_model->getItemById($post['item_id'])[0];
        if ($item) {        
                        
            $updateData = ['is_active' => 1, 'is_archived' => 0, 'modified' => date("Y-m-d H:i:s")];
            $this->items_model->updateItem($item->id, $updateData);

            //Activity Logs
            $activity_name = 'Archived : Restore item data  ' . $item->title; 
            createActivityLog($activity_name);

            $is_success = 1;
            $msg = '';
        }

        $return = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($return);
    }   

    public function ajax_restore_selected_items()
    {
        $is_success = 0;
        $msg    = 'Please select data';

        $company_id  = logged('company_id');
        $post        = $this->input->post();     
        
        if( $post['archived_items'] ){
            $restore_count = 0;
            foreach($post['archived_items'] as $item_id) {
                $item = $this->items_model->getItemById($item_id)[0];
                if ($item && $item->company_id == $company_id) {

                    $updateData = ['is_active' => 1, 'is_archived' => 0, 'modified' => date("Y-m-d H:i:s")];
                    $this->items_model->updateItem($item->id, $updateData);

                    //Activity Logs
                    $activity_name = 'Archived : Restore invoice data  ' . $item->title; 
                    createActivityLog($activity_name);   
                                     
                    $restore_count++;
                }
            }

            if($restore_count) {
                $is_success = 1;
                $msg    = '';
            }
        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
    }    
    
    public function ajax_permanent_delete()
    {
        $is_success = 0;
        $msg = 'Cannot find item data';

        $company_id = logged('company_id');
        $post       = $this->input->post();

        $item = $this->items_model->getItemById($post['item_id'])[0];
        if ($item) {                        
            $this->items_model->deleteItem($post['item_id']);

            //Activity Logs
            $activity_name = 'Archived : Permanent item invoice data ' . $item->title; 
            createActivityLog($activity_name);

            $is_success = 1;
            $msg = '';
        }

        $return = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($return);
    }   
    
    public function ajax_delete_permanent_selected_items()
    {
        $is_success = 0;
        $msg    = 'Please select data';

        $company_id  = logged('company_id');
        $post        = $this->input->post();  
                
        if( $post['archived_items'] ){
            $delete_count = 0;
            foreach($post['archived_items'] as $item_id) {
                $item = $this->items_model->getItemById($item_id)[0];
                if ($item && $item->company_id == $company_id) {
                    $item_delete = $this->items_model->deleteItem($item_id);
                    if($item_delete) {
                        //Activity Logs
                        $activity_name = 'Archived : Permanent delete item data ' . $invoice->invoice_number; 
                        createActivityLog($activity_name);  
                        $delete_count++;
                    }
                }
            }

            if($delete_count) {
                $is_success = 1;
                $msg    = '';
            }
        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
    }    
    
	public function ajax_delete_all_archived_items()
	{
		$is_success = 0;
        $msg        = 'Please select data';

        $company_id  = logged('company_id');
        $post        = $this->input->post();	
        $type        = 'Product';

        $items   = $this->items_model->getArchivedItems($company_id, $type);
		$total_archived = count($items);    

        
        if($total_archived > 0) {

            $filter[] = ['field' => 'company_id', 'value' => $company_id];
            $filter[] = ['field' => 'is_archived', 'value' => '1'];
            $filter[] = ['field' => 'type', 'value' => $type];

            $delete_all = $this->items_model->deleteAllArchived($filter);

            //Activity Logs
            $activity_name = 'Users : Permanently deleted ' .$total_archived. ' invoice(s)'; 
            createActivityLog($activity_name);

            $is_success = 1;
            $msg    = '';
        }
        
        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
	}      

}
/* End of file items.php */

/* Location: ./application/controllers/items.php */
