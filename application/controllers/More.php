<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class More extends MY_Controller {



	public function __construct()
	{

		parent::__construct();
		$this->checkLogin();
		$this->hasAccessModule(65); 
		$this->page_data['page']->title = 'More ';
		$this->page_data['page']->menu = 'more';
		$this->load->model('NsmartUpgrades_model');
		$this->load->model('SubscriberNsmartUpgrade_model');
		$cid  = logged('id');
		$profiledata = $this->business_model->getByWhere(array('user_id'=>$cid));
		$this->page_data['profiledata'] = ($profiledata) ? $profiledata[0] : null;
	}


	public function upgrades(){

        $this->page_data['page']->title = 'Add-On Plugins';
        $this->page_data['page']->parent = 'More';

		/*$is_allowed = $this->isAllowedModuleAccess(66);
        if( !$is_allowed ){
            $this->page_data['module'] = 'plan_builder';
            echo $this->load->view('no_access_module', $this->page_data, true);
            die();
        }*/

		$user = (object)$this->session->userdata('logged');
		$cid  = logged('company_id');

		// $this->load->view('more/upgrades', $this->page_data);
		$this->load->view('v2/pages/more/upgrades', $this->page_data);
	}

	public function ajax_load_addons_list(){
		$user = (object)$this->session->userdata('logged');
		$cid  = logged('company_id');

		$activeAddons   = $this->SubscriberNsmartUpgrade_model->getAllByClientId($cid);
		$NsmartUpgrades = $this->NsmartUpgrades_model->getAll();

		$active_addons_id = array();
		foreach($activeAddons as $a){
			$active_addons_id[$a->plan_upgrade_id] = $a->with_request_removal;
		}

		$this->page_data['active_addons_id'] = $active_addons_id;
		$this->page_data['NsmartUpgrades']   = $NsmartUpgrades;
		// $this->load->view('more/ajax_load_addons_list', $this->page_data);
		$this->load->view('v2/pages/more/ajax_load_addons_list', $this->page_data);
	}

	public function ajax_load_active_addons_list(){
		$user = (object)$this->session->userdata('logged');
		$cid  = logged('company_id');

		$activeAddons   = $this->SubscriberNsmartUpgrade_model->getAllByClientId($cid);
		$NsmartUpgrades = $this->NsmartUpgrades_model->getAll();

		$active_addons_id = array();
		foreach($activeAddons as $a){
			$active_addons_id[$a->plan_upgrade_id] = $a->plan_upgrade_id;
		}

		$this->page_data['active_addons_id'] = $active_addons_id;
		$this->page_data['NsmartUpgrades']   = $NsmartUpgrades;
		// $this->load->view('more/_load_active_addons_list', $this->page_data);
		$this->load->view('v2/pages/more/_load_active_addons_list', $this->page_data);
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
		// $this->load->view('more/ajax_load_plugin_details', $this->page_data);
		$this->load->view('v2/pages/more/ajax_load_plugin_details', $this->page_data);
	}

	public function add_plugin()
	{
		$post = $this->input->post();
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

	public function ajax_subscription_activate_addon()
	{
		$is_success = 0;
        $msg        = 'Addon not found';

		$cid  = logged('company_id');
		$post = $this->input->post();

		if( $post['plugin_id'] > 0 ){
			$upgrade = $this->SubscriberNsmartUpgrade_model->getByClientIdAndNsmartUpgradeId($cid, $post['plugin_id']);
			if( $upgrade ){
				$msg = 'Plugin already availed';
			}else{
				$data = [
	    			'client_id' => $cid,
	    			'plan_upgrade_id' => $post['plugin_id'],
					'with_request_removal' => 0,
	    			'date_created' => date("Y-m-d H:i:s"),
	    			'date_modified' => date("Y-m-d H:i:s")
	    		];

	    		$subscriberAddon = $this->SubscriberNsmartUpgrade_model->create($data);

				$is_success = 1;
				$msg = '';

				//Update session
				$addons = $this->SubscriberNsmartUpgrade_model->getAllByClientId($cid);
				$active_addons = array();
				foreach( $addons as $a ){
					$active_addons[$a->plan_upgrade_id] = $a->plan_upgrade_id;
				}
				$this->session->set_userdata('plan_active_addons', $active_addons);
			}
		}

		$return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
	}

	public function ajax_subscription_remove_addon()
	{
		$is_success = 0;
        $msg        = 'Addon not found';

		$cid  = logged('company_id');
		$post = $this->input->post();

		if( $post['plugin_id'] > 0 ){
			$upgrade = $this->SubscriberNsmartUpgrade_model->getByClientIdAndNsmartUpgradeId($cid, $post['plugin_id']);
			if( $upgrade ){
				$data = ['with_request_removal' => 1, 'date_modified' => date("Y-m-d H:i:s")];
				$this->SubscriberNsmartUpgrade_model->update($upgrade->id, $data);

				$is_success = 1;
				$msg = '';
			}
		}

		$return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
	}

	public function ajax_subscription_cancel_request_remove_addon()
	{
		$is_success = 0;
        $msg        = 'Addon not found';

		$cid  = logged('company_id');
		$post = $this->input->post();

		if( $post['plugin_id'] > 0 ){
			$upgrade = $this->SubscriberNsmartUpgrade_model->getByClientIdAndNsmartUpgradeId($cid, $post['plugin_id']);
			if( $upgrade ){
				$data = ['with_request_removal' => 0, 'date_modified' => date("Y-m-d H:i:s")];
				$this->SubscriberNsmartUpgrade_model->update($upgrade->id, $data);
				
				$is_success = 1;
				$msg = '';
			}
		}

		$return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
	}
}



/* End of file More.php */

/* Location: ./application/controllers/More.php */
