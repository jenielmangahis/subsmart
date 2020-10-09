<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nsmart_Addons extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->checkLogin();

		$this->page_data['page_title'] = 'Nsmart Addons';

		$this->load->helper(array('form', 'url', 'hashids_helper'));
		$this->load->library('session');

		$this->load->model('NsmartPlan_model');
		$this->load->model('NsmartAddons_model');
	}

	public function index() {
		$nSmartAddons   = $this->NsmartAddons_model->getAll();
		
		$this->page_data['nSmartAddons'] = $nSmartAddons;
		$this->load->view('nsmart_addons/index', $this->page_data);
	}

	public function add_new_addon() {
		$option_status = $this->NsmartPlan_model->getPlanStatus();

		$this->page_data['option_status'] = $option_status;
		$this->load->view('nsmart_addons/add_new_addon', $this->page_data);
	}

	public function create_addon() {
		postAllowed();

        $user = $this->session->userdata('logged');
        $post = $this->input->post();

        if( $post['addon_name'] != '' ){
        	if( $this->NsmartAddons_model->isAddonNameExists($post['addon_name']) ){
        		$this->session->set_flashdata('message', 'Addon name already exists');
        		$this->session->set_flashdata('alert_class', 'alert-danger');
        	}else{
        		$data = [
        			'name' => $post['addon_name'],
        			'description' => $post['description'],
        			'price' => $post['price'],
        			'status' => $post['status'],
        			'date_created' => date("Y-m-d H:i:s")
        		];

        		$nsPlan = $this->NsmartAddons_model->create($data);

        		$this->session->set_flashdata('message', 'Add new addon was successful');
        		$this->session->set_flashdata('alert_class', 'alert-success');
        	}
        }else{
        	$this->session->set_flashdata('message', 'Please enter addon name');
        	$this->session->set_flashdata('alert_class', 'alert-danger');
        }

        redirect('nsmart_addons/add_new_addon');
	}

	public function edit_addon($addon_id) {

		$nSmartAddon = $this->NsmartAddons_model->getById($addon_id);

		if( $nSmartAddon ){
			$option_status = $this->NsmartPlan_model->getPlanStatus();

			$this->page_data['nSmartAddon'] = $nSmartAddon;
			$this->page_data['option_status'] = $option_status;
			$this->load->view('nsmart_addons/edit_addon', $this->page_data);
		}else{
			$this->session->set_flashdata('message', 'Cannot find data');
        	$this->session->set_flashdata('alert_class', 'alert-danger');
        	redirect('nsmart_addons/index');
		}
	}

	public function update_addon() {
		postAllowed();

        $user = $this->session->userdata('logged');
        $post = $this->input->post();

        $nSmartAddon = $this->NsmartAddons_model->getById($post['addon_id']);

        if( $nSmartAddon ){
        	if( $post['addon_name'] != '' ){
	        	$data = [
        			'name' => $post['addon_name'],
        			'description' => $post['description'],
        			'price' => $post['price'],
        			'status' => $post['status'],
        			'date_updated' => date("Y-m-d H:i:s")
        		];
        		$nsAddon = $this->NsmartAddons_model->updateAddon($post['addon_id'],$data);

        		$this->session->set_flashdata('message', 'Addon was successfully updated');
        		$this->session->set_flashdata('alert_class', 'alert-success');
	        }else{
	        	$this->session->set_flashdata('message', 'Please enter addon name');
	        	$this->session->set_flashdata('alert_class', 'alert-danger');
	        }

	        redirect('nsmart_addons/edit_addon/'.$post['addon_id']);

        }else{
        	$this->session->set_flashdata('message', 'Cannot find data');
	        $this->session->set_flashdata('alert_class', 'alert-danger');

	        redirect('nsmart_addons/index');
        }
	}

	public function delete_addon()
    {
    	$post = $this->input->post();

    	$id = $this->NsmartAddons_model->deleteAddon(post('pid'));

		$this->session->set_flashdata('message', 'Addon has been Deleted Successfully');
		$this->session->set_flashdata('alert_class', 'alert-success');

		redirect('nsmart_addons/index');
    }
}

/* End of file Nsmart_Addons.php */
/* Location: ./application/controllers/Nsmart_Addons.php */
