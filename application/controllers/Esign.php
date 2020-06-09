<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('max_input_vars', 30000);

class Esign extends MY_Controller {

	public function index()
	{
		$this->page_data['users'] = $this->users_model->getUser(logged('id'));
		$this->load->view('esign/esign', $this->page_data);
	}


	public function blank() {

		$get = $this->input->get();
		$this->page_data['page_name'] = $get['page'];
		$this->load->view('blank', $this->page_data);
	}

	public function saveSign(){
		$data = $_POST;
		// print_r($data['base64']);die();
		// list($type, $data) = explode(';', $data);
		// list(, $data)      = explode(',', $data);
		// $data = base64_decode($data);
		$id = logged('id');
		// $name = rand().'.png';
		// if ($name) {
			// $user_data = $this->users_model->getUser($id);
			// unlink('./uploads/signatures/'.$user_data->esignImage);
			// file_put_contents('./uploads/signatures/'.$name, $data);
			$this->users_model->update($id, ['esignImage' => $data['base64']]);
		// }
		redirect('esign');
	}

	public function esignMain(){
		$this->page_data['users'] = $this->users_model->getUser(logged('id'));
		$this->load->view('esignMain/esignMain', $this->page_data);
	}
}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */