<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Workstatus extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->page_data['page']->title = 'Work status Management';
        $this->page_data['page']->menu = (!empty($this->uri->segment(2))) ? $this->uri->segment(2) : 'workstatus';
	}
	 
	public function index()
	{ 
		ifPermissions('plan_list');
		
		$comp_id =  logged('comp_id');
		$this->page_data['workstatus'] = $this->Workstatus_model->getByWhere(['comp_id'=>$comp_id]);
		$this->load->view('workstatus/list', $this->page_data);
	}
	
	public function add(){
		$this->load->view('workstatus/add', $this->page_data);
	}

	
	public function edit($id){
		$this->page_data['workstatus'] = $this->Workstatus_model->getById($id);
		$this->load->view('workstatus/edit', $this->page_data);
	}



	public function save(){		

		postAllowed();			
		
		$comp_id =  logged('comp_id');
		$permission = $this->Workstatus_model->create([
			'comp_id' => $comp_id,
			'title' => $this->input->post('title'),
			'color' => $this->input->post('color')
		]);

		$this->activity_model->add("New Workstatus #$permission Created by User: #".logged('id'));
		$this->session->set_flashdata('alert-type', 'success');
		$this->session->set_flashdata('alert', 'New Workstatus Created Successfully');		

		redirect('workstatus');
	}



	public function update($id){		

		postAllowed();
		
		$comp_id =  logged('comp_id');
		$data = [
			'comp_id' => $comp_id,
			'title' => $this->input->post('title'),
			'color' => $this->input->post('color')
		];



		$permission = $this->Workstatus_model->update($id, $data);
		$this->activity_model->add("Workstatus #$id Updated by User: #".logged('id'));

		$this->session->set_flashdata('alert-type', 'success');
		$this->session->set_flashdata('alert', 'Workstatus has been Updated Successfully');		

		redirect('workstatus');
	}

	public function delete($id){


		$this->Workstatus_model->delete($id);
		$this->session->set_flashdata('alert-type', 'success');
		$this->session->set_flashdata('alert', 'Workstatus has been Deleted Successfully');
		$this->activity_model->add("Workstatus #$permission Deleted by User: #".logged('id'));
		redirect('workstatus');
	}

}



/* End of file items.php */

/* Location: ./application/controllers/items.php */