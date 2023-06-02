<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Items_model extends MY_Model
{
    public $table = 'items';
    public $table_categories = 'item_categories';
    public $table_invoice = 'invoice_has_items';
    public $table_has_location = 'items_has_storage_loc';
    public $table_offer_code = 'offer_code';
    public $table_custom_fields = 'inventory_custom_fields';
    public $table_custom_fields_value = 'inventory_custom_fields_value';

    public function __construct()
    {
        parent::__construct();
    }

    public function getItemCategories($order = "asc")
    {
        $this->db->where('company_id', getLoggedCompanyID());
        $this->db->order_by('name', $order);
        $query = $this->db->get($this->table_categories);
        return $query->result();
    }

    public function getLocationList()
    {
        // $this->db->where('company_id', getLoggedCompanyID());
        // // $this->db->order_by('name', $order);
        // $query = $this->db->get($this->table);
        // return $query->result();
        $company_id = logged('company_id');
        $this->db->select('*');
        $this->db->from('storage_loc');
        $this->db->where('company_id', $company_id);
        $query = $this->db->get();
        return $query->result();
    }

    public function getItemlist()
    {
        // $this->db->where('company_id', getLoggedCompanyID());
        // // $this->db->order_by('name', $order);
        // $query = $this->db->get($this->table);
        // return $query->result();
        $company_id = logged('company_id');
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $company_id);
        $query = $this->db->get();
        return $query->result();
    }

    
    public function getUserByID($id)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function categoriesWithoutParent()
    {
        $companyId = logged('company_id');
        $this->db->where('company_id', $companyId);
        $this->db->where('parent_id', null);
        $this->db->or_where('parent_id', 0);
        $this->db->where('company_id', $companyId);
        $this->db->or_where('parent_id', '');
        $this->db->where('company_id', $companyId);
        $query = $this->db->get($this->table_categories);

        return $query->result();
    }

    public function get_child_categories($categoryId)
    {
        $companyId = logged('company_id');
        $this->db->where('company_id', $companyId);
        $this->db->where('parent_id', $categoryId);
        $query = $this->db->get($this->table_categories);

        return $query->result();
    }

    public function insertCategory($data)
    {
        $insert = $this->db->insert($this->table_categories, $data);
        return $this->db->insert_id();
    }
    
    public function getCategory($id)
    {
        return $this->db->where(['company_id' => getLoggedCompanyID(), 'item_categories_id' => $id])->get($this->table_categories)->row();
    }

    public function updateCategory($id, $data)
    {
        $this->db->where('company_id', getLoggedCompanyID());
        $this->db->where('item_categories_id', $id);
        $update = $this->db->update($this->table_categories, $data);
        return $update ? true : false;
    }

    public function deleteCategory($id)
    {
        $this->db->where('company_id', getLoggedCompanyID());
        $this->db->where('item_categories_id', $id);
        $delete = $this->db->delete($this->table_categories);
        return $delete ? true : false;
    }

    public function filterBy($filters = array(), $company_id, $type)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        if ($company_id > 0) {
            $this->db->where('company_id', $company_id);
        }
        
        $this->db->where('type', $type);

        if (!empty($filters)) {
            if (isset($filters['category'])) {
                $this->db->group_start();
                $this->db->where('item_categories_id', $filters['category']);
                $this->db->group_end();
            }
        }

        $query = $this->db->get();
        return $query->result();
    }

   public function getByCompanyId($company_id, $filters = [])
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $company_id);
        if( $filters ){
            $count = 1;
            foreach( $filters as $value ){
                if( $count == 1 ){
                    $this->db->where($value['field'], $value['value']);
                }else{
                    $this->db->or_where($value['field'], $value['value']);
                }
                $count++;
            }
        }

        $query = $this->db->get();
        return $query->result();
    }

    public function getItemsWithFilter($filters = [], $columnName = 'title', $order = 'asc')
    {
        $this->db->where('company_id', getLoggedCompanyID());
        $this->db->where_in('is_active', $filters['status']);
        if (isset($filters['category'])) {
            $this->db->where_in('item_categories_id', $filters['category']);
        }
        if (isset($filters['type'])) {
            $this->db->where_in('type', $filters['type']);
        }
        $this->db->order_by($columnName, $order);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function inactiveItem($data)
    {
        $this->db->where('company_id', $data['company_id']);
        $this->db->where('id', $data['id']);
        $inactive = $this->db->update($this->table, ['is_active' => 0, 'title' => $data['name']]);
        return $inactive ? true : false;
    }

    public function inactivePackage($data)
    {
        $this->db->where('company_id', $data['company_id']);
        $this->db->where('id', $data['id']);
        $inactive = $this->db->update('package_details', ['status' => 0, 'name' => $data['name']]);
        return $inactive ? true : false;
    }

    public function activeItem($data)
    {
        $this->db->where('company_id', $data['company_id']);
        $this->db->where('id', $data['id']);
        $inactive = $this->db->update($this->table, ['is_active' => 1, 'title' => $data['name']]);
        return $inactive ? true : false;
    }

    public function activePackage($data)
    {
        $this->db->where('company_id', $data['company_id']);
        $this->db->where('id', $data['id']);
        $inactive = $this->db->update('package_details', ['status' => 1, 'name' => $data['name']]);
        return $inactive ? true : false;
    }

    public function addBundleItems($data)
    {
        $this->db->insert_batch('bundle_item_contents', $data);
        return $this->db->insert_id();
    }

    public function updateBundleItem($data, $id)
    {
        $this->db->where('company_id', getLoggedCompanyID());
        $this->db->where('id', $id);
        $update = $this->db->update('bundle_item_contents', $data);
        return $update ? true : false;
    }

    public function getByName($name)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('title', $name);
        $query = $this->db->get();
        return $query->result();
    }

    public function getByID($id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function getRows($params = array())
    {
        $this->db->select('*');
        $this->db->from($this->table);
        
        if (array_key_exists("where", $params)) {
            foreach ($params['where'] as $key => $val) {
                $this->db->where($key, $val);
            }
        }
        
        if (array_key_exists("returnType", $params) && $params['returnType'] == 'count') {
            $result = $this->db->count_all_results();
        } else {
            if (array_key_exists("id", $params)) {
                $this->db->where('id', $params['id']);
                $query = $this->db->get();
                $result = $query->row_array();
            } else {
                $this->db->order_by('id', 'desc');
                if (array_key_exists("start", $params) && array_key_exists("limit", $params)) {
                    $this->db->limit($params['limit'], $params['start']);
                } elseif (!array_key_exists("start", $params) && array_key_exists("limit", $params)) {
                    $this->db->limit($params['limit']);
                }
                
                $query = $this->db->get();
                $result = ($query->num_rows() > 0)?$query->result_array():false;
            }
        }
        
        // Return fetched data
        return $result;
    }

    public function insert($data = array())
    {
        if (!empty($data)) {
            $insert = $this->db->insert($this->table, $data);
            return $insert?$this->db->insert_id():false;
        }
        return false;
    }

    public function update($data, $condition = array())
    {
        if (!empty($data)) {
            // Add modified date if not included
            if (!array_key_exists("modified", $data)) {
                $data['modified'] = date("Y-m-d H:i:s");
            }
            
            // Update member data
            $update = $this->db->update($this->table, $data, $condition);
            
            // Return the status
            return $update?true:false;
        }
        return false;
    }

    public function updateLocationDetails($data, $condition = array())
    {
        if (!empty($data)) {
            $update = $this->db->update($this->table_has_location, $data, $condition);

            return $update ? true : false;
        }
        return false;
    }

    public function updateMultipleItem($data)
    {
        $update = $this->db->update_batch($this->table, $data, 'id');

        return $update;
    }

    public function getItemById($id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * @return mixed
     */
    public function delete($id)
    {
        $this->db->delete($this->table, array("id" => $id));
    }

    public function deleteCompanyItem($id, $company_id)
    {
        $this->db->delete($this->table, array("id" => $id, 'company_id' => $company_id));
    }

    public function getLocationByItemId($id)
    {
        $COMPANY_ID = logged('company_id');
        $role_id = intval(logged('role'));
        $this->db->select('*');
        $this->db->from($this->table_has_location);
        $this->db->where('item_id', $id);
        if( $role_id !== 1 && $role_id !== 2 ){
            $this->db->where('company_id', $COMPANY_ID);
        }
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getLocationByCompanyId()
    {
        $COMPANY_ID = logged('company_id');
        $role_id = intval(logged('role'));
        $this->db->select('*');
        $this->db->from($this->table_has_location);
        if( $role_id !== 1 && $role_id !== 2 ){
            $this->db->where('company_id', $COMPANY_ID);
        }
        $query = $this->db->get();
        return $query->result_array();
    }
    public function _updateLocationQty($params){
        $is_valid = 0;
        if(array_key_exists("set", $params)){
            foreach($params['set'] as $key => $val){
                if ($key === 'qty' && is_numeric($val)) {
                    $this->db->set($key, $key.' - '.$val, false);
                    $is_valid = 1;
                }
            }
        }

        if(array_key_exists("where", $params)){
            foreach($params['where'] as $key => $val){
                if( $val != '' ){
                    $this->db->where($key, $val);    
                }else{
                    if( $val == 0 ){
                        $this->db->where($key, $val);  
                    }else{
                        $this->db->where($key); 
                    }
                }
                
            }
        }

        if( $is_valid == 1 ){
            $this->db->update($this->table_has_location);
        }        
    }
    public function getLocationById($id)
    {
        $this->db->select('*');
        $this->db->from('storage_loc');
        $this->db->where('loc_id', $id);

        $query = $this->db->get();
        return $query->row();
    }

    public function getBundleContents($id)
    {
        $this->db->where('company_id', logged('company_id'));
        $this->db->where('item_id', $id);
        $query = $this->db->get('bundle_item_contents');
        return $query->result();
    }

    public function deletePackageItems($packageId)
    {
        $this->db->where('package_id', $packageId);
        $delete = $this->db->delete('item_package');
        return $delete ? true : false;
    }

    public function saveNewItemLocation($data = array())
    {
        if (!empty($data)) {
            $insert = $this->db->insert($this->table_has_location, $data);
            return $insert?$this->db->insert_id():false;
        }
        return false;
    }

    public function checkAndSaveItemLocation($item_id, $loc_id, $qty,  $data = array()) {
        $this->db->select('items_has_storage_loc.loc_id, items_has_storage_loc.name, items_has_storage_loc.qty');
        $this->db->from('items_has_storage_loc');
        $this->db->where('items_has_storage_loc.item_id', $item_id);
        $this->db->where('items_has_storage_loc.loc_id', $loc_id);
        $this->db->limit(1);
        $query = $this->db->get();
        $result = $query->result();
        // =====
        if (count($result) == 0) {
            $this->db->select('loc_id, location_name');
            $this->db->from('storage_loc'); 
            $this->db->where('loc_id', $loc_id);
            $query = $this->db->get();
            $data['name'] = $query->result()[0]->location_name;
            $insertNewLocation = $this->db->insert($this->table_has_location, $data);
        } else {
            $updateItem = $this->db->update('items_has_storage_loc', 
                ['qty' => $query->result()[0]->qty + $qty], array(
                    'item_id' => $item_id,
                    'loc_id' => $loc_id,
                )
            );
        }
        // =====
    }

    public function saveBatchItemLocation($data = [])
    {
        if (!empty($data)) {
            $insert = $this->db->insert_batch($this->table_has_location, $data);
            return $this->db->insert_id();
        }
        return false;
    }

    public function updateBatchLocations($data)
    {
        $update = $this->db->update_batch($this->table_has_location, $data, 'id');

        return $update;
    }

    public function getItemQuantityAdjustments($item_id, $location_id)
    {
        $this->db->select('accounting_inventory_qty_adjustment_items.*');
        $this->db->from('accounting_inventory_qty_adjustment_items');
        $this->db->where('accounting_inventory_qty_adjustment_items.product_id', $item_id);
        $this->db->where('accounting_inventory_qty_adjustment_items.location_id', $location_id);
        $this->db->where('accounting_inventory_qty_adjustments.status !=', 0);
        $this->db->join('accounting_inventory_qty_adjustments', 'accounting_inventory_qty_adjustments.id = accounting_inventory_qty_adjustment_items.adjustment_id');
        $query = $this->db->get();

        return $query->result();
    }

    public function saveItemAccountingDetails($data = [])
    {
        if (!empty($data)) {
            $insert = $this->db->insert('items_accounting_details', $data);
            return $this->db->insert_id();
        }
        return false;
    }

    public function updateItemAccountingDetails($data, $item_id)
    {
        $this->db->where('item_id', $item_id);
        $update = $this->db->update('items_accounting_details', $data);
        return $update ? true : false;
    }

    public function getItemAccountingDetails($item_id)
    {
        $this->db->where('item_id', $item_id);
        $query = $this->db->get('items_accounting_details');
        return $query->row();
    }

    public function getPackageAccountingDetails($packageId)
    {
        $this->db->where('package_id', $packageId);
        $query = $this->db->get('items_accounting_details');
        return $query->row();
    }

    public function countQty($item_id)
    {
        $items = $this->getLocationByItemId($item_id);
        $qty = 0;
        for ($i=0;$i<count($items);$i++) {
            $qty += intval($items[$i]['qty']);
        }

        return $qty;
    }
    
    public function getoffercode($offer_code)
    {
        $this->db->select('*');
        $this->db->from($this->table_offer_code);
        $this->db->where('offer_code', $offer_code);

        $query = $this->db->get();
        return $query->row();
    }

    public function changeRebate($data)
    {
        extract($data);
        if ($get_val == '1') {
            $item_val = '0';
        } else {
            $item_val = '1';
        }
        $this->db->where('id', $id);
        $this->db->update('items', array('rebate' => $item_val));
        return true;
    }

    public function getItemData($id)
    {
        $where = array(
            'type' => 'Work Order',
            'type_id'   => $id
          );

        $this->db->select('*');
        $this->db->from('item_details');
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result();
    }

    public function getItemDataAlarm($id)
    {
        $where = array(
            // 'type' => 'Work Order Alarm',
            'work_orders_items.work_order_id'   => $id
          );

        $this->db->select('*, work_orders_items.total AS iTotal, work_orders_items.cost AS iCost, work_orders_items.tax AS itax');
        $this->db->from('work_orders_items');
        $this->db->join('items', 'items.id = work_orders_items.items_id');
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result();
    }

    public function getItemLocation($locationId, $itemId)
    {
        $this->db->where('item_id', $itemId);
        $this->db->where('id', $locationId);
        $query = $this->db->get($this->table_has_location);
        return $query->row();
    }
    public function deleteLocation($id, $storage= FALSE)
    {
        if($storage){
            $this->db->where('loc_id', $id);
            $delete = $this->db->delete('storage_loc');
        }else{
            $this->db->where('id', $id);
            $delete = $this->db->delete($this->table_has_location);
        }
        return $delete ? true : false;
    }
    
    public function updateLocationQty($locationId, $itemId, $newQty)
    {
        $this->db->where('item_id', $itemId);
        $this->db->where('id', $locationId);
        return $this->db->update($this->table_has_location, ["qty" => $newQty]);
    }

    public function updateLocation($id, $data, $table)
    {
        $this->db->where('id', $id);
        return $this->db->update($table);
    }

    public function getCompanyItemById($company_id, $item_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id', $item_id);
        $this->db->where('company_id', $company_id);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_items_by_category($categoryId)
    {
        $this->db->where('item_categories_id', $categoryId);
        $this->db->where('is_active', 1);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function get_package_items($packageId)
    {
        $this->db->where('package_id', $packageId);
        $query = $this->db->get('item_package');
        return $query->result();
    }

    public function get_package_by_id($packageId)
    {
        $this->db->where('id', $packageId);
        $query = $this->db->get('package_details');
        return $query->row();
    }

    public function get_first_location($itemId)
    {
        $this->db->where('item_id', $itemId);
        $query = $this->db->get('items_has_storage_loc');
        return $query->row();
    }

    public function update_package($id, $data)
    {
        $this->db->where('id', $id);
        $update = $this->db->update('package_details', $data);
        return $update;
    }

    public function get_company_packages($companyId, $filters = [])
    {
        $this->db->where('company_id', $companyId);
        $this->db->where_in('status', $filters['status']);
        $query = $this->db->get('package_details');
        return $query->result();
    }

    public function check_name($companyId, $itemName, $status)
    {
        $this->db->where('company_id', $companyId);
        $this->db->where('title', $itemName);
        $this->db->where('is_active', $status);
        $query = $this->db->get($this->table);
        return $query->row();
    }

    public function check_package_name($companyId, $packageName, $status)
    {
        $this->db->where('company_id', $companyId);
        $this->db->where('name', $packageName);
        $this->db->where('status', $status);
        $query = $this->db->get('package_details');
        return $query->row();
    }

    public function remove_item_categories($categoryId)
    {
        $this->db->where('item_categories_id', $categoryId);
        $update = $this->db->update($this->table, ['item_categories_id' => 0]);
        return $update;
    }

    public function get_custom_fields_by_company_id($companyId)
    {
        $this->db->where('company_id', $companyId);
        $query = $this->db->get($this->table_custom_fields);
        return $query->result();
    }

    public function add_custom_field($data)
    {
        $this->db->insert($this->table_custom_fields, $data);
        return $this->db->insert_id();
    }

    public function update_custom_field_name($id, $data)
    {
        $this->db->where('id', $id);
        $update = $this->db->update($this->table_custom_fields, $data);
        return $update;
    }

    public function insert_custom_fields_value($fieldsValue)
    {
        $this->db->insert_batch($this->table_custom_fields_value, $fieldsValue);
        return $this->db->insert_id();
    }

    public function getAllItemWithLocation()
    {
        $company_id = logged('company_id');
        $this->db->select('items.id, items.title, items.price, items.type, items_has_storage_loc.name AS location_name, items_has_storage_loc.loc_id AS location_id');
        $this->db->from('items');
        $this->db->where('items.company_id', $company_id);
        $this->db->join('items_has_storage_loc', 'items_has_storage_loc.id = items.id', 'left');
        $query = $this->db->get();
        return $query->result();
    }

    public function getAllLocation() {
        $this->db->select('*');
        $this->db->from('storage_loc');
        $query = $this->db->get();
        return $query->result();
    }

    public function recordItemTransaction($item_id, $quantity, $location_id, $transactionType, $name_transaction, $name_type) {

        if ($transactionType == "add") {
            // =====
            $this->db->select('SUM(items_has_storage_loc.qty) AS TOTAL_QUANTITY');
            $this->db->from('items_has_storage_loc');
            $this->db->where('items_has_storage_loc.item_id', $item_id);
            $itemStorageLocationQuery = $this->db->get();
            $totalQuantity = $itemStorageLocationQuery->result()[0]->TOTAL_QUANTITY;
            // =====
            $this->db->select('storage_loc.location_name');
            $this->db->from('storage_loc');
            $this->db->where('storage_loc.loc_id', $location_id);
            $locationQuery = $this->db->get();
            $locationName = $locationQuery->result()[0]->location_name;
            // =====
            $transactionDetails = [
                'search_id' => md5($item_id),
                'item_id' => $item_id,
                'item_location' => $locationName,
                'transaction' => "+$quantity",
                'running_quantity' => $totalQuantity,
                'name_transaction' => $name_transaction,
                'name_type' => $name_type,
            ];
            // =====
            $recordTransaction = $this->db->insert('items_transaction_history', $transactionDetails);
            // =====
        }
        if ($transactionType == "deduct") {
            // =====
            $this->db->select('items_has_storage_loc.name, items_has_storage_loc.qty, (SELECT SUM(qty) FROM items_has_storage_loc WHERE item_id = "'.$item_id.'") AS TOTAL_QUANTITY');
            $this->db->from('items_has_storage_loc');
            $this->db->where('items_has_storage_loc.item_id', $item_id);
            $this->db->where('items_has_storage_loc.loc_id', $location_id);
            $itemStorageLocationQuery1 = $this->db->get();
            $itemLocation = $itemStorageLocationQuery1->result()[0]->name;
            $currentQuantity = $itemStorageLocationQuery1->result()[0]->qty;
            $totalQuantity = $itemStorageLocationQuery1->result()[0]->TOTAL_QUANTITY;
            // =====
            $newQuantity = $currentQuantity - $quantity;
            // if ($newQuantity <= 0) { $newQuantity = 0; }
            // =====
            if ($name_type == "USER") {
                $updateItem = $this->db->update('items_has_storage_loc', 
                    ['qty' => $newQuantity], array(
                        'item_id' => $item_id,
                        'loc_id' => $location_id,
                    )
                );

                $transactionDetails = [
                    'search_id' => md5($item_id),
                    'item_id' => $item_id,
                    'item_location' => $itemLocation,
                    'transaction' => "-$quantity",
                    'running_quantity' => $totalQuantity - $quantity,
                    'name_transaction' => $name_transaction,
                    'name_type' => $name_type,
                ];

            } else {
                $transactionDetails = [
                    'search_id' => md5($item_id),
                    'item_id' => $item_id,
                    'item_location' => $itemLocation,
                    'transaction' => "-$quantity",
                    'running_quantity' => $totalQuantity,
                    'name_transaction' => $name_transaction,
                    'name_type' => $name_type,
                ];
            }
            // =====
            $recordTransaction = $this->db->insert('items_transaction_history', $transactionDetails);
            // =====
        }
        return "true";
    }

    public function getItemTransactionHistory($TYPE) {
        $this->db->select('*');
        $this->db->from('items_transaction_history');
        $this->db->where('name_type', $TYPE);
        $query = $this->db->get();
        return $query->result();
    }

    public function clearDefaultLocation() {
        $data = [ 'default' => "" ];
       $this->db->update('storage_loc', $data); 
    }

    public function getSelectedLocation($item_id) {
        $this->db->select('items_has_storage_loc.loc_id, storage_loc.location_name');
        $this->db->from('items_has_storage_loc');
        $this->db->join('storage_loc', 'storage_loc.loc_id = items_has_storage_loc.loc_id', 'left');
        $this->db->where('items_has_storage_loc.item_id', $item_id);
        $this->db->group_by('items_has_storage_loc.loc_id');
        $query = $this->db->get();
        return $query->result();
    }

}



/* End of file Items_model.php */

/* Location: ./application/models/Items_model.php */
