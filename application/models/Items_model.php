<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Items_model extends MY_Model
{
    public $table = 'items';
    public $table_categories = 'item_categories';
    public $table_invoice = 'invoice_has_items';
    public $table_has_location = 'items_has_storage_loc';
    public $table_offer_code = 'offer_code';

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

    
	public function getUserByID($id) {
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->result();
	}

    public function categoriesWithoutParent()
    {
        $this->db->where('company_id', getLoggedCompanyID());
        $this->db->where('parent_id', null);
        $this->db->or_where('parent_id', 0);
        $this->db->or_where('parent_id', '');
        $query = $this->db->get($this->table_categories);

        return $query->result();
    }

    public function insertCategory($data)
    {
        $insert = $this->db->insert($this->table_categories, $data);
        return $insert ? true : false;
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
        if( $company_id > 0 ){
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

    public function getByCompanyId($company_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $company_id);
        $query = $this->db->get();
        return $query->result();
    }

    public function getItemsWithFilter($filters = [], $columnName = 'title', $order = 'asc')
    {
        $this->db->where('company_id', getLoggedCompanyID());
        $this->db->where_in('is_active', $filters['status']);
        if(isset($filters['category'])) {
            $this->db->where_in('item_categories_id', $filters['category']);
        }
        if(isset($filters['type'])) {
            $this->db->where_in('type', $filters['type']);
        }
        $this->db->order_by($columnName, $order);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function inactiveItem($id)
    {
        $this->db->where('company_id', getLoggedCompanyID());
        $this->db->where('id', $id);
        $inactive = $this->db->update($this->table, ['is_active' => 0]);
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

    function getRows($params = array()) {
        $this->db->select('*');
        $this->db->from($this->table);
        
        if(array_key_exists("where", $params)){
            foreach($params['where'] as $key => $val){
                $this->db->where($key, $val);
            }
        }
        
        if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
            $result = $this->db->count_all_results();
        }else{
            if(array_key_exists("id", $params)){
                $this->db->where('id', $params['id']);
                $query = $this->db->get();
                $result = $query->row_array();
            }else{
                $this->db->order_by('id', 'desc');
                if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                    $this->db->limit($params['limit'],$params['start']);
                }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                    $this->db->limit($params['limit']);
                }
                
                $query = $this->db->get();
                $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
            }
        }
        
        // Return fetched data
        return $result;
    }

    public function insert($data = array()) {
        if(!empty($data)){     

            $insert = $this->db->insert($this->table, $data);
            return $insert?$this->db->insert_id():false;
        }
        return false;
    }

    public function update($data, $condition = array()) {
        if(!empty($data)){
            // Add modified date if not included
            if(!array_key_exists("modified", $data)){
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
        if(!empty($data)) {
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

    public function getLocationByItemId($id) 
    {
        $this->db->select('*');
        $this->db->from($this->table_has_location);
        $this->db->where('item_id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getBundleContents($id)
    {
        $this->db->where('company_id', logged('company_id'));
        $this->db->where('item_id', $id);
        $query = $this->db->get('bundle_item_contents');
        return $query->result();
    }

    public function deleteBundleItem($id, $item_id)
    {
        $this->db->where('company_id', logged('company_id'));
        $this->db->where('id', $id);
        $this->db->where('item_id', $item_id);
        $delete = $this->db->delete('bundle_item_contents');
        return $delete ? true : false;
    }

    public function saveNewItemLocation($data = array()) {
        if(!empty($data)){     
            $insert = $this->db->insert($this->table_has_location, $data);
            return $insert?$this->db->insert_id():false;
        }
        return false;
    }

    public function saveBatchItemLocation($data = []) {
        if(!empty($data)) {
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
        $this->db->where('product_id', $item_id);
        $this->db->where('location_id', $location_id);
        $query = $this->db->get('accounting_inventory_qty_adjustment_items');

        return $query->result();
    }

    public function saveItemAccountingDetails($data = []) {
        if(!empty($data)) {
            $insert = $this->db->insert('items_accounting_details', $data);
            return $this->db->insert_id();
        }
        return false;
    }

    public function updateItemAccountingDetails($data, $item_id) {
        $this->db->where('item_id', $item_id);
        $update = $this->db->update('items_accounting_details', $data);
        return $update ? true : false;
    }

    public function getItemAccountingDetails($item_id) {
        $this->db->where('item_id', $item_id);
        $query = $this->db->get('items_accounting_details');
        return $query->row();
    }

    public function countQty($item_id) {
        $items = $this->getLocationByItemId($item_id);
        $qty = 0;
        for($i=0;$i<count($items);$i++) {
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
        if($get_val == '1'){
            $item_val = '0';
        }else{
            $item_val = '1';
        }
        $this->db->where('id', $id);
        $this->db->update('items', array('rebate' => $item_val));
        return true;
    }

    public function getItemData($id){
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
    
}



/* End of file Items_model.php */

/* Location: ./application/models/Items_model.php */