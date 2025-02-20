<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Items extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->checkLogin();
        $this->hasAccessModule(20);
        $this->page_data['page']->title = 'items Management';
        $this->page_data['page']->menu = 'items';
    }

    public function getitems()
    {
        $keyword = get('sk');
        // $res = $this->items_model->getByLike('title',$keyword);
        $company_id = logged('company_id');
        $res = $this->db->where('company_id', $company_id)->like('title', $keyword, 'after')->get('items')->result();
        foreach ($res as $row) {
            if( $row->discount == '' ){
                $discount = 0;
            }else{
                $discount = $row->discount;
            }
            $gh = "'" . $row->title . "'," . $row->price . "," . $discount . "," . $row->id;

            echo '<li class="testing" onClick="setitem(this,' . $gh . ')">' . $row->title . '</li>';
        }
        exit();
    }

    public function getitemsV2(){
        $company_id = logged('company_id');
        $res = $this->db->where('company_id', $company_id)->get('items')->result();

        foreach ($res as $row) {
            if( $row->discount == '' ){
                $discount = 0;
            }else{
                $discount = $row->discount;
            }
            $gh = "'" . $row->title . "'," . $row->price . "," . $discount . "," . $row->id;

            echo '<option value="'.$row->title.'" data-price="'. $row->price .'" data-discount="'. $discount .'" data-id="'.$row->id.'">'. $row->title .'</option>';
        }
        exit();
    }

    public function getitemsPackage()
    {
        $keyword = get('sk');
        // $res = $this->items_model->getByLike('title',$keyword);
        $company_id = logged('company_id');
        $res = $this->db->where('company_id', $company_id)->like('title', $keyword, 'after')->get('items')->result();
        foreach ($res as $row) {
            if( $row->discount == '' ){
                $discount = 0;
            }else{
                $discount = $row->discount;
            }
            $gh = "'" . $row->title . "'," . $row->price . "," . $discount . "," . $row->id;

            echo '<li class="testing" onClick="setitemPackage(this,' . $gh . ')">' . $row->title . '</li>';
        }
        exit();
    }

    public function getitems2()
    {
        $keyword = get('sk');
        // $res = $this->items_model->getByLike('title',$keyword);
        $company_id = logged('company_id');
        $res = $this->db->where('company_id', $company_id)->like('title', $keyword, 'after')->get('items')->result();
        foreach ($res as $row) {
            if( $row->discount == '' ){
                $discount = 0;
            }else{
                $discount = $row->discount;
            }
            $gh = "'" . $row->title . "'," . $row->price . "," . $discount . "," . $row->id;

            echo '<li onClick="setitem2(this,' . $gh . ')">' . $row->title . '</li>';
        }
        exit();
    }

    public function getitems_cm()
    {
        $keyword = get('sk');
        // $res = $this->items_model->getByLike('title',$keyword);
        $company_id = logged('company_id');
        $res = $this->db->where('company_id', $company_id)->like('title', $keyword, 'after')->get('items')->result();
        foreach ($res as $row) {
            if( $row->discount == '' ){
                $discount = 0;
            }else{
                $discount = $row->discount;
            }
            $gh = "'" . $row->title . "'," . $row->price . "," . $discount . "," . $row->id;

            echo '<li onClick="setitemCM(this,' . $gh . ')">' . $row->title . '</li>';
        }
        exit();
    }

    public function getitems_sr()
    {
        $keyword = get('sk');
        // $res = $this->items_model->getByLike('title',$keyword);
        $company_id = logged('company_id');
        $res = $this->db->where('company_id', $company_id)->like('title', $keyword, 'after')->get('items')->result();
        foreach ($res as $row) {
            if( $row->discount == '' ){
                $discount = 0;
            }else{
                $discount = $row->discount;
            }
            $gh = "'" . $row->title . "'," . $row->price . "," . $discount . "," . $row->id;

            echo '<li onClick="setitemsr(this,' . $gh . ')">' . $row->title . '</li>';
        }
        exit();
    }

    public function getitem_Receipt()
    {
        $keyword = get('sk');
        // $res = $this->items_model->getByLike('title',$keyword);
        $company_id = logged('company_id');
        $res = $this->db->where('company_id', $company_id)->like('title', $keyword, 'after')->get('items')->result();
        foreach ($res as $row) {
            if( $row->discount == '' ){
                $discount = 0;
            }else{
                $discount = $row->discount;
            }
            $gh = "'" . $row->title . "'," . $row->price . "," . $discount . "," . $row->id;

            echo '<li onClick="setitemReceipt(this,' . $gh . ')">' . $row->title . '</li>';
        }
        exit();
    }
    
    public function getitem_Credit()
    {
        $keyword = get('sk');
        // $res = $this->items_model->getByLike('title',$keyword);
        $company_id = logged('company_id');
        $res = $this->db->where('company_id', $company_id)->like('title', $keyword, 'after')->get('items')->result();
        foreach ($res as $row) {
            if( $row->discount == '' ){
                $discount = 0;
            }else{
                $discount = $row->discount;
            }
            $gh = "'" . $row->title . "'," . $row->price . "," . $discount . "," . $row->id;

            echo '<li onClick="setitemCredit(this,' . $gh . ')">' . $row->title . '</li>';
        }
        exit();
    }

    public function getitem_Charge()
    {
        $keyword = get('sk');
        // $res = $this->items_model->getByLike('title',$keyword);
        $company_id = logged('company_id');
        $res = $this->db->where('company_id', $company_id)->like('title', $keyword, 'after')->get('items')->result();
        foreach ($res as $row) {
            if( $row->discount == '' ){
                $discount = 0;
            }else{
                $discount = $row->discount;
            }
            $gh = "'" . $row->title . "'," . $row->price . "," . $discount . "," . $row->id;

            echo '<li onClick="setitemCharge(this,' . $gh . ')">' . $row->title . '</li>';
        }
        exit();
    }

    public function index()
    {
        $is_allowed = $this->isAllowedModuleAccess(20);
        if( !$is_allowed ){
            $this->page_data['module'] = 'items';
            echo $this->load->view('no_access_module', $this->page_data, true);
            die();
        }

        // ifPermissions('items_list');

        $get = $this->input->get();

        // print_r($get); die;

        // $this->page_data['items'] = $this->items_model->get();
        $company_id = logged('company_id');

        if (!empty($get['search'])) {
            $this->page_data['search'] = $get['search'];
            $this->page_data['items'] = $this->items_model->filterBy(['search' => $get['search']], $company_id);
        } else {
            $this->page_data['items'] = $this->items_model->getByWhere(['company_id' => $company_id]);
        }

        $this->load->view('items/list', $this->page_data);
    }

    public function add()
    {
        /*$is_allowed = $this->isAllowedModuleAccess(20);
        if( !$is_allowed ){
            $this->page_data['module'] = 'items_add';
            echo $this->load->view('no_access_module', $this->page_data, true);
            die();
        }
        ifPermissions('items_add');*/
        $this->load->view('items/add', $this->page_data);
    }

    public function edit($id)
    {

        ifPermissions('items_edit');
        $this->page_data['items'] = $this->items_model->getById($id);
        $this->load->view('items/edit', $this->page_data);
    }


    public function save()
    {

        postAllowed();

        ifPermissions('items_add');
        $company_id = logged('company_id');
        $permission = $this->items_model->create([
            'company_id' => $company_id,
            'title' => $this->input->post('title'),
            'price' => $this->input->post('price'),
            'description' => $this->input->post('description'),
            'type' => $this->input->post('type'),
            'cost' => $this->input->post('cost'),
            'url' => $this->input->post('url'),
            'model' => $this->input->post('model'),
            // 'price1' => $this->input->post('price1'),
            // 'price2' => $this->input->post('price2'),
            // 'price3' => $this->input->post('price3'),
            // 'price4' => $this->input->post('price4'),
            'notes' => $this->input->post('notes')

        ]);

        $this->activity_model->add("New item #$permission Created by User: #" . logged('id'));
        $this->session->set_flashdata('alert-type', 'success');
        $this->session->set_flashdata('alert', 'New item Created Successfully');

        redirect('items');
    }


    public function update($id)
    {

        postAllowed();

        ifPermissions('items_edit');
        $company_id = logged('company_id');
        $data = [
            'company_id' => $company_id,
            'title' => $this->input->post('title'),
            'price' => $this->input->post('price'),
            'description' => $this->input->post('description'),
            'type' => $this->input->post('type'),
            'cost' => $this->input->post('cost'),
            'url' => $this->input->post('url'),
            'model' => $this->input->post('model'),
            // 'price1' => $this->input->post('price1'),
            // 'price2' => $this->input->post('price2'),
            // 'price3' => $this->input->post('price3'),
            // 'price4' => $this->input->post('price4'),
            'notes' => $this->input->post('notes')

        ];


        $permission = $this->items_model->update($id, $data);
        $this->activity_model->add("item #$id Updated by User: #" . logged('id'));

        $this->session->set_flashdata('alert-type', 'success');
        $this->session->set_flashdata('alert', 'item has been Updated Successfully');

        redirect('items');
    }

    public function delete($id)
    {

        ifPermissions('items_delete');

        $this->items_model->delete($id);
        $this->session->set_flashdata('alert-type', 'success');
        $this->session->set_flashdata('alert', 'item has been Deleted Successfully');
        $this->activity_model->add("Item #$permission Deleted by User: #" . logged('id'));
        redirect('items');
    }


    public function checkIfUnique()
    {

        $code = get('code');
        if (!$code)
            die('Invalid Request');

        $arg = ['code' => $code];

        if (!empty(get('notId')))
            $arg['id !='] = get('notId');


        $query = $this->items_model->getByWhere($arg);

        if (!empty($query))
            die('false');
        else
            die('true');
    }

    public function print()
    {

        ifPermissions('items_list');

        $get = $this->input->get();

        // print_r($get); die;

        // $this->page_data['items'] = $this->items_model->get();
        $company_id = logged('company_id');

        if (!empty($get['search'])) {
            $this->page_data['search'] = $get['search'];
            $this->page_data['items'] = $this->items_model->filterBy(['search' => $get['search']], $company_id);
        } else {
            $this->page_data['items'] = $this->items_model->getByWhere(['company_id' => $company_id]);
        }

        $this->load->view('items/print/list', $this->page_data);
    }

    public function ajax_get_item_details()
    {
        $this->load->model('Items_model');

        $post = $this->input->post();
        $company_id = logged('company_id');
        $item = $this->Items_model->getCompanyItemById($company_id, $post['itemid']);

        if( $item ){
            $is_exists = true;
            $json_data = [
                'is_exists' => true,
                'item_name' => $item->title,
                'item_id' => $item->id,
                'item_price' => $item->price
            ];
        }else{
            $json_data = ['is_exists' => false];
        }

        echo json_encode($json_data);
    }

    public function ajax_add_product_list()
    {
        $this->load->model('Items_model');
        
        $cid  = logged('company_id');
        $post = $this->input->post();
        if( isset($post['product_name']) && $post['product_name'] != '' ){
            $search[] = ['field' => 'items.title', 'value' => trim($post['product_name'])];
            $items = $this->Items_model->getAllIsActiveByCompanyIdAndItemType($cid,'Product',$search);
        }else{
            $items = $this->Items_model->getAllIsActiveByCompanyIdAndItemType($cid,'Product');
        }        
        
        $companyItems = [];
        foreach($items as $i){    
            $item_data = [
                'id' => $i->id,
                'name' => $i->title,
                'price' => $i->price,
                'retail' => $i->retail,
                'category' => $i->category_name
            ];
            $storage = $this->Items_model->getAllItemStorageQuantityByItemId($i->id);
            if( $storage ){                
                $companyItems[$i->id] = ['storage' => $storage, 'item' => $item_data];
            }
        }

        $this->page_data['companyItems'] = $companyItems;
        $this->load->view('v2/pages/items/ajax_add_product_list', $this->page_data);
    }

    public function ajax_edit_product_stock()
    {
        $this->load->model('Items_model');
        
        $cid  = logged('company_id');
        $post = $this->input->post();
        
        $item = $this->Items_model->getCompanyItemById($cid,$post['product_id']);         
        $storageLocation  = $this->Items_model->getLocationById($post['strorage_id']);
        $itemLocation = $this->Items_model->getItemLocation($post['strorage_id'], $post['product_id']);
        $this->page_data['item'] = $item;
        $this->page_data['storageLocation']  = $storageLocation;
        $this->page_data['itemLocation'] = $itemLocation;
        $this->load->view('v2/pages/items/ajax_edit_product_stock', $this->page_data);
    }

    public function ajax_add_services_list()
    {
        $this->load->model('Items_model');
        
        $cid  = logged('company_id');
        $post = $this->input->post();
        if( isset($post['service_name']) && $post['service_name'] != '' ){
            $search[] = ['field' => 'items.title', 'value' => trim($post['service_name'])];
            $items = $this->Items_model->getAllIsActiveByCompanyIdAndItemType($cid,'Service',$search);
        }else{
            $items = $this->Items_model->getAllIsActiveByCompanyIdAndItemType($cid,'Service');
        }        
        
        $companyServices = [];
        foreach($items as $i){    
            $service_data = [
                'id' => $i->id,
                'name' => $i->title,
                'price' => $i->price,
                'retail' => $i->retail,
                'category' => $i->category_name
            ];
            $companyServices[$i->id] = ['services' => $service_data];
        }

        $this->page_data['companyServices'] = $companyServices;
        $this->load->view('v2/pages/items/ajax_add_services_list', $this->page_data);
    }

    public function ajax_update_product_stock()
    {
        $this->load->model('Items_model');
        
        $is_success = 1;
		$msg  = '';
        
        $cid  = logged('company_id');
        $uid  = logged('id');
        $post = $this->input->post();

        if( $post['itemid'] <= 0 ){
            $msg = 'Cannot find product data';
            $is_success = 0;
        }

        if( $post['product_stock'] <= 0 ){
            $msg = 'Please specify product stock';
            $is_success = 0;
        }
        if( $is_success == 1 ){
            $itemLocation = $this->Items_model->getItemLocation($post['storagelocid'], $post['itemid']);
            if( $itemLocation ){
                //Check if storage exists
                $storageLocation  = $this->Items_model->getLocationById($itemLocation->loc_id);
                if( $storageLocation ){
                    //Update stock
                    $item_has_storage_data = [
                        'name' => $post['storage_location_name'],
                        'inserted_by' => $uid,
                        'qty' => $post['product_stock'],
                        'location_name' => $post['storage_location_name']
                    ];
                    $condition = ['id' => $itemLocation->id];
                    $this->Items_model->updateLocationDetails($item_has_storage_data, $condition);
                    
                    //Update storage location name
                    $storage_data = ['location_name' => $post['storage_location_name']];
                    $this->Items_model->updateStorageLocationByLocId($post['storagelocid'], $storage_data);
                }else{
                    //Create new storage if not exists
                    $storage_data = [
                        'location_name' => $post['storage_location_name'],
                        'company_id' => $cid,
                        'default' => ''
                    ];
                    $new_location_id = $this->Items_model->add_new_location($storage_data);
                    if( $new_location_id > 0 ){
                        //Create item has storage location data
                        $item_has_storage_data = [
                            'item_id' => $post['itemid'],
                            'name' => $post['storage_location_name'],
                            'inserted_by' => $uid,
                            'insert_date' => date("Y-m-d H:i:s"),
                            'qty' => $post['product_stock'],
                            'initial_qty' => $post['product_stock'],
                            'company_id' => $cid,
                            'loc_id' => $new_location_id,
                            'location_name' => $post['storage_location_name']
                        ];
                        $this->Items_model->saveNewItemLocation($item_has_storage_data);      
                        $this->Items_model->deleteLocation($itemLocation->id, false);             
                    }else{
                        $is_success = 0;
                        $msg = 'Cannot create storage location.';
                    }
                }

                $activity_name = 'User id '.$uid.' has updated product stock for item id '.$post['itemid'];
                $this->activity_model->add($activity_name,$uid);
                
            }
        }

        $data = ['msg' => $msg, 'is_success' => $is_success];
		echo json_encode($data);
    }
}



/* End of file items.php */

/* Location: ./application/controllers/items.php */