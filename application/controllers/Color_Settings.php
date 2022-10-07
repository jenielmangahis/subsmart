<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Color_Settings extends MY_Controller {

	public function __construct(){

		parent::__construct();
		$this->checkLogin();
        $this->hasAccessModule(8);

		$this->load->model('ColorSettings_model');
		$this->load->helper(array('form', 'url', 'hashids_helper'));
		$this->load->library('session');

		$this->page_data['page']->title = 'Color Settings';
		$this->page_data['page']->menu = 'color_settings';
	}


	public function index(){
        $this->page_data['page']->title = 'Color Settings';
        $this->page_data['page']->parent = 'Calendar';

		$user_id = logged('id');
        $role_id = logged('role');
        
        $args = array('company_id' => logged('company_id'));
		$colorSettings = $this->ColorSettings_model->getByWhere($args);

		$this->page_data['colorSettings'] = $colorSettings;
		// $this->load->view('color_settings/index', $this->page_data);
		$this->load->view('v2/pages/color_settings/index', $this->page_data);
	}

	public function add_new_color_setting(){

		$this->load->view('v2/pages/color_settings/add_new', $this->page_data);
	}

	public function create_color_setting(){
		postAllowed();

        $user_id = logged('id');
        $post    = $this->input->post();

        if( $post['color_name'] != '' && $post['color_code'] != '' ){
        	$data_color_setting = [
        		'user_id' => $user_id,
                'company_id' => logged('company_id'),
        		'color_name' => $post['color_name'],
        		'color_code' => $post['color_code']
        	];

        	$colorSetting = $this->ColorSettings_model->create($data_color_setting);
        	if( $colorSetting > 0 ){

        		$this->session->set_flashdata('message', 'Add new color setting was successful');
        		$this->session->set_flashdata('alert_class', 'alert-success');

        		redirect('color_settings/index');

        	}else{
        		$this->session->set_flashdata('message', 'Cannot save data.');
        		$this->session->set_flashdata('alert_class', 'alert-danger');

        		redirect('color_settings/add_new_color');
        	}

        }else{
        	$this->session->set_flashdata('message', 'Please specify color name and code');
        	$this->session->set_flashdata('alert_class', 'alert-danger');

        	redirect('color_settings/add_new_color');

        }
	}

	public function edit_color_setting( $color_setting_id ){

        $colorSetting = $this->ColorSettings_model->getById($color_setting_id);

        $this->page_data['colorSetting'] = $colorSetting;
		$this->load->view('v2/pages/color_settings/edit', $this->page_data);
	}

	public function update_color_setting() {
		postAllowed();
		$post    = $this->input->post();

        if( $post['color_name'] != '' && $post['color_code'] != '' ){

        	$colorSetting = $this->ColorSettings_model->getById($post['cid']);
        	if( $colorSetting ){
        		$data_color_setting = [
        			'color_name' => $post['color_name'],
        			'color_code' => $post['color_code']
        		];

        		$this->ColorSettings_model->updateColorSettingById($post['cid'], $data_color_setting);

        		$this->session->set_flashdata('message', 'Color setting was successful updated');
        		$this->session->set_flashdata('alert_class', 'alert-success');

        		redirect('color_settings/index');

        	}else{
        		$this->session->set_flashdata('message', 'Record not found.');
        		$this->session->set_flashdata('alert_class', 'alert-danger');

        		redirect('color_settings/index');
        	}

        }else{
        	$this->session->set_flashdata('message', 'Please specify color name and code');
        	$this->session->set_flashdata('alert_class', 'alert-danger');

        	redirect('color_settings/edit_color_setting/'.$post['cid']);

        }
	}

	public function delete_color(){
		$id = $this->ColorSettings_model->deleteColorById(post('cid'));

		$this->session->set_flashdata('message', 'Color Setting has been Deleted Successfully');
		$this->session->set_flashdata('alert_class', 'alert-success');

		// redirect('color_settings/index');
		echo true;
	}


}



/* End of file Color_Settings.php */

/* Location: ./application/controllers/Color_Settings.php */
