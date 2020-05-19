<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vault extends MY_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->page_data['page']->title = 'Files Management';
		$this->page_data['page']->menu = 'vault';
	}

	public function index()
	{
		
		$this->page_data['files'] = $this->vault_model->get();
		$this->load->view('vault/list', $this->page_data);
	}

	public function add()
	{
		$this->load->view('vault/add', $this->page_data);
	}

	public function edit($id)
	{
		$this->page_data['file'] = $this->vault_model->getById($id);
		$this->load->view('vault/edit', $this->page_data);

	}

	public function save()
	{
		
		postAllowed();

		$cid=logged('comp_id');	
		$uid=logged('id');	
		$data = [
			'title' => $this->input->post('title'),
			'uid' => $uid,
			'comp_id' => $cid,
			'estimate_resource' => $this->input->post('estimate_resource'),
			'invoice_resource' => $this->input->post('invoice_resource')
		];
				
		$vaultid = $this->vault_model->create($data);
		
		if(!empty($_FILES['fullfile']['name'])) {

			$filename = $_FILES['fullfile']['name'];
			$ext = pathinfo($filename, PATHINFO_EXTENSION);
			$filename = str_replace(' ','_',$filename);
			$this->uploadlib->initialize([
				'file_name' => $filename
			]);

			$image = $this->uploadlib->uploadImage('fullfile', '/files');

			if($image['status']){
				$this->vault_model->update($vaultid, ['fullfile' => $filename]);
			}
		}
		
		

		$this->activity_model->add("New File #$vault Created by User: #".logged('id'));

		$this->session->set_flashdata('alert-type', 'success');
		$this->session->set_flashdata('alert', 'New File Created Successfully');
		
		redirect('vault');

	}

	public function update($id)
	{
		
		postAllowed();

		ifPermissions('permissions_edit');

		$data = [
			'title' => $this->input->post('name'),
			'code' => $this->input->post('code'),
		];

		$file = $this->vault_model->update($id, $data);

		$this->activity_model->add("File #$id Updated by User: #".logged('id'));

		$this->session->set_flashdata('alert-type', 'success');
		$this->session->set_flashdata('alert', 'File has been Updated Successfully');
		
		redirect('vault');

	}

	public function delete($id)
	{

		ifPermissions('permissions_delete');

		$this->vault_model->delete($id);

		$this->session->set_flashdata('alert-type', 'success');
		$this->session->set_flashdata('alert', 'File has been Deleted Successfully');

		$this->activity_model->add("File #$id Deleted by User: #".logged('id'));

		redirect('vault');

	}

}

/* End of file Permissions.php */
/* Location: ./application/controllers/Permissions.php */