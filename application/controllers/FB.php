<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FB extends MY_Controller {
	public function __construct(){
        parent::__construct();
        add_css(array(
			'assets/fb/css/accordion.min.css',
			'assets/fb/css/loading.css',
			'assets/fb/css/main.css',
			'assets/fb/css/custom-themes/styles.css',
			'assets/fb/css/datepicker.css',
        ));
        add_footer_js(array(
			'assets/fb/js/pipes.js',
			'assets/fb/js/jquery.qrcode.js',
			'assets/fb/js/qrcode.js',
			'assets/fb/js/accordion.min.js',
			'assets/fb/js/datepicker.js',
			'assets/fb/js/loading.js',
			'assets/fb/js/main.js',
		));
		$this->page_data['page']->title = 'nSmart - Front End About Us';

		$this->load->library('form_validation');
		$this->load->model('FB_model', 'form_builder');
		$this->load->model('FB_elements_model', 'form_elements');
		$this->load->model('FB_folders_model', 'form_folders');

	}

	public function index(){
		add_footer_js(array(
			'assets/fb/js/folder/move_folder_modal.js',
			'assets/fb/js/form_delete_modal.js',
			'assets/fb/js/index.js',
		));
		$this->load->view('fb/folder/move_folder_modal.php', $this->page_data);
		$this->load->view('fb/form_delete_modal.php', $this->page_data);
		$this->load->view('fb/index.php', $this->page_data);
	}
	
	public function getByActiveUser() {
		$user = (object)$this->session->userdata('logged');
		$data = $this->input->get();
		// $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($data));
		$response = $this->form_builder->getByUserID($user->id, $data);
		$this->output->set_status_header($response['code'])->set_content_type('application/json')->set_output(json_encode($response));
	}

	public function getTemplatesByActiveUser() {
		$user = (object)$this->session->userdata('logged');
		$data = $this->input->get();
		// $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($data));
		$response = $this->form_builder->getByUserID($user->id, $data);
		$this->output->set_status_header($response['code'])->set_content_type('application/json')->set_output(json_encode($response));
	}

	public function getFoldersByActiveUser() {
		$user = (object)$this->session->userdata('logged');
		$response = $this->form_folders->getByUserID($user->id);
		$this->output->set_status_header($response['code'])->set_content_type('application/json')->set_output(json_encode($response));
	}
    
    public function add(){
		add_footer_js(array(
			'assets/fb/js/add.js',
		));
		$this->load->view('fb/add_form_modal.php', $this->page_data);
		$this->load->view('fb/add.php', $this->page_data);
	}

	public function create() {
		$this->form_validation->set_rules('name', 'Name', 'required');
		$user = (object)$this->session->userdata('logged');
		$data = [
			'name' 		=> $this->input->post('name'),
			'user_id'	=> $user->id
		];

		$response = $this->form_builder->create($data);

		$this->output->set_status_header($response['code'])->set_content_type('application/json')->set_output(json_encode($response));
	}

	public function edit($id){
		add_css(array(
			'assets/fb/css/edit.css',
			'assets/terms_and_conditions/css/kothing-editor.min.css',
			'assets/terms_and_conditions/css/main.css',
			'assets/fb/css/form-color-pallete.css'
		));
		add_footer_js(array(
			'assets/terms_and_conditions/js/common.js',
			'assets/fb/js/jquery-sortable.js',
			'assets/fb/js/jquery-ui.js',
			'assets/fb/js/copy_from_form.js',
			'assets/terms_and_conditions/js/katex.min.js',
			'assets/terms_and_conditions/js/kothing-editor.min.js',			
			'assets/fb/js/edit.js',
			'assets/fb/js/builder.js',
		));
		$this->page_data['form_id'] = $id;
		$elements = $this->form_elements->getFormElements($id);
		$this->page_data['form_elements'] = $elements['data'];
		$this->load->view('fb/element_settings_modal.php', $this->page_data);
		$this->load->view('fb/copy_from_form_modal.php', $this->page_data);
		$this->load->view('fb/edit.php', $this->page_data);
		$this->load->view('fb/form_elements.php', $this->page_data);
	}

	public function rules($id){
		add_css(array(
			'assets/fb/css/edit.css',
			'assets/terms_and_conditions/css/kothing-editor.min.css',
			'assets/terms_and_conditions/css/main.css'
		));
		add_footer_js(array(
			'assets/terms_and_conditions/js/common.js',
			'assets/fb/js/jquery-sortable.js',
			'assets/fb/js/jquery-ui.js',
			'assets/terms_and_conditions/js/katex.min.js',
			'assets/terms_and_conditions/js/kothing-editor.min.js',			
			'assets/fb/js/edit.js',
			'assets/fb/js/builder.js',
		));
		$this->page_data['form_id'] = $id;
		$this->load->view('fb/element_settings_modal.php', $this->page_data);
		$this->load->view('fb/rules.php', $this->page_data);
		$this->load->view('fb/form_elements.php', $this->page_data);
	}

	public function settings($id){
		add_css(array(
			'assets/fb/css/settings.css',
			'assets/terms_and_conditions/css/main.css'
		));
		add_footer_js(array(
			'assets/terms_and_conditions/js/common.js',
			'assets/fb/js/jquery-sortable.js',
			'assets/fb/js/jquery-ui.js',
			'assets/fb/js/settings.js',
		));
		$this->page_data['form_id'] = $id;
		$this->load->view('fb/settings.php', $this->page_data);
		$this->load->view('fb/form_elements.php', $this->page_data);
	}

	public function share($id){
		add_css(array(
			'assets/fb/css/share.css',
		));
		add_footer_js(array(
			'assets/fb/js/share.js',
		));
		$this->page_data['form_id'] = $id;
		$this->load->view('fb/share.php', $this->page_data);
		$this->load->view('fb/form_elements.php', $this->page_data);
	}

	public function view($id){
		// add_css(array(
		// 	'assets/fb/css/edit.css',
		// ));
		// add_footer_js(array(
		// 	'assets/fb/js/view.js',
		// ));
		$this->page_data['form_id'] = $id;
		$this->load->view('fb/view.php', $this->page_data);
		$this->load->view('fb/form_elements.php', $this->page_data);
	}

	public function getByFormID($id) {
		$response = $this->form_builder->getByFormID($id);
		$this->output->set_status_header($response['code'])->set_content_type('application/json')->set_output(json_encode($response));
	}

	public function createFormElement() {
		$data = $this->input->post();
		// $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($data));
		$response = $this->form_elements->create($data);
		$this->output->set_status_header($response['code'])->set_content_type('application/json')->set_output(json_encode($response));
	}

	public function updateOrder() {
		$data = $this->input->post('elements');

		$response = $this->form_elements->updateOrder($data);

		$this->output->set_status_header($response['code'])->set_content_type('application/json')->set_output(json_encode($response));
	}

	public function destroyElement($id) {
		$response = $this->form_elements->destroyElement($id);

		$this->output->set_status_header($response['code'])->set_content_type('application/json')->set_output(json_encode($response));
	}

	public function updateElement($id) {
		$data = $this->input->post();
		$response = $this->form_elements->update($data, $id);
		$this->output->set_status_header($response['code'])->set_content_type('application/json')->set_output(json_encode($response));
	}

	public function update($id) {
		$data = $this->input->post();

		$response = $this->form_builder->update($data, $id);

		$this->output->set_status_header($response['code'])->set_content_type('application/json')->set_output(json_encode($response));
	}

	public function foldersIndex() {
		add_footer_js(array(
			'assets/fb/js/folder/index.js',
		));
		$this->load->view('fb/folder/folder_delete_modal.php', $this->page_data);
		$this->load->view('fb/folder/index.php', $this->page_data);
	}

	public function updateFolder($id) {
		$data = $this->input->post();

		$response = $this->form_folders->update($data, $id);

		$this->output->set_status_header($response['code'])->set_content_type('application/json')->set_output(json_encode($response));		
	}

	public function createFolder() {
		$data = $this->input->post();
		$user = (object)$this->session->userdata('logged');
		$data['user_id'] = $user->id;
		$response = $this->form_folders->create($data);

		$this->output->set_status_header($response['code'])->set_content_type('application/json')->set_output(json_encode($response));		
	}

	public function destroyFolder($id) {
		$response = $this->form_folders->destroy($id);
		$this->output->set_status_header($response['code'])->set_content_type('application/json')->set_output(json_encode($response));
	}
}