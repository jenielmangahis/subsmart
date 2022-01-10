<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->checkLogin();
		$this->page_data['page']->title = 'Profile Management';
		$this->page_data['page']->menu = false;

		add_css(array(
            'assets/css/accounting/sales.css',
        ));
	}

	public function index($tab = 'profile')
	{
		$user = $this->users_model->getById(logged('id'));
		$this->page_data['user'] = $user;
		$this->page_data['user']->role = $this->roles_model->getById( logged('role') );
		$this->page_data['activeTab'] = $tab;
		
		add_css([
            'assets/css/esign/fill-and-sign/fill-and-sign.css',
		]);

		add_footer_js([
			'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js',
			'https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.5.3/signature_pad.min.js',
			'assets/js/esign/fill-and-sign/step2.js',
            'assets/js/profile/signature.js',
        ]);

		$this->load->view('account/profile', $this->page_data);
	}

	public function updateProfile()
	{

		$id = logged('id');
		
		postAllowed();

		$data = [
			'role' => post('role'),
			'FName' => post('FName'),
			'LName' => post('LName'),
			'username' => post('username'),
			'email' => post('email'),
			'phone' => post('contact'),
			'address' => post('address'),
		];

		$id = $this->users_model->update($id, $data);

		$this->activity_model->add("User #$id updated the profile");

		$this->session->set_flashdata('alert-type', 'success');
		$this->session->set_flashdata('alert', 'Profile has been Updated Successfully');
		
		redirect('profile/index/edit');

	}

	public function updatePassword()
	{

		$id = logged('id');
		
		postAllowed();

		if ( post('password') !== post('password_confirm') ) {
			$this->session->set_flashdata('alert-type', 'danger');
			$this->session->set_flashdata('alert', 'Password does not matches with Confirm Password !');
			redirect('profile/index/change_password');
		}
		
		if ( strlen(post('password')) < 6 ) {
			$this->session->set_flashdata('alert-type', 'danger');
			$this->session->set_flashdata('alert', 'Password must have atleast 6 Characters');
			redirect('profile/index/change_password');
		}

		if ( hash('sha256', post('old_password')) != $this->users_model->getRowById($id, 'password') ) {
			$this->session->set_flashdata('alert-type', 'danger');
			$this->session->set_flashdata('alert', 'Invalid Old Password !');
			redirect('profile/index/change_password');
		}


		$password = post('password');

		$data['password'] = hash( "sha256", $password );

		$id = $this->users_model->update($id, $data);

		$this->activity_model->add("User #$id changed the password !");

		$this->session->set_flashdata('message_type', 'success');
		$this->session->set_flashdata('message', 'Password Changed, You need to Login Again !');
		
		redirect('login');

	}

	public function updateProfilePic()
	{

		$id = logged('id');
		
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

			$this->activity_model->add("User #$id Updated Company Profile Image.");

			$this->session->set_flashdata('alert-type', 'success');
			$this->session->set_flashdata('alert', 'Company Profile Image has been Updated Successfully');

		}
		else{

			$this->session->set_flashdata('alert-type', 'danger');
			$this->session->set_flashdata('alert', 'Server Error Occured while Uploading Image !');

		}

		redirect('profile/index/change_pic');

	}			
	public function updateUserProfilePic()	{	
		$this->load->model('Users_model');
			
		$id = logged('id');				
		if (!empty($_FILES['file']['name'])) {
			$config = array(
                'upload_path' => './uploads/users/user-profile/',
                'allowed_types' => '*',
                'overwrite' => TRUE,
                'max_size' => '20000',
                'max_height' => '0',
                'max_width' => '0',
                'encrypt_name' => true
            );
            $config = $this->uploadlib->initialize($config);
            $this->load->library('upload',$config);
            if ($result = $this->upload->do_upload("file")){
                $uploadData = $this->upload->data();
                $data = array(
                    'profile_image'=> $uploadData['file_name'],
                    'date_created' => time()
                );
                $query = $this->users_model->addProfilePhoto($data);
                $return = new stdClass();
                $return->photo = $uploadData['file_name'];
                $return->id = $query;

                $user_id = $id;
		        $profile_img = $uploadData['file_name'];

		        $user = $this->Users_model->getUser($user_id);

		        if( $profile_img == '' ){
		        	$profile_img = $user->profile_img;
		        }
		        $data = array(            
					'profile_img' => $profile_img
		        );

		        $user = $this->Users_model->update($user_id,$data);

            }

			$this->activity_model->add("User #$id Updated his/her Profile Image updated.");			
			$this->session->set_flashdata('alert-type', 'success');			
			$this->session->set_flashdata('alert', 'Profile Image has been Updated Successfully');		
		}else{			
			$this->session->set_flashdata('alert-type', 'danger');			
			$this->session->set_flashdata('alert', 'Server Error Occured while Uploading Image !');		
		}		
		redirect('profile/index/change_profile_pic');	}

	
	public function createOrUpdateSignature() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false]);
            return;
        }

        $payload = json_decode(file_get_contents('php://input'), true);
        $payload['user_id'] = logged('id');
        $payload['updated_at'] = date('Y-m-d H:i:s');
        $isCreated = false;

        $this->db->where('user_id', $payload['user_id']);
        $record = $this->db->get('user_signatures')->row();

        if (is_null($record)) {
            $isCreated = true;
            $this->db->insert('user_signatures', $payload);
        } else {
            $this->db->where('id', $record->id);
            $this->db->update('user_signatures', $payload);
        }

        $id = $isCreated ? $this->db->insert_id() : $record->id;
        $this->db->where('id', $id);
        $record = $this->db->get('user_signatures')->row();

        header('content-type: application/json');
        echo json_encode(['data' => $record, 'is_created' => $isCreated]);
    }

	public function getUserSignature()
	{
		$this->db->where('user_id', logged('id'));
        $record = $this->db->get('user_signatures')->row();
        echo json_encode(['data' => $record]);
	}
}

/* End of file Profile.php */
/* Location: ./application/controllers/Profile.php */