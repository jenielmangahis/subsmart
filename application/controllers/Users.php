<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Users extends MY_Controller {



	public function __construct()

	{

		parent::__construct();

		$this->page_data['page']->title = 'Users Management';

		$this->page_data['page']->menu = 'users';

	}



	public function businessprofile()
	{	
		$user = (object)$this->session->userdata('logged');		
		$profiledata = $this->business_model->getByWhere(array('user_id'=>$user->id));		
		$this->page_data['profiledata'] = $profiledata[0];
		$this->load->view('businessprofile', $this->page_data);
	}
	
	public function businessview()
	{	
		ifPermissions('businessdetail');
		$user = (object)$this->session->userdata('logged');		
		$cid=logged('comp_id');
		$profiledata = $this->business_model->getByWhere(array('id'=>$cid));		
		$this->page_data['profiledata'] = $profiledata[0];
		$this->load->view('business', $this->page_data);

	}
	public function businessdetail(){	
		ifPermissions('businessdetail');
		
		$user = (object)$this->session->userdata('logged');
		$cid=logged('comp_id');
		$profiledata = $this->business_model->getByWhere(array('id'=>$cid));	
		
		$this->page_data['userid'] = $user->id;
		$this->page_data['profiledata'] = $profiledata[0];
		
		/* echo "<pre>"; print_r($this->page_data); die;  */
		
		$this->load->view('businessdetail', $this->page_data);
	}
	
	public function savebusinessdetail(){
		
		$user = (object)$this->session->userdata('logged');	
		/* echo "<pre>"; print_r($_POST); die; */
		$pdata=$_POST;
		unset($pdata['btn-continue']);
		$bid=$pdata['id'];
		
		if($bid!=''){
			$this->business_model->update($bid,$pdata);
			$imbid=$pdata['user_id'];
		}else{
			$pdata['user_id'] = $user->id;
			$imbid=$user->id;
			$bid = $this->business_model->create($pdata);
		}


		if (!empty($_FILES['image']['name'])){

			$path = $_FILES['image']['name'];
			$ext = pathinfo($path, PATHINFO_EXTENSION);
			$this->uploadlib->initialize([
				'file_name' => 'businessimg_'.$imbid.'.'.$ext
			]);
			
			$image = $this->uploadlib->uploadImage('image', '/users');

			if($image['status']){
				$this->business_model->update($bid, ['b_image' => $ext]);
			}else{
				copy(FCPATH.'uploads/users/default.png', 'uploads/users/businessimg_'.$user->id.'.png');
			}
		}else{
			copy(FCPATH.'uploads/users/default.png', 'uploads/users/businessimg_'.$user->id.'.png');
		}

		// $this->activity_model->add('New User $'.$id.' Created by User:'.logged('name'), logged('id'));
		$this->session->set_flashdata('alert-type', 'success');
		$this->session->set_flashdata('alert', 'Business detail updated Successfully');	

		redirect('users/businessview');
	}

	// added for tracking Timesheet of employees
	public function timesheet()
	{	
		$this->load->model('timesheet_model');
		ifPermissions('users_list');

		$this->page_data['users1']= $this->users_model->getById(getLoggedUserID());
		
		$this->page_data['users'] = $this->users_model->getUsers();
		
		$this->page_data['timesheet_users'] = $this->timesheet_model->getClockIns();
		
		$this->load->view('users/timesheet', $this->page_data);

	}

	public function tracklocation()
	{	
		ifPermissions('users_list');

		$this->page_data['users1']= $this->users_model->getById(getLoggedUserID());
		
		$this->page_data['users'] = $this->users_model->getUsers();
			
		
		$this->load->view('users/tracklocation', $this->page_data);

	}
	
	public function index()

	{	

		ifPermissions('users_list');

		$this->page_data['users1']= $this->users_model->getById(getLoggedUserID());
		
		$this->page_data['users'] = $this->users_model->getUsers();

		// echo '<pre>';print_r($this->page_data);die;

		$this->load->view('users/list', $this->page_data);

	}



	public function add()

	{

		ifPermissions('users_add');

		$this->load->view('users/add', $this->page_data);

	}



	public function save(){
		ifPermissions('users_add');
		postAllowed();
		$user = (object)$this->session->userdata('logged');	
		$cid=logged('comp_id');		
		$id = $this->users_model->create([
			'role' => post('role'),
			'name' => post('name'),
			'username' => post('username'),
			'email' => post('email'),
			'phone' => post('phone'),
			'comp_id' => $cid,
			'address' => post('address'),
			'status' => (int) post('status'),
			'password_plain' =>  post('password'),
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
				$this->users_model->update($id, ['img_type' => $ext]);
			}else{
				copy(FCPATH.'uploads/users/default.png', 'uploads/users/'.$id.'.png');
			}
		}else{
			copy(FCPATH.'uploads/users/default.png', 'uploads/users/'.$id.'.png');
		}



		$this->activity_model->add('New User $'.$id.' Created by User:'.logged('name'), logged('id'));
		$this->session->set_flashdata('alert-type', 'success');
		$this->session->set_flashdata('alert', 'New User Created Successfully');	

		redirect('users');
	}



	public function view($id)

	{



		ifPermissions('users_view');



		$this->page_data['User'] = $this->users_model->getById($id);

		$this->page_data['User']->role = $this->roles_model->getByWhere([

			'id'=> $this->page_data['User']->role

		])[0];

		$this->page_data['User']->activity = $this->activity_model->getByWhere([

			'user'=> $id

		], [ 'order' => ['id', 'desc'] ]);

		$this->load->view('users/view', $this->page_data);



	}



	public function edit($id)

	{



		ifPermissions('users_edit');



		$this->page_data['User'] = $this->users_model->getById($id);

		$this->load->view('users/edit', $this->page_data);



	}





	public function update($id)

	{



		ifPermissions('users_edit');

		

		postAllowed();

		$cid=logged('comp_id');

		$data = [

			'role' => post('role'),

			'name' => post('name'),

			'username' => post('username'),

			'email' => post('email'),

			'phone' => post('phone'),
			'comp_id' => $cid,
			

			'address' => post('address'),

		];



		$password = post('password');



		if(logged('id')!=$id)

			$data['status'] = post('status')==1;



		if(!empty($password)){

			$data['password_plain'] = $password;
			$data['password'] = hash( "sha256", $password );
		}


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

	// timesheet 
	public function clock_in()
	{
		print_r($this->input->post());
		$this->load->model('timesheet_model');
		$data = array(
			'employees_id' => $this->input->post('clockin_user_id'),
			'action' => 'Clock In',
			'timestamp' => $this->input->post('current_time_in'),
			'entry_type' => 'Normal'
			/*'user_id' => $this->input->post('clockin_user_id'),
			'comp_id' => $this->input->post('clockin_comp_id'),
			'clock_in' => $this->input->post('current_time_in'),
			'session_key' => $this->input->post('clockin_sess'),
			'status' => $this->input->post('clockin_status')*/
		);



		$this->timesheet_model->clockIn($data);

	}
	public function clock_out()
	{
		$this->load->model('timesheet_model');
		$data = array(
			'employees_id' => $this->input->post('clockin_user_id'),
			'action' => 'Clock Out',
			'timestamp' => $this->input->post('current_time_in'),
			'entry_type' => 'Normal'
			/*'user_id' => $this->input->post('clockin_user_id'),
			'comp_id' => $this->input->post('clockin_comp_id'),
			'clock_out' => $this->input->post('current_time_in'),
			'session_key' => $this->input->post('clockin_sess'),
			'status' => $this->input->post('clockin_status')*/
		);

		$this->timesheet_model->clockOut($data);

	}

	public function getClockIn(){
		$this->load->model('timesheet_model');
		$data = array(
			'user_id' => $this->input->post('clockin_user_id'),
			'session_key' => $this->input->post('clockin_sess'),
		);

		$this->timesheet_model->checkClockIn($data);
	}

	public function change_status($id)

	{

		$this->users_model->update($id, ['status' => get('status') == 'true' ? 1 : 0 ]);

		echo 'done';

	}


	public function ajax_user_dropdown() {

		$users = $this->users_model->getUsers();
		// print_r($users);

		echo $this->load->view('users/ajax_user_dropdown', array('users' => $users), true);
	}


	public function json_dropdown_user_list() {

		$users = $this->users_model->getUsers();
		// print_r($users);

		die(json_encode($users));
	}
}



/* End of file Users.php */

/* Location: ./application/controllers/Users.php */