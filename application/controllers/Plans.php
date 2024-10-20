<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Plans extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->checkLogin();
		$this->hasAccessModule(22); 
		$this->page_data['page']->title = 'Plans Management';
		$this->page_data['page']->menu = 'Plans';
	}
	 
	public function index()
	{ 			
		$this->page_data['page']->title = 'Plans';
        $this->page_data['page']->parent = 'Sales';
        $role = logged('role');        
        $company_id =  logged('company_id');
        $this->page_data['plans'] = $this->plans_model->getByWhere(['company_id'=>$company_id]);
		$this->load->view('v2/pages/plans/list', $this->page_data);
	}
	
	public function add(){
		$is_allowed = $this->isAllowedModuleAccess(22);
		$this->page_data['page']->title = 'Plans';


        if( !$is_allowed ){
            $this->page_data['module'] = 'plans';
            echo $this->load->view('no_access_module', $this->page_data, true);
            die();
        }
		$this->page_data['itemsLocation'] = $this->items_model->getLocationStorage();
		$this->page_data['items'] = $this->items_model->getItemlist();
		// ifPermissions('add_plan');
		$this->load->view('v2/pages/plans/add', $this->page_data);
	}

	public function getitems(){
		$pid=get('pid');
		$this->page_data['plan'] = $this->plans_model->getById($pid);

		die($this->load->view('plans/details', $this->page_data, true));
	}
	
	public function edit($id){

		//ifPermissions('plan_edit');
		$plan = $this->plans_model->getById($id);
		$this->page_data['page']->title = 'Plans';
		$this->page_data['items'] = $this->items_model->getItemlist();
		$this->page_data['plan'] = $this->plans_model->getById($id);
		$this->page_data['itemsLocation'] = $this->items_model->getLocationStorage();
		$this->load->view('v2/pages/plans/edit', $this->page_data);
	}

	public function view($id){

		$this->page_data['page']->title = 'Plans';
		$this->page_data['items'] = $this->items_model->getItemlist();
		$this->page_data['plan'] = $this->plans_model->getById($id);
		$this->load->view('v2/pages/plans/view', $this->page_data);
	}

	public function save(){		

		postAllowed();		
		//ifPermissions('add_plan');		
		$post = $this->input->post();
		if(count(post('items')) > 0) {

			$items = post('items');
			$item_ids = post('item_id');
			$quantity = post('quantity');
			$price = post('price');
			$discount = post('discount');
			$type = post('item_type');
			$location = post('location');
			$tax = post('tax');

			foreach(post('items') as $key=>$val) {

				$itemArray[] = array(
					'item_id' => $item_ids[$key],
					'item' => $items[$key],
					'item_type' => $type[$key],
					'quantity'=> $quantity[$key],
					//'location'=> $location[$key],
					'tax' => $tax[$key],
					'discount'=> $discount[$key],
					'price' => $price[$key]
				);
			}

			$paln_items = serialize($itemArray);
		} else {
			$paln_items = '';
		}
		
		$company_id =  logged('company_id');
		$permission = $this->plans_model->create([
			'company_id' => $company_id,
			'plan_name' => $this->input->post('plan_name'),
			'status' => $this->input->post('status'),
			'items' => $paln_items			
		]);

		$this->activity_model->add("New plan #$permission Created by User: #".logged('id'));
		$this->session->set_flashdata('alert-type', 'success');
		$this->session->set_flashdata('alert', 'New plan Created Successfully');		

		redirect('plans');
	}

	public function update($id){		

		postAllowed();
		//ifPermissions('plan_edit');
		$post = $this->input->post();
		if(count(post('items')) > 0) {
			$items = post('items');
			$item_ids = post('item_id');
			$quantity = post('quantity');
			$price    = post('price');
			$discount = post('discount');
			$type     = post('item_type');
			$location = post('location');
			$tax      = post('tax');
			
			foreach($items as $key=> $val) {				
				$itemArray[] = array(
					'item' => $val,
					'item_id' => $item_ids[$key],
					'item_type' => $type[$key],
					'quantity'=> $quantity[$key],
					'tax' => $tax[$key],
					//'location'=> $location[$key],
					'discount'=> $discount[$key],
					'price' => $price[$key]
				);
			}
			$plan_items = serialize($itemArray);
		} else {
			$plan_items = '';
		}

		$company_id =  logged('company_id');
		$data = [
			'company_id' => $company_id,
			'plan_name' => $this->input->post('plan_name'),
			'status' => $this->input->post('status'),
			'items' => $plan_items				
		];

		$permission = $this->plans_model->update($id, $data);
		$this->activity_model->add("plan #$id Updated by User: #".logged('id'));

		$this->session->set_flashdata('alert-type', 'success');
		$this->session->set_flashdata('alert', 'Plan has been Updated Successfully');		

		redirect('plans');
	}

	public function delete($id){

		ifPermissions('plan_delete');

		$this->items_model->delete($id);
		$this->session->set_flashdata('alert-type', 'success');
		$this->session->set_flashdata('alert', 'item has been Deleted Successfully');
		$this->activity_model->add("Item #$permission Deleted by User: #".logged('id'));
		redirect('items');
	}

	public function delete_plan_v2(){
		// Delete plan via ajax request

		$id = $this->input->post('id');
		$delete = $this->plans_model->deletePlan($id);
        echo true;
	}

	public function checkIfUnique(){		

		$code = get('code');
		if(!$code)
			die('Invalid Request');
		
		$arg = [ 'code' => $code ];
		
		if(!empty(get('notId')))
			$arg['id !='] = get('notId');



		$query = $this->items_model->getByWhere($arg);

		if(!empty($query))
			die('false');
		else
			die('true');
	}

	public function delete_plan(){
        $this->plans_model->deletePlan(post('pid'));

        $this->session->set_flashdata('message', 'Plan has been Deleted Successfully');
        $this->session->set_flashdata('alert_class', 'alert-success');

        redirect('plans');
	}

}



/* End of file items.php */

/* Location: ./application/controllers/items.php */