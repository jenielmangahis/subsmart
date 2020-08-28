<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->checkLogin(1);
		$this->page_data['page']->title = 'nSmart';
	}

	public function index(){	
		$this->page_data['business'] = getIndustryBusiness();
		$this->page_data['roles']    = getRegistrationRoles();
		$this->load->view('home', $this->page_data);
	}

	public function signup(){
		$this->load->view('signup', $this->page_data);
	}

	public function save(){

		$id = $this->users_model->create([
			'role' => post('role'),
			'FName' => post('FName'),
			'LName' => post('LName'),
			'username' => post('username'),
			'email' => post('email'),
			'phone' => post('phone'),
			'address' => post('address'),
			'status' => (int) post('status'),
			'password_plain' => post('password'),
			'password' => hash( "sha256", post('password') )		
			
		]);

		$business_id = $this->business_model->create([
			'user_id' => $id,
			'b_name' => post('name'),
			'address' => post('address'),
			'b_phone' => post('phone'),
			'b_email' => post('email')
		]);
	
		$this->users_model->update($id, ['company_id' => $business_id]);

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
	
	    /* print_r($this->db->last_query()); */

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
			'FName' => post('FName'),
			'LName' => post('LName'),
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

		$this->activity_model->add("User #$id Updated by User:".logged('username'));
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
		$this->activity_model->add("User #$id Deleted by User:".logged('username'));
		$this->session->set_flashdata('alert-type', 'success');
		$this->session->set_flashdata('alert', 'User has been Deleted Successfully');
		redirect('users');
	}

	public function change_status($id)
	{
		$this->users_model->update($id, ['status' => get('status') == 'true' ? 1 : 0 ]);
		echo 'done';
	}

	public function getSpecificBusinessByIndustry()
	{
		$post = $this->input->post();
		switch ($post['selected_industry']) {
			case 'Building Contractors':
				$business = [
					'Cabinetry' => 'Cabinetry',
					'Chimney / Fireplace' => 'Chimney / Fireplace',
					'Concrete & Asphalt' => 'Concrete & Asphalt',
					'Deck & Patio' => 'Deck & Patio',
					'Demolition' => 'Demolition',
					'Doors & Windows' => 'Doors & Windows',
					'Drywall' => 'Drywall',
					'Fencing' => 'Fencing',
					'Flooring' => 'Flooring',
					'Framer' => 'Framer',
					'General Contractor' => 'General Contractor',
					'Handy Man' => 'Handy Man',
					'Home Inspection' => 'Home Inspection',
					'HVAC' => 'HVAC',
					'Landscaper' => 'Landscaper',
					'Lawn Care' => 'Lawn Care',
					'Lighting' => 'Lighting',
					'Painter' => 'Painter',
					'Plumber' => 'Plumber',
					'Pool & Spa' => 'Pool & Spa',
					'Roofers' => 'Roofers',
					'Sewer & Septic' => 'Sewer & Septic',
					'Snow Removal' => 'Snow Removal',
					'Solar & Energy' => 'Solar & Energy',
					'Tile & Grout' => 'Tile & Grout',
					'Tree Services' => 'Tree Services'
				];
				break;
			case 'Financial Services':
				$business = [
					'Appraisal' => 'Appraisal',
					'Credit Counselor' => 'Credit Counselor',
					'Financial Planner' => 'Financial Planner',
					'Insurance' => 'Insurance',
					'Lender' => 'Lender',
					'Tax Planner' => 'Tax Planner'
				];
				break;
			case 'Technical Services':
				$business = [
					'Computer Services' => 'Computer Services',
					'Document Storage & Destruction' => 'Document Storage & Destruction',
					'IT & Networking' => 'IT & Networking',
					'Security Systems' => 'Security Systems'
				];
				break;
			case 'Health And Beauty':
				$business = [
					'Massage' => 'Massage',
					'Barber / Stylist' => 'Barber / Stylist',
					'Make-up artist' => 'Make-up artist',
					'Costume Designer' => 'Costume Designer',
					'Fitness Instructors' => 'Fitness Instructors'
				];				
				break;
			case 'Transportation':
				$business = [
					'Auto Repair' => 'Auto Repair',
					'Boat Repair' => 'Boat Repair',
					'Detailing' => 'Detailing',
					'Marine Services' => 'Marine Services',
					'Pilot for hire' => 'Pilot for hire',
					'Professional Driving' => 'Professional Driving',
					'Repossession' => 'Repossession',
					'Towing' => 'Towing'
				];
				break;
			case 'Organization / Cleaning':
				$business = [
					'Commercial cleaning' => 'Commercial cleaning',
					'Disaster recovery' => 'Disaster recovery',
					'Junk Removal' => 'Junk Removal',
					'Restoration' => 'Restoration',
					'Upholstery Cleaners' => 'Upholstery Cleaners'
				];
				break;
			case 'Entertainment Services':
				$business = [
					'A/V Service' => 'A/V Service',
					'Booking Agent' => 'Booking Agent',
					'Catering' => 'Catering',
					'Event Planner' => 'Event Planner',
					'Music & Singing' => 'Music & Singing',
					'Party Entertainer' => 'Party Entertainer'
				];
				break;
			case 'Design Services':
				$business = [
					'Interior Design' => 'Interior Design',
					'Architecture' => 'Architecture',
					'Event Photography / Videography' => 'Event Photography / Videography',
					'Graphics & Printing' => 'Graphics & Printing'
				];
				break;
			case 'Business Services':
				$business = [
					'Cabinetry' => 'Cabinetry',
					'Chimney / Fireplace' => 'Chimney / Fireplace',
					'Concrete & Asphalt' => 'Concrete & Asphalt',
					'Deck & Patio' => 'Deck & Patio',
					'Demolition' => 'Demolition',
					'Doors & Windows' => 'Doors & Windows',
					'Drywall' => 'Drywall',
					'Fencing' => 'Fencing',
					'Flooring' => 'Flooring',
					'Framer' => 'Framer',
					'General Contractor' => 'General Contractor',
					'Handy Man' => 'Handy Man',
					'Home Inspection' => 'Home Inspection',
					'HVAC' => 'HVAC',
					'Landscaper' => 'Landscaper',
					'Lawn Care' => 'Lawn Care',
					'Lighting' => 'Lighting',
					'Painter' => 'Painter',
					'Plumber' => 'Plumber',
					'Pool & Spa' => 'Pool & Spa',
					'Roofers' => 'Roofers',
					'Sewer & Septic' => 'Sewer & Septic',
					'Snow Removal' => 'Snow Removal',
					'Solar & Energy' => 'Solar & Energy',
					'Tile & Grout' => 'Tile & Grout',
					'Tree Services' => 'Tree Services'
				];
				break;
			case 'Other':
				$business = [
					'Environmental Services' => 'Environmental Services',
					'Locksmith' => 'Locksmith',
					'Movers' => 'Movers',
					'Multi level marketing' => 'Multi level marketing',
					'Pet Grooming' => 'Pet Grooming',
					'Private security' => 'Private security',
					'Property Manager' => 'Property Manager',
					'Real Estate' => 'Real Estate',
					'Sales' => 'Sales',
					'Tutoring' => 'Tutoring'
				];
				break;
			default:
				$business = [
					'Environmental Services' => 'Environmental Services',
					'Locksmith' => 'Locksmith',
					'Movers' => 'Movers',
					'Multi level marketing' => 'Multi level marketing',
					'Pet Grooming' => 'Pet Grooming',
					'Private security' => 'Private security',
					'Property Manager' => 'Property Manager',
					'Real Estate' => 'Real Estate',
					'Sales' => 'Sales',
					'Tutoring' => 'Tutoring'
				];
				break;
		}

		$this->page_data['business'] = $business;		
		$this->load->view('business_by_industry', $this->page_data);
	}

}

/* End of file Home.php */

/* Location: ./application/controllers/Home.php */