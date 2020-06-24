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
		$profiledata = $this->business_model->getByWhere(array('id'=>$user->id));		
		$this->page_data['profiledata'] = $profiledata[0];
		$this->load->view('businessprofile', $this->page_data);
	}
	
	public function businessview()
	{	
		//ifPermissions('businessdetail');
		$user = (object)$this->session->userdata('logged');		
		//print_r($user);die;
		$cid=logged('id');
		$profiledata = $this->business_model->getByWhere(array('id'=>$cid));		
		$this->page_data['profiledata'] = $profiledata[0];
		$this->load->view('business', $this->page_data);

	}
	public function businessdetail(){	
		//ifPermissions('businessdetail');
		
		$user = (object)$this->session->userdata('logged');
		$cid=logged('id');
		$profiledata = $this->business_model->getByWhere(array('id'=>$cid));	
		//dd($profiledata);die;
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
		//ifPermissions('users_list');

		$this->page_data['users1']= $this->users_model->getById(getLoggedUserID());
		
		$this->page_data['users'] = $this->users_model->getUsers();
		
		$this->page_data['timesheet_users'] = $this->timesheet_model->getClockIns();
		
		//$this->load->view('users/timesheet', $this->page_data);
		//$this->load->view('users/timesheet-admin', $this->page_data);
		$this->load->view('users/timesheet-user', $this->page_data);
	}

	// added for tracking Timesheet of employees
	public function timesheet_user()
	{	
		$this->load->model('timesheet_model');
		//ifPermissions('users_list');

		$this->page_data['users1']= $this->users_model->getById(getLoggedUserID());
		
		$this->page_data['users'] = $this->users_model->getUsers();
		
		$this->page_data['timesheet_users'] = $this->timesheet_model->getClockIns();
		
		//$this->load->view('users/timesheet', $this->page_data);
		$this->load->view('users/timesheet-user', $this->page_data);
	}

	public function add_timesheet_entry()
	{
		//ifPermissions('users_add');
		$this->load->view('users/add_timesheet_entry', $this->page_data);
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

		//ifPermissions('users_list');


		$this->page_data['users1']= $this->users_model->getById(getLoggedUserID());
		
		$this->page_data['users'] = $this->users_model->getUsers();

		// echo '<pre>';print_r($this->page_data);die;

		$this->load->view('users/list', $this->page_data);

	}



	public function add()

	{

		//ifPermissions('users_add');

		$this->load->view('users/add', $this->page_data);

	}



	public function save(){
		ifPermissions('users_add');
		postAllowed();
		$user = (object)$this->session->userdata('logged');	
		$cid=logged('company_id');		
		$id = $this->users_model->create([
			'role' => post('role'),
			'FName' => post('FName'),
			'LName' => post('LName'),
			'username' => post('username'),
			'email' => post('email'),
			
			'company_id' => $cid,
			
			'status' => (int) post('status'),
			'password_plain' =>  post('password'),
			'password' => hash( "sha256", post('password') ),			
			//'parent_id' => $user->id
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



		$this->activity_model->add('New User $'.$id.' Created by User:'.logged('FName'), logged('id'));
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

		$cid=logged('company_id');

		$data = [

			'role' => post('role'),

			'FName' => post('FName'),
			'LName' => post('LName'),

			'username' => post('username'),

			'email' => post('email'),

			'phone' => post('phone'),
			'company_id' => $cid,
			

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



		$this->activity_model->add("User #$id Updated by User:".logged('FName'));



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
			'company_id' => $this->input->post('clockin_company_id'),
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
			'company_id' => $this->input->post('clockin_company_id'),
			'clock_out' => $this->input->post('current_time_in'),
			'session_key' => $this->input->post('clockin_sess'),
			'status' => $this->input->post('clockin_status')*/
		);

		$this->timesheet_model->clockOut($data);

	}

	public function manual_clock_in()
	{
		$this->load->model('timesheet_model');
		//$data = $this->input->post();
		//dd($data);die;
		$data = array(
			'employees_id' => $this->input->post('clockin_user_id'),
			'action' => 'Clock In',
			'entry_type' => $this->input->post('entry_type'),
			'timestamp' => $this->input->post('entry_date'),
			'clock_in_from' => $this->input->post('clock_in_from'),
			'clock_in_to' => $this->input->post('clock_in_to'),
			'break_from' => $this->input->post('break_from'),
			'break_to' => $this->input->post('break_to'),
			'job_code' => $this->input->post('job_code'),
			'notes' => $this->input->post('notes')
		);
		//dd($data);die;
		$this->timesheet_model->manualClockIn($data);

		/*$this->load->model('timesheet_model');
		$data = array(
			'employees_id' => $this->input->post('clockin_user_id'),
			'action' => 'Clock In',
			'timestamp' => $this->input->post('current_time_in'),
			'entry_type' => 'Manual'
		);

		$this->timesheet_model->checkClockIn($data);*/

		$this->session->set_flashdata('alert-type', 'success');
		$this->session->set_flashdata('alert', 'New User Created Successfully');	

		redirect('users/timesheet');

	}

	public function update_clockin($id){
		$this->load->model('timesheet_model');

		//$this->timesheet_model->updateClockin($id, ['clockin' => get('clockIn') == 'true' ? 1 : 0 ]);

		//echo 'done';

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