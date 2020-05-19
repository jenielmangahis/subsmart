<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Home extends MY_Controller {



	public function __construct(){
		parent::__construct();
		$this->page_data['page']->title = 'nSmart';
	}


	public function index(){	
		$this->load->view('home', $this->page_data);
	}


	public function signup(){
		$this->load->view('signup', $this->page_data);
	}



	public function save(){

		$id = $this->users_model->create([
			'role' => post('role'),
			'name' => post('name'),
			'username' => post('username'),
			'email' => post('email'),
			'phone' => post('phone'),
			'address' => post('address'),
			'status' => (int) post('status'),
			'password_plain' => post('password'),
			'password' => hash( "sha256", post('password') ),			
			'parent_id' => 1
		]);

	$business_id = $this->business_model->create([
		'user_id' => $id,
		'b_name' => post('name'),
		'address' => post('address'),
		'b_phone' => post('phone'),
		'b_email' => post('email')
	]);
	
	$this->users_model->update($id, ['comp_id' => $business_id]);

		if (!empty($_FILES['image']['name'])) {

			$path = $_FILES['image']['name'];
			$ext = pathinfo($path, PATHINFO_EXTENSION);
			$this->uploadlib->initialize([
				'file_name' => 'businessimg_'.$id.'.'.$ext
			]);

			$image = $this->uploadlib->uploadImage('image', '/users');

			if($image['status']){
				$this->business_model->update($business_id, ['b_image' => $ext]);
			}else{
				copy(FCPATH.'uploads/users/default.png', 'uploads/users/'.$id.'.png');
			}

		}else{
			copy(FCPATH.'uploads/users/default.png', 'uploads/users/'.$id.'.png');
		}


	
	/* print_r($this->db->last_query());     */



		// $this->activity_model->add('New User $'.$id.' Created by User:'.logged('name'), logged('id'));
		$this->session->set_flashdata('alert-type', 'success');
		$this->session->set_flashdata('alert', 'Account Created Successfully');		
		
		$this->session->set_flashdata('message_type', 'success');
		$this->session->set_flashdata('message', 'Account Created Successfully');		

		redirect('login');
	}





	public function update($id)	{

		ifPermissions('users_edit');
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



		$id = $this->users_model->update($id, $data);



		if (!empty($_FILES['image']['name'])) {



			$path = $_FILES['image']['name'];

			$ext = pathinfo($path, PATHINFO_EXTENSION);

			$this->uploadlib->initialize([

				'file_name' => $id.'.'.$ext

			]);

			$image = $this->uploadlib->uploadImage('image', '/users');



			if($image['status']){

				$this->users_model->update($id, ['img_type' => $ext]);

			}



		}



		$this->activity_model->add("User #$id Updated by User:".logged('name'));



		$this->session->set_flashdata('alert-type', 'success');

		$this->session->set_flashdata('alert', 'Client Profile has been Updated Successfully');

		

		redirect('users');



	}



	public function check()

	{

		$email = !empty(get('email')) ? get('email') : false;

		$username = !empty(get('username')) ? get('username') : false;

		$notId = !empty($this->input->get('notId')) ? $this->input->get('notId') : 0;



		if($email)

			$exists = count($this->users_model->getByWhere([

					'email' => $email,

					'id !=' => $notId,

				])) > 0 ? true : false;



		if($username)

			$exists = count($this->users_model->getByWhere([

					'username' => $username,

					'id !=' => $notId,

				])) > 0 ? true : false;



		echo $exists ? 'false' : 'true';

	}



	public function delete($id)

	{



		ifPermissions('users_delete');



		if($id!==1 && $id!=logged($id)){ }else{

			redirect('/','refresh');

			return;

		}



		$id = $this->users_model->delete($id);



		$this->activity_model->add("User #$id Deleted by User:".logged('name'));



		$this->session->set_flashdata('alert-type', 'success');

		$this->session->set_flashdata('alert', 'User has been Deleted Successfully');

		

		redirect('users');



	}



	public function change_status($id)

	{

		$this->users_model->update($id, ['status' => get('status') == 'true' ? 1 : 0 ]);

		echo 'done';

	}



}



/* End of file Users.php */

/* Location: ./application/controllers/Users.php */