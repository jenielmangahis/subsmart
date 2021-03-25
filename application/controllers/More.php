<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class More extends MY_Controller {



	public function __construct()
	{

		parent::__construct();
		$this->checkLogin();
		$this->page_data['page']->title = 'More ';
		$this->page_data['page']->menu = 'more';
		$this->load->model('NsmartUpgrades_model');
		$this->load->model('SubscriberNsmartUpgrade_model');
		$cid  = logged('id');
		$profiledata = $this->business_model->getByWhere(array('user_id'=>$cid));
		$this->page_data['profiledata'] = ($profiledata) ? $profiledata[0] : null;
	}


	public function upgrades(){

		$is_allowed = $this->isAllowedModuleAccess(66);
        if( !$is_allowed ){
            $this->page_data['module'] = 'plan_builder';
            echo $this->load->view('no_access_module', $this->page_data, true);
            die();
        }

		$user = (object)$this->session->userdata('logged');
		$cid  = logged('company_id');

		$NsmartUpgrades = $this->NsmartUpgrades_model->getAll();
		$profiledata = $this->business_model->getByWhere(array('id'=>$cid));
		$this->page_data['NsmartUpgrades'] = $NsmartUpgrades;
		/*$this->page_data['userid'] = $user->id;
		$this->page_data['profiledata'] = $profiledata[0];*/

		$this->load->view('more/upgrades', $this->page_data);
	}

	public function addons(){

		$user = (object)$this->session->userdata('logged');
		$cid=logged('company_id');
		$profiledata = $this->business_model->getByWhere(array('id'=>$cid));

		/*$this->page_data['userid'] = $user->id;
		$this->page_data['profiledata'] = $profiledata[0];*/

		$this->load->view('more/addons', $this->page_data);
	}

	public function ajax_load_plugin_details(){
		$post = $this->input->post();
		$plugin = $this->NsmartUpgrades_model->getById($post['aid']);

		$this->page_data['plugin'] = $plugin;
		$this->load->view('more/ajax_load_plugin_details', $this->page_data);
	}

	public function add_plugin(){
		postAllowed();

		$post = $this->input->post();
		$user = $this->session->userdata('logged');
		$cid  = logged('company_id');

		if( $post['pid'] > 0 ){
			$upgrade = $this->SubscriberNsmartUpgrade_model->getByClientIdAndNsmartUpgradeId($cid, $post['pid']);
			if( $upgrade ){
				$this->session->set_flashdata('message', 'Plugin already availed');
        		$this->session->set_flashdata('alert_class', 'alert-danger');
			}else{
				$data = [
	    			'client_id' => $cid,
	    			'plan_upgrade_id' => $post['pid'],
	    			'date_created' => date("Y-m-d H:i:s"),
	    			'date_modified' => date("Y-m-d H:i:s")
	    		];

	    		$subscriberAddon = $this->SubscriberNsmartUpgrade_model->create($data);

	    		$this->session->set_flashdata('message', 'Plugin list was successfully updated');
	        	$this->session->set_flashdata('alert_class', 'alert-success');
			}
		}else{
			$this->session->set_flashdata('message', 'Plugin not found');
        	$this->session->set_flashdata('alert_class', 'alert-danger');
		}

		redirect('more/upgrades');
	}
}



/* End of file More.php */

/* Location: ./application/controllers/More.php */
