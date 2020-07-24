<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Company extends MY_Controller {



	public function __construct()

	{

		parent::__construct();
        $this->checkLogin();

		$this->page_data['page']->title = 'Company Management';

		$this->page_data['page']->menu = 'companies';	

		$user_id = getLoggedUserID();
		

		if($user_id != 1) {

			redirect('/');
		}

	}

	public function index()

	{			

		$this->page_data['users'] = $this->company_model->getAllCompanies();

		$this->load->view('company/list', $this->page_data);

	}



	public function add()

	{		

		$this->load->view('company/add', $this->page_data);

	}



	public function save()

	{	

		postAllowed();

		$user = (object)$this->session->userdata('logged');

		$id = $this->users_model->create([

			'role' => post('role'),

			'name' => post('name'),

			'username' => post('username'),

			'email' => post('email'),

			'phone' => post('phone'),

			'address' => post('address'),

			'status' => (int) post('status'),

			'password' => hash( "sha256", post('password') ),
			
			'parent_id' => $user->id

		]);



		if (!empty($_FILES['image']['name'])) {



			$path = $_FILES['image']['name'];

			$ext = pathinfo($path, PATHINFO_EXTENSION);

			$this->uploadlib->initialize([

				'file_name' => $id.'.'.$ext

			]);

			$image = $this->uploadlib->uploadImage('image', '/users');



			if($image['status']){

				$this->company_model->update($id, ['img_type' => $ext]);

			}else{

				copy(FCPATH.'uploads/users/default.png', 'uploads/users/'.$id.'.png');

			}



		}else{



			copy(FCPATH.'uploads/users/default.png', 'uploads/users/'.$id.'.png');



		}



		$this->activity_model->add('New User $'.$id.' Created by User:'.logged('name'), logged('id'));



		$this->session->set_flashdata('alert-type', 'success');

		$this->session->set_flashdata('alert', 'New User Created Successfully');

		

		redirect('company');



	}



	public function view($id)

	{

		$this->page_data['User'] = $this->company_model->getById($id);

		$this->page_data['User']->role = $this->roles_model->getByWhere([

			'id'=> $this->page_data['User']->role

		])[0];

		$this->page_data['User']->activity = $this->activity_model->getByWhere([

			'user'=> $id

		], [ 'order' => ['id', 'desc'] ]);

		$this->load->view('company/view', $this->page_data);



	}



	public function edit($id)

	{	



		$this->page_data['User'] = $this->company_model->getById($id);

		$this->load->view('company/edit', $this->page_data);



	}





	public function update($id)

	{		

		postAllowed();


		$data = [

			'role' => post('role'),

			'name' => post('name'),

			'username' => post('username'),

			'email' => post('email'),

			'phone' => post('phone'),

			'address' => post('address'),

		];



		$password = post('password');



		if(logged('id')!=$id)

			$data['status'] = post('status')==1;



		if(!empty($password))

			$data['password'] = hash( "sha256", $password );



		$id = $this->company_model->update($id, $data);



		if (!empty($_FILES['image']['name'])) {



			$path = $_FILES['image']['name'];

			$ext = pathinfo($path, PATHINFO_EXTENSION);

			$this->uploadlib->initialize([

				'file_name' => $id.'.'.$ext

			]);

			$image = $this->uploadlib->uploadImage('image', '/users');



			if($image['status']){

				$this->company_model->update($id, ['img_type' => $ext]);

			}



		}



		$this->activity_model->add("User #$id Updated by User:".logged('name'));



		$this->session->set_flashdata('alert-type', 'success');

		$this->session->set_flashdata('alert', 'Client Profile has been Updated Successfully');

		

		redirect('company');



	}



	public function check()

	{

		$email = !empty(get('email')) ? get('email') : false;

		$username = !empty(get('username')) ? get('username') : false;

		$notId = !empty($this->input->get('notId')) ? $this->input->get('notId') : 0;



		if($email)

			$exists = count($this->company_model->getByWhere([

					'email' => $email,

					'id !=' => $notId,

				])) > 0 ? true : false;



		if($username)

			$exists = count($this->company_model->getByWhere([

					'username' => $username,

					'id !=' => $notId,

				])) > 0 ? true : false;



		echo $exists ? 'false' : 'true';

	}



	public function delete($id)

	{

		if($id!==1 && $id!=logged($id)){ }else{

			redirect('/','refresh');

			return;

		}



		$id = $this->company_model->delete($id);



		$this->activity_model->add("User #$id Deleted by User:".logged('name'));



		$this->session->set_flashdata('alert-type', 'success');

		$this->session->set_flashdata('alert', 'User has been Deleted Successfully');

		

		redirect('company');



	}



	public function change_status($id)

	{

		$this->company_model->update($id, ['status' => get('status') == 'true' ? 1 : 0 ]);

		echo 'done';

	}



}



/* End of file Comapny.php */

/* Location: ./application/controllers/Users.php */