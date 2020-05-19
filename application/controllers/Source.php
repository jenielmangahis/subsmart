<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Source extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->page_data['page']->title = 'Source Management';
        $this->page_data['page']->menu = 'source';
        
        $this->load->model('Source_model', 'source_model');
	}

	public function index()
	{
		// ifPermissions('roles_list');
		$this->page_data['sources'] = $this->source_model->getAll();
		$this->load->view('source/list', $this->page_data);
    }

	public function json_list()
	{
        // ifPermissions('roles_list');
        $get = $this->input->get();
		$sources = $this->source_model->getAll($get);
        
        echo json_encode($sources);
    }

	public function add()
	{
		// ifPermissions('roles_add');
		$this->load->view('roles/add', $this->page_data);
	}

	public function save()
	{

		// ifPermissions('roles_add');
		
        postAllowed();

		$post = $this->input->post();

		return $this->source_model->create($post);
	}

	public function edit($id)
	{

		ifPermissions('roles_edit');

		$this->page_data['role'] = $this->roles_model->getById($id);
		$permissions = $this->role_permissions_model->getByWhere([
			'role' => $this->page_data['role']->id
		]);

		$permissions = array_map(function($data)
		{
			return $data->permission;
		}, $permissions);

		$this->page_data['role_permissions'] = $permissions;
		$this->load->view('roles/edit', $this->page_data);

	}


	public function update($id)
	{

		ifPermissions('roles_edit');
		
		postAllowed();

		$data = [
			'title' => $this->input->post('name'),
		];

		if(!empty($password = post('password')))
			$data['password'] = hash( "sha256", $password );

		$role = $this->roles_model->update($id, $data);


		// Data which will be added
		$Data = [];
		foreach (post('permission') as $permission) {
			if( !empty($this->role_permissions_model->getByWhere([ 'role' => $id, 'permission' => $permission ])) ){ }else{
				array_push($Data, [
					'role' => $role,
					'permission' => $permission,
				]);
			}
		}

		if(!empty($Data))
			$this->role_permissions_model->create_batch($Data);

		$all_permissions = $this->role_permissions_model->getByWhere([
			'role' =>  $role
		]);

		if(!empty($all_permissions)){
			// Permissions which will be deleted
			foreach ($all_permissions as $data) {
				
				if(!in_array($data->permission, post('permission'))){
					$this->role_permissions_model->delete($data->id);
				}
			
			}
		}
		
		$this->activity_model->add("Role #$role Updated by User: #".logged('id'));
		
		$this->session->set_flashdata('alert-type', 'success');
		$this->session->set_flashdata('alert', 'User Role has been Updated Successfully');
		
		redirect('roles');

	}

}

/* End of file Source.php */
/* Location: ./application/controllers/Source.php */