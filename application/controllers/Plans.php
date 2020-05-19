<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Plans extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->page_data['page']->title = 'Plans Management';
		$this->page_data['page']->menu = 'Plans';
	}
	 
	public function index()
	{
 
		ifPermissions('plan_list');

		// $this->page_data['items'] = $this->items_model->get();
		$comp_id =  logged('comp_id');
		$this->page_data['plans'] = $this->plans_model->getByWhere(['comp_id'=>$comp_id]);
		/* echo "<pre>"; print_r($this->page_data['items']); die; */
		$this->load->view('plans/list', $this->page_data);
	}
	
	public function add(){
		ifPermissions('add_plan');
		$this->load->view('plans/add', $this->page_data);
	}

	public function getitems(){
		$pid=get('pid');
		$this->page_data['plan'] = $this->plans_model->getById($pid);

		die($this->load->view('plans/details', $this->page_data, true));
	}
	
	public function edit($id){

		ifPermissions('plan_edit');
		$this->page_data['plan'] = $this->plans_model->getById($id);
		$this->load->view('plans/edit', $this->page_data);
	}



	public function save(){		

		postAllowed();		
		ifPermissions('add_plan');		
		
		if(count(post('item')) > 0) {

			$items = post('item');
			$quantity = post('quantity');
			$price = post('price');
			$discount = post('discount');
			$type = post('item_type');
			$location = post('location');

			foreach(post('item') as $key=>$val) {

				$itemArray[] = array(

					'item' => $items[$key],
					'item_type' => $type[$key],
					'quantity'=> $quantity[$key],
					'location'=> $location[$key],
					'discount'=> $discount[$key],
					'price' => $price[$key]
				);
			}

			$paln_items = serialize($itemArray);
		} else {
			$paln_items = '';
		}
		
		
		$comp_id =  logged('comp_id');
		$permission = $this->plans_model->create([
			'comp_id' => $comp_id,
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
		ifPermissions('plan_edit');
		
		if(count(post('item')) > 0) {

			$items = post('item');
			$quantity = post('quantity');
			$price = post('price');
			$discount = post('discount');
			$type = post('item_type');
			$location = post('location');

			foreach(post('item') as $key=>$val) {

				$itemArray[] = array(

					'item' => $items[$key],
					'item_type' => $type[$key],
					'quantity'=> $quantity[$key],
					'location'=> $location[$key],
					'discount'=> $discount[$key],
					'price' => $price[$key]
				);
			}

			$paln_items = serialize($itemArray);
		} else {
			$paln_items = '';
		}
		
		// echo "<pre>"; print_r($itemArray); die;
		$comp_id =  logged('comp_id');
		$data = [
			'comp_id' => $comp_id,
			'plan_name' => $this->input->post('plan_name'),
			'status' => $this->input->post('status'),
			'items' => $paln_items	
			
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

}



/* End of file items.php */

/* Location: ./application/controllers/items.php */