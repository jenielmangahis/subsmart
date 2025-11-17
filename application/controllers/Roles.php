<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Roles extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->checkLogin();
		$this->page_data['page']->title = 'Roles';
		$this->page_data['page']->menu = 'job title';
	}

	public function index()
	{
		$this->load->model('Roles_model');

		$company_id = logged('company_id');

		$roles = $this->Roles_model->getAllByCompanyId($company_id);

		$this->page_data['roles'] = $roles;
		$this->load->view('v2/pages/roles/list', $this->page_data);
	}

	public function add()
	{
		ifPermissions('roles_add');
		$this->load->view('roles/add', $this->page_data);
	}

	public function ajax_save_role()
	{
		$this->load->model('Roles_model');

        $is_success = 0;
        $msg = 'Cannot save data';

		$company_id  = logged('company_id');
        $post = $this->input->post();

		$isExists = $this->Roles_model->getByTitleAndCompanyId($post['job_title'], $company_id);
		if( $isExists ){
			$msg = 'Job title ' . $post['job_title'] . ' already exists';
		}else{
			$data = [
				'company_id' => $company_id,
				'title' => $post['job_title'],
				'date_created' => date("Y-m-d H:i:s")
			];

			$this->Roles_model->create($data);

			$is_success = 1;
        	$msg = '';

			//Activity Logs
			$activity_name = 'Job Title : Created job title ' . $post['job_title']; 
			createActivityLog($activity_name);
		}

		$return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
	}

	public function ajax_update_job_title()
	{
		$this->load->model('Roles_model');

        $is_success = 0;
        $msg = 'Cannot find data';

		$company_id = logged('company_id');
        $post = $this->input->post();

		$isExists = $this->Roles_model->getByTitleAndCompanyId($post['job_title'], $company_id);
		if( $isExists && $isExists->id != $post['jtid'] ){
			$msg = 'Job title ' . $post['job_title'] . ' already exists';
		}else{
			$role = $this->Roles_model->getById($post['jtid']);
			if( $role && $role->company_id == $company_id ){
				$data = [
					'title' => $post['job_title'],
					'date_updated' => date("Y-m-d H:i:s")
				];

				$this->Roles_model->update($role->id, $data);

				$is_success = 1;
				$msg = '';

				//Activity Logs
				$activity_name = 'Job Title : Updated job title ' . $role->title . ' changed title to ' . $post['job_title']; 
				createActivityLog($activity_name);
			}
		}

		$return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
	}

	public function ajax_delete_job_title()
    {
        $this->load->model('Roles_model');

        $post = $this->input->post();
        $company_id = logged('company_id');
        $is_success = 0;
        $msg = 'Cannot find data';

        $role = $this->Roles_model->getById($post['job_title_id']);
		if( $role && $role->company_id == $company_id ){
			$this->Roles_model->delete($role->id);

            $is_success = 1;
            $msg = '';

            //Activity Logs
            $activity_name = 'Job Title : Deleted job title ' . $role->title; 
            createActivityLog($activity_name);
		}

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
    }

	public function ajax_delete_selected_job_titles()
	{
		$this->load->model('Roles_model');

		$is_success = 0;
        $msg    = 'Please select data';

        $company_id  = logged('company_id');
        $post = $this->input->post();

        if( $post['roles'] ){

            $filters[] = ['field' => 'company_id', 'value' => $company_id];
            $total_deleted = $this->Roles_model->bulkDelete($post['roles'], $filters);

			//Activity Logs
			$activity_name = 'Job Title : Deleted ' .$total_deleted. ' job title(s)'; 
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

	public function save()
	{

		ifPermissions('roles_add');
		
		postAllowed();

		$role = $this->roles_model->create([
			'title' => $this->input->post('name'),
		]);

		$Data = [];
		foreach (post('permission') as $permission) {
			array_push($Data, [
				'role' => $role,
				'permission' => $permission,
			]);
		}

		$this->role_permissions_model->create_batch($Data);

		$this->session->set_flashdata('alert-type', 'success');
		$this->session->set_flashdata('alert', 'New Role Created Successfully');

		$this->activity_model->add("New Role #$role Created by User: #".logged('id'));
		
		redirect('roles');

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

/* End of file Roles.php */
/* Location: ./application/controllers/Roles.php */