<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nsmart_Upgrades extends MY_Controller {

	public function __construct() {
		parent::__construct();
		
		//$this->checkLogin();
		$role_id = 1; //this is for nsmart admin user
		$this->isCheckLoginAndRole($role_id);

		$this->page_data['page_title'] = 'Nsmart Addons';

		$this->load->helper(array('form', 'url', 'hashids_helper'));
		$this->load->library('session');

		$this->load->model('NsmartUpgrades_model');
	}

	public function index() {
		$nSmartUpgrades   = $this->NsmartUpgrades_model->getAll();
		
		$this->page_data['nSmartUpgrades'] = $nSmartUpgrades;
		$this->load->view('nsmart_upgrades/index', $this->page_data);
	}

	public function add_new_upgrade() {
		
		$this->load->view('nsmart_upgrades/add_new_upgrade', $this->page_data);
	}

	public function create_upgrade() {
		postAllowed();

        $user = $this->session->userdata('logged');
        $post = $this->input->post();

        if( $post['upgrade_name'] != '' ){
        	if( $this->NsmartUpgrades_model->isUpgradeNameExists($post['upgrade_name']) ){
        		$this->session->set_flashdata('message', 'Upgrade name already exists');
        		$this->session->set_flashdata('alert_class', 'alert-danger');
        	}else{
        		$data = [
        			'name' => $post['upgrade_name'],
        			'description' => $post['description'],
        			'sms_fee' => $post['sms_fee'],
        			'service_fee' => $post['service_fee'],
        			'status' => $post['status'],
        			'date_created' => date("Y-m-d H:i:s")
        		];

        		$nsPlan = $this->NsmartUpgrades_model->create($data);

        		$this->session->set_flashdata('message', 'Add new upgrade was successful');
        		$this->session->set_flashdata('alert_class', 'alert-success');
        	}
        }else{
        	$this->session->set_flashdata('message', 'Please enter upgrade name');
        	$this->session->set_flashdata('alert_class', 'alert-danger');
        }

        redirect('nsmart_upgrades/add_new_upgrade');
	}

	public function edit_upgrade($upgrade_id) {

		$nSmartUpgrades = $this->NsmartUpgrades_model->getById($upgrade_id);

		if( $nSmartUpgrades ){
			$this->page_data['nSmartUpgrades'] = $nSmartUpgrades;
			$this->load->view('nsmart_upgrades/edit_upgrade', $this->page_data);
		}else{
			$this->session->set_flashdata('message', 'Cannot find data');
        	$this->session->set_flashdata('alert_class', 'alert-danger');
        	redirect('nsmart_upgrades/index');
		}
	}

	public function update_upgrade() {
		postAllowed();

        $user = $this->session->userdata('logged');
        $post = $this->input->post();

        $NsmartUpgrades = $this->NsmartUpgrades_model->getById($post['upgrade_id']);

        if( $NsmartUpgrades ){
        	if( $post['upgrade_name'] != '' ){
	        	$data = [
        			'name' => $post['upgrade_name'],
        			'description' => $post['description'],
        			'sms_fee' => $post['sms_fee'],
        			'service_fee' => $post['service_fee'],
        			'status' => $post['status'],
        			'date_modified' => date("Y-m-d H:i:s")
        		];
        		$nsAddon = $this->NsmartUpgrades_model->updateUpgrade($post['upgrade_id'],$data);

        		$this->session->set_flashdata('message', 'Upgrade was successfully updated');
        		$this->session->set_flashdata('alert_class', 'alert-success');
	        }else{
	        	$this->session->set_flashdata('message', 'Please enter Upgrade name');
	        	$this->session->set_flashdata('alert_class', 'alert-danger');
	        }

	        redirect('nsmart_upgrades/edit_upgrade/'.$post['upgrade_id']);

        }else{
        	$this->session->set_flashdata('message', 'Cannot find data');
	        $this->session->set_flashdata('alert_class', 'alert-danger');

	        redirect('nsmart_upgrades/index');
        }
	}

	public function delete_upgrade()
    {
    	$post = $this->input->post();

    	$id = $this->NsmartUpgrades_model->deleteUpgrade(post('u_id'));

		$this->session->set_flashdata('message', 'Upgrade has been Deleted Successfully');
		$this->session->set_flashdata('alert_class', 'alert-success');

		redirect('nsmart_upgrades/index');
    }
}

/* End of file Nsmart_Upgrades.php */
/* Location: ./application/controllers/Nsmart_Upgrades.php */
