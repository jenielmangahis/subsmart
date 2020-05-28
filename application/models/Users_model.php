<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Users_model extends MY_Model {



	public $table = 'users';

    /**
     * @return mixed
     */
    public function getAll()
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id !=', 1);
        $query = $this->db->get();

        return $query->result();
    }


    /**
     * @param $data
     * @return bool|string
     */
	public function attempt($data)

	{

		$this->db->where('username', $data['username']);

		$this->db->or_where('email', $data['username']);



		$query = $this->db->get($this->table);



		// validate user

		if(!empty($query) && $query->num_rows() > 0){
			// checks the password

			if($query->row()->password == hash( "sha256", $data['password'] )){



				if ($query->row()->status==='1')

					return 'valid'; // if valid password and username and allowed

				else

					return 'not_allowed';



			}

			else

				return 'invalid_password'; // if invalid password



		}



		return false;



	}

	public function getUsers() {

		/*$parent_id = getLoggedUserID();
		//$cid=logged('comp_id');

		$cid=logged('company_id');

		$this->db->select('*');
		$this->db->from($this->table);
		//$this->db->where('parent_id', $parent_id);
		$this->db->where('parent_id', $parent_id);
		$this->db->or_where('id', $parent_id);
		$this->db->or_where('company_id',$cid );
		// $this->db->where('role !=', 1);
		$query = $this->db->get();
		// echo $this->db->last_query(); die;
		return $query->result();*/

		// edited using the new column names
		$parent_id = getLoggedUserID();
		$cid=logged('company_id');

		$this->db->select('*');
		$this->db->from($this->table);
		//$this->db->where('parent_id', $parent_id);
		$this->db->where('id', $parent_id);
		$this->db->or_where('company_id',$cid );
		$query = $this->db->get();

		return $query->result();

	}


	public function getUser($user_id) {

		$parent_id = getLoggedUserID();
		$cid=logged('company_id');

		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('id', $user_id);
		// $this->db->where('role !=', 1);
		$query = $this->db->get();
		// echo $this->db->last_query(); die;
		return $query->row();
	}

	public function countAllUsers() {

		$parent_id = getLoggedUserID();

		$this->db->select('COUNT(id) as totalUsers');
		$this->db->from($this->table);
		//$this->db->where('parent_id', $parent_id);
		$this->db->where('company_id', $parent_id);
		$query = $this->db->get()->row();	

		return $query->totalUsers;

	}

	public function login($row, $remember = false)

	{

		$time = time();

		// encypting userid and password with current time $time

		$login_token = sha1($row->id.$row->password.$time);

		if($remember===false){

			$array = [

				'login' => true,

				// saving encrypted userid and password as token in session

				'login_token' => $login_token,

				'logged' => [

					'id' => $row->id,

					'time' => $time,

				]

			];

			$this->session->set_userdata( $array );

		}else{



			$data = [

				'id' => $row->id,

				'time' => time(),

			];

			$expiry = strtotime('+7 days');

			set_cookie( 'login', true, $expiry );

			set_cookie( 'logged', json_encode($data), $expiry );

			set_cookie( 'login_token', $login_token, $expiry );



		}



		$this->update($row->id, [

			'last_login' => date('Y-m-d H:m:i')

		]);



		$this->activity_model->add($row->FName.' ('.$row->username.') Logged in', $row->id);



	}



	public function logout()

	{

		// Deleting Sessions

		$this->session->unset_userdata('login');

		$this->session->unset_userdata('logged');

		// Deleting Cookie

		delete_cookie('login');

		delete_cookie('logged');

		delete_cookie('login_token');

	}

	



	public function resetPassword($data)

	{
		$this->db->where('username', $data['username']);
		$this->db->or_where('email', $data['username']);

		$user = $this->db->get_where($this->table)->row();

		if(!empty($user)){ }else{
			return 'invalid';
		}



		$reset_token	=	password_hash((time().$user->id), PASSWORD_BCRYPT);

		$this->db->where('id', $user->id);
		$this->db->update($this->table, compact('reset_token'));


		$this->email->from(setting('company_email'), setting('company_name') );
		$this->email->to($user->email);

		$this->email->subject('Reset Your Account Password | ' . setting('company_name') );
		$reset_link = url('login/new_password?token='.$reset_token);



		$data = getEmailShortCodes();

		$data['user_id'] = $user->id;

		$data['user_name'] = $user->name;

		$data['user_email'] = $user->email;

		$data['user_username'] = $user->username;

		$data['reset_link'] = $reset_link;



		$html = $this->parser->parse('templates/email/reset', $data, true);



		$this->email->message( $html );



		$this->email->send();



		return $user->email;



	}

	public function getAllUsersByCompany($user_id=0, $loggedUserId=0) {

		$this->db->select('*');
		$this->db->from($this->table);
		//$this->db->where('parent_id', $user_id);
		$this->db->where('company_id', $user_id);

		if($loggedUserId) {

			$this->db->where('id !=', $loggedUserId);
		}

		$query = $this->db->get();			
		return $query->result();
	}



}



/* End of file Users_model.php */

/* Location: ./application/models/Users_model.php */