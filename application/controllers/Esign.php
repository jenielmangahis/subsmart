<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('max_input_vars', 30000);

class Esign extends MY_Controller {

	public function index()
	{
		$this->load->model('Users_sign_model', 'Users_sign_model');
		$this->page_data['users'] = $this->Users_sign_model->getUser(logged('id'));

		$parent_id = getLoggedUserID();
		$cid=logged('company_id');
		$user_id = logged('id');
		$this->db->select('*');
		$this->db->from($this->Users_sign_model->table);
		$this->db->where('user_id', $user_id);
		$query = $this->db->get();
		$this->page_data['users_sign'] = $query->row();
		$this->load->view('esign/esign', $this->page_data);
	}


	public function blank() {
		$get = $this->input->get();
		$this->page_data['page_name'] = $get['page'];
		$this->load->view('blank', $this->page_data);
	}

	public function saveSign(){
		echo json_encode($_POST);
		$data = $_POST;
		$id = logged('id');
		$this->load->model('Users_sign_model', 'Users_sign_model');

		if(empty($this->Users_sign_model->fetch($id)))
		{
			$id = $this->Users_sign_model->create([
				'user_id' => $id,
				'esignImage' => $data['base64']
			]);
		} else {
			// $id = $this->Users_sign_model->where("user_id" , $id)->update([
			// 	'user_id' => $id,
			// 	'esignImage' => $data['base64']
			// ]);
			$this->db->where('user_id', $id);
        	$this->db->update($this->Users_sign_model->table, [
				'user_id' => $id,
				'esignImage' => $data['base64']
			]);
		}

		redirect('esign');
	}

	public function esignMain(){
		$this->page_data['users'] = $this->users_model->getUser(logged('id'));
		$this->load->view('esignMain/esignMain', $this->page_data);
	}

	public function Photos(){
		$this->load->model('User_docphoto_model', 'User_docphoto_model');
		$this->page_data['users'] = $this->User_docphoto_model->getUser(logged('id'));
		
		$this->load->view('esign/photos', $this->page_data);
	}

	public function Files(){
		$this->load->model('User_docflies_model', 'User_docflies_model');
		$this->page_data['users'] = $this->users_model->getUser(logged('id'));
		$this->page_data['file_id'] = $this->input->get('id');
		$this->page_data['next_step'] = ($this->input->get('next_step') == '')?0:$this->input->get('next_step');
		$this->load->view('esign/files', $this->page_data);
	}


	public function recipients() {
		if(isset($_POST['recipients']) && count($_POST['recipients'])>0 ) {
			foreach($_POST['recipients'] as $key => $value) {
				$id = $this->db->insert('user_docfile_recipients',[
					'user_id' => logged('id'),
					'docfile_id' => $_POST['file_id'],
					'name' => $value,
					'email' => $_POST['email'][$key],
				]);
			}
			redirect('esign/Files?id='.$id.'&next_step=4');
		}
	}

	public function photoSave(){
		$this->load->model('User_docphoto_model', 'User_docphoto_model');
		$id = logged('id');

		// $extension = pathinfo($_FILES["docphoto"]["name"], PATHINFO_EXTENSION);
		// print_r($extension);die();
		// $extension	 = strtolower(end(explode('.',$_FILES['docPhoto']['name'])));
		// print_r($extension);die();
		//$filename = time()."_".rand(1,9999999)."_"."DocPhoto"."."."jpg";
		//$location = "./uploads/DocPhoto/".$filename;
		//move_uploaded_file($_FILES['docPhoto']['name'], $location);
		$tmp_name = $_FILES['docPhoto']['tmp_name'];
        // basename() may prevent filesystem traversal attacks;
        // further validation/sanitation of the filename may be appropriate
        $name = time()."_".rand(1,9999999)."_".basename($_FILES["docPhoto"]["name"]);
		move_uploaded_file($tmp_name, "./uploads/DocPhoto/$name");
		
		// $config['upload_path']          = $_SERVER['DOCUMENT_ROOT'] .'/nsmartrac/uploads/DocPhoto/';
		// $config['allowed_types']        = 'gif|jpg|png|jpeg';
		// $config['max_size'] = 2000;
		// $config['max_width'] = 1500;
		// $config['max_height'] = 1500;
		// $config['encrypt_name'] = TRUE;
		// $config['file_name'] = $filename;
		// $config['overwrite'] = false;
		// print_r("<pre>");
		// $this->load->library('upload', $config);

		// if (!$this->upload->do_upload('docPhoto')) {
		// 	$error = array('error' => $this->upload->display_errors());
		// 	print_r($error);
		// } else {
		// 	// $data = array('docPhoto' => $this->upload->data());
		// }

		$id = $this->User_docphoto_model->create([
			'user_id' => $id,
			'docphoto' => $name
		]);
		
		// print_r("expression");
		redirect('esign/Photos');
	}

	public function fileSave(){
		$this->load->model('User_docflies_model', 'User_docflies_model');
		//$id = logged('id');
		
		// $extension	 = strtolower(end(explode('.',$_FILES['docFile']['name'])));
		// $filename = time()."_".rand(1,9999999)."_"."DocFiles".".".$extension;
		// $location = "../../uploads/DocFiles";
		// echo move_uploaded_file($filename, $location);

		if(isset($_FILES['docFile']) && $_FILES['docFile']['tmp_name'] != '') {
				
			$tmp_name = $_FILES['docFile']['tmp_name'];
			// basename() may prevent filesystem traversal attacks;
			// further validation/sanitation of the filename may be appropriate
			$name = time()."_".rand(1,9999999)."_".basename($_FILES["docFile"]["name"]);
			move_uploaded_file($tmp_name, "./uploads/DocFiles/$name");
			$id = 0;
			


			if($_POST['file_id'] > 0)
			{
				$this->db->where('id', $_POST['file_id']);
				$this->db->update($this->User_docflies_model->table, [
					'docFile' => $name
				]);
					
				$id = $_POST['file_id'];
			} else {
				
				$id = $this->User_docflies_model->create([
					'user_id' => logged('id'),
					'docFile' => $name
				]);
			}

		

			if(isset($_POST['next_step']) && $_POST['next_step'] == 0)
			{
			  redirect('esign/Files?id='.$id);
			}
			if(isset($_POST['next_step']) && $_POST['next_step'] == 1)
			{
				
				 redirect('esign/Files?id='.$id.'&next_step=2');
			}
		} else if(isset($_POST['file_id']) && $_POST['file_id'] > 0) {

			
			if(isset($_POST['next_step']) && $_POST['next_step'] == 0)
			{
				redirect('esign/Files?id='.$_POST['file_id']);
			}
			if(isset($_POST['next_step']) && $_POST['next_step'] == 1)
			{
				redirect('esign/Files?id='.$_POST['file_id'].'&next_step=2');
			}
		}	
	}
}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */