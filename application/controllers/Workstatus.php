<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Workstatus extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->checkLogin();
		$this->hasAccessModule(30); 
		$cid  = logged('id');
		$profiledata = $this->business_model->getByWhere(array('user_id'=>$cid));
		$this->page_data['profiledata'] = ($profiledata) ? $profiledata[0] : null;
		$this->page_data['page']->title = 'Work status Management';
        $this->page_data['page']->menu = (!empty($this->uri->segment(2))) ? $this->uri->segment(2) : 'workstatus';
	}

	public function index()
	{
		$this->page_data['page']->title = 'Workorder Status';
        $this->page_data['page']->parent = 'Sales';

		// ifPermissions('plan_list');
		$is_allowed = $this->isAllowedModuleAccess(30);
        if( !$is_allowed ){
            $this->page_data['module'] = 'status';
            echo $this->load->view('no_access_module', $this->page_data, true);
            die();
        }

		$company_id = logged('company_id');
		$role_id    = logged('role');
		if( $role_id == 1 || $role_id == 2 ){
			$this->page_data['workstatus'] = $this->Workstatus_model->getByWhere([]);
		}else{
			$this->page_data['workstatus'] = $this->Workstatus_model->getByWhere(['company_id'=>$company_id]);
		}

		//$this->page_data['workstatus'] = array();
		$this->load->view('v2/pages/workstatus/list', $this->page_data);
	}

	public function add(){
		add_css(array(
            'assets/css/bootstrap-colorpicker.min.css'
        ));

        add_footer_js(array(
            'assets/js/bootstrap-colorpicker.min.js'
        ));

		$this->load->view('workstatus/add', $this->page_data);
	}


	public function edit($id){
		add_css(array(
            'assets/css/bootstrap-colorpicker.min.css'
        ));

        add_footer_js(array(
            'assets/js/bootstrap-colorpicker.min.js'
        ));

		$this->page_data['workstatus'] = $this->Workstatus_model->getById($id);
		$this->load->view('workstatus/edit', $this->page_data);
	}



	public function save(){

		postAllowed();

		$company_id =  logged('company_id');
		$permission = $this->Workstatus_model->create([
			'company_id' => $company_id,
			'title' => $this->input->post('title'),
			'color' => $this->input->post('color')
		]);

		$this->activity_model->add("New Workstatus #$permission Created by User: #".logged('id'));
		$this->session->set_flashdata('alert-type', 'success');
		$this->session->set_flashdata('alert', 'New Workstatus Created Successfully');

		redirect('workstatus');
	}



	public function update($id){

		postAllowed();

		$company_id =  logged('company_id');
		$data = [
			'company_id' => $company_id,
			'title' => $this->input->post('title'),
			'color' => $this->input->post('color')
		];



		$permission = $this->Workstatus_model->update($id, $data);
		$this->activity_model->add("Workstatus #$id Updated by User: #".logged('id'));

		$this->session->set_flashdata('alert-type', 'success');
		$this->session->set_flashdata('alert', 'Workstatus has been Updated Successfully');

		redirect('workstatus');
	}

	public function delete()
	{

		$post = $this->input->post();
		$company_id    =  logged('company_id');
        $workorderType = $this->Workstatus_model->getWorkStatusByIdAndCompanyId($post['wtid'], $company_id);
        if( $workorderType ){
        	$this->Workstatus_model->delete($post['wtid']);

        	$this->session->set_flashdata('message', 'Workstatus has been deleted successfully');
            $this->session->set_flashdata('alert_class', 'alert-success');
			$this->activity_model->add("Workstatus #$permission Deleted by User: #".logged('id'));
        }else{
        	$this->session->set_flashdata('message', 'Cannot find data.');
            $this->session->set_flashdata('alert_class', 'alert-danger');
        }
		
		
		redirect('workstatus');
	}

	public function ajax_save_workorder_type()
    {
        $is_success = 0;

        $post 		   = $this->input->post();
        $company_id    =  logged('company_id');
		$workorderType = $this->Workstatus_model->create([
			'company_id' => $company_id,
			'title' => $post['title'],
			'color' => $post['color']
		]);

        $is_success = 1;
        $json_data  = ['is_success' => $is_success];

        echo json_encode($json_data);
    }

    public function ajax_update_workorder_type()
    {
        $is_success = 0;

        $post 		   = $this->input->post();
        $company_id    =  logged('company_id');
        $workorderType = $this->Workstatus_model->getWorkStatusByIdAndCompanyId($post['wtid'], $company_id);
        if( $workorderType ){
			$data = [
				'title' => $post['title'],
				'color' => $post['color']
			];

			$this->Workstatus_model->update($workorderType->id, $data);

	        $is_success = 1;
        }
        
        $json_data  = ['is_success' => $is_success];

        echo json_encode($json_data);
    }

}



/* End of file items.php */

/* Location: ./application/controllers/items.php */
