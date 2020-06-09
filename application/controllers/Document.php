<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Document extends MY_Controller {



	public function __construct()

	{

		parent::__construct();

		$this->page_data['page']->title = 'Company Management';

		$this->page_data['page']->menu = 'companies';	

		$user_id = getLoggedUserID();
		
		$this->load->model('Document_model', 'document_model');

		// if($user_id != 1) {

		// 	redirect('/');
		// }

	}

	public function index()
	{
		$this->page_data['documents'] = $this->document_model->getAllDocuments();
		$this->load->view('document/list', $this->page_data);
	}



	public function add()
	{		
		$this->load->view('document/add', $this->page_data);
	}



	public function save()
	{	

		$user_id = getLoggedUserID();
		postAllowed();

		$user = (object)$this->session->userdata('logged');

		$id = $this->document_model->create([
			'name' => post('name'),
			'user_id' => $user_id,
		]);



		if (!empty($_FILES['image']['name'])) {

			$path = $_FILES['image']['name'];

			$ext = pathinfo($path, PATHINFO_EXTENSION);

			$this->uploadlib->initialize([

				'file_name' => $id.'.'.$ext

			]);

			$image = $this->uploadlib->uploadImage('image', '/documents');



			if($image['status']){

				$this->document_model->update($id, ['img_type' => $ext, 'file' =>$id.'.'.$ext ]);

			}else{

				copy(FCPATH.'uploads/users/default.png', 'uploads/users/'.$id.'.png');

			}



		}else{



			copy(FCPATH.'uploads/users/default.png', 'uploads/users/'.$id.'.png');



		}



		// $this->activity_model->add('New User $'.$id.' Created by User:'.logged('name'), logged('id'));



		// $this->session->set_flashdata('alert-type', 'success');

		// $this->session->set_flashdata('alert', 'New User Created Successfully');

		

		redirect('document');



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

		$data = [
			'name' => post('name'),
			'user_id' => $user_id,
		];

		$id = $this->document_model->update($id, $data);



		if (!empty($_FILES['image']['name'])) {



			$path = $_FILES['image']['name'];

			$ext = pathinfo($path, PATHINFO_EXTENSION);

			$this->uploadlib->initialize([

				'file_name' => $id.'.'.$ext

			]);

			$image = $this->uploadlib->uploadImage('image', '/users');



			if($image['status']){

				$this->document_model->update($id, ['img_type' => $ext]);

			}



		}



		$this->activity_model->add("User #$id Updated by User:".logged('name'));



		$this->session->set_flashdata('alert-type', 'success');

		$this->session->set_flashdata('alert', 'Client Profile has been Updated Successfully');

		redirect('document');



	}

	public function delete($id)
	{
		$this->db->where('id', $id);
    	$this->db->delete('documents');
		$this->activity_model->add("Document #$id Deleted by Document:");
		$this->session->set_flashdata('alert-type', 'success');
		$this->session->set_flashdata('alert', 'Document has been Deleted Successfully');
		redirect('document');
	}

}



/* End of file Comapny.php */

/* Location: ./application/controllers/Users.php */