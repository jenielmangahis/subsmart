<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Appointment_Types extends MY_Controller {

	public function __construct()
	{

		parent::__construct();
		$this->checkLogin();
		$this->hasAccessModule(4); 

		$this->load->model('AppointmentType_model');
		$this->load->helper(array('form', 'url', 'hashids_helper', 'functions'));
		$this->load->library('session');

		$this->page_data['page']->title = 'Appointment Types';
		$this->page_data['page']->menu = 'appointment_types';
		$this->page_data['page']->parent = 'Calendar';
	}

	public function index()
	{

		if(!checkRoleCanAccessModule('calendar-appointment-types', 'read')){
			show403Error();
			return false;
		}    

		$company_id = logged('company_id');
		$appointmentTypes = $this->AppointmentType_model->getAllByCompany($company_id, true);

		$this->page_data['appointmentTypes'] = $appointmentTypes;
		$this->load->view('v2/pages/appointment_types/index', $this->page_data);
	}

	public function add_new_type(){

		$this->load->view('appointment_types/add_new', $this->page_data);
	}

	public function create_appointment_type()
	{

	$user_id = logged('id');
	$post    = $this->input->post();

	if( $post['appointment_type_name'] != '' ){
		$data_appointment_type = [        		
	        'company_id' => logged('company_id'),
			'name' => $post['appointment_type_name'],
			'created' => date("Y-m-d H:i:s")
		];

		$appointmentType = $this->AppointmentType_model->create($data_appointment_type);
		if( $appointmentType > 0 ){

			$this->session->set_flashdata('message', 'Add new appointment type was successful');
			$this->session->set_flashdata('alert_class', 'alert-success');

			redirect('appointment_types/index');

		}else{
			$this->session->set_flashdata('message', 'Cannot save data.');
			$this->session->set_flashdata('alert_class', 'alert-danger');

			redirect('appointment_types/index');
		}

	}else{
		$this->session->set_flashdata('message', 'Please specify name');
		$this->session->set_flashdata('alert_class', 'alert-danger');

		redirect('appointment_types/index');        	
	}
	}

	public function edit_type( $appointment_type_id )
	{

		$company_id      = logged('company_id');
	$appointmentType = $this->AppointmentType_model->getByIdAndCompanyId($appointment_type_id, $company_id);
	if( $appointmentType ){
		$this->page_data['appointmentType'] = $appointmentType;
			$this->load->view('appointment_types/edit', $this->page_data);
	}else{
		$this->session->set_flashdata('message', 'Cannot find data');
		$this->session->set_flashdata('alert_class', 'alert-danger');
		redirect('appointment_types/index');   
	}
	}

	public function update_appointment_type()
	{
		$post       = $this->input->post();
		$company_id = logged('company_id');
	if( $post['appointment_type_name'] != '' ){

		$appointmentType = $this->AppointmentType_model->getByIdAndCompanyId($post['aid'], $company_id);
		if( $appointmentType ){
			$data = [
				'name' => $post['appointment_type_name']        			
			];

			$this->AppointmentType_model->update($post['aid'], $data);

			$this->session->set_flashdata('message', 'Color setting was successful updated');
			$this->session->set_flashdata('alert_class', 'alert-success');

			redirect('appointment_types/index');

		}else{
			$this->session->set_flashdata('message', 'Record not found.');
			$this->session->set_flashdata('alert_class', 'alert-danger');

			redirect('appointment_types/index');
		}

	}else{
		$this->session->set_flashdata('message', 'Please specify name');
		$this->session->set_flashdata('alert_class', 'alert-danger');

		redirect('appointment_types/edit/'.$post['aid']);

	}
	}

	public function delete_appointment_type()
	{
		$post       = $this->input->post();
		$company_id = logged('company_id');
		$appointmentType = $this->AppointmentType_model->getByIdAndCompanyId($post['aid'], $company_id);

		if( $appointmentType ){
			$this->AppointmentType_model->delete($post['aid']);
			$this->session->set_flashdata('message', 'Appointment Type has been Deleted Successfully');
			$this->session->set_flashdata('alert_class', 'alert-success');
		}else{
			$this->session->set_flashdata('message', 'Record not found.');
			$this->session->set_flashdata('alert_class', 'alert-danger');

			
		}

		redirect('appointment_types/index');
	}

	public function ajax_create_appointment_type()
	{
		$this->load->model('AppointmentType_model');

		$is_success = 0;
		$msg = 'Cannot save data';

        $post       = $this->input->post();
        $company_id = logged('company_id');

        if( $post['appointment_type_name'] != '' ){
			$isExists = $this->AppointmentType_model->getByNameAndCompanyId($post['appointment_type_name'], $company_id);
			if( $isExists ){
				$msg = 'Appointment type ' . $post['appointment_type_name'] . ' already exists';
			}else{
				$data_appointment_type = [        		
					'company_id' => $company_id,
					'name' => $post['appointment_type_name'],
					'created' => date("Y-m-d H:i:s")
				];
	
				$this->AppointmentType_model->create($data_appointment_type);	

				//Activity Logs
				$activity_name = 'Appointment Types : Created new appointment type ' . $post['appointment_type_name']; 
				createActivityLog($activity_name);
	
				$is_success = 1;
				$msg = '';
			}
        	
        }else{
			$msg = 'Please enter appointment type name';
		}
        
        $json_data  = ['is_success' => $is_success, 'msg' => $msg];

        echo json_encode($json_data);
	}

	public function ajax_update_appointment_type()
	{
		$this->load->model('AppointmentType_model');

		$is_success = 0;
		$msg  = 'Cannot save data';

		$company_id = logged('company_id');
        $post       = $this->input->post();
        $appointmentType = $this->AppointmentType_model->getById($post['appointment_type_id']);		
        if( $appointmentType && $appointmentType->company_id == $company_id ){
			$isExists = $this->AppointmentType_model->getByNameAndCompanyId($post['appointment_type_name'], $company_id);
			if( $isExists && $isExists->id != $appointmentType->id ){
				$msg = 'Appointment type ' . $post['appointment_type_name'] . ' already exists';
			}else{
				$data_appointment_type = [    
					'name' => $post['appointment_type_name']
				];

				$this->AppointmentType_model->update($appointmentType->id, $data_appointment_type);	

				//Activity Logs
				$activity_name = 'Appointment Types : Updated appointment type ' . $appointmentType->name; 
				createActivityLog($activity_name);

				$is_success = 1;
				$msg = '';
			}
        }else{
        	$msg = 'Cannot find data';
        }
        
        
        $json_data  = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($json_data);
	}

	public function ajax_delete_appointment_type()
	{
		$this->load->model('AppointmentType_model');

		$is_success = 0;
		$msg  = 'Cannot find data';

		$post       = $this->input->post();
		$company_id = logged('company_id');
		$appointmentType = $this->AppointmentType_model->getByIdAndCompanyId($post['aid'], $company_id);

		if( $appointmentType ){
			$this->AppointmentType_model->delete($post['aid']);

			//Activity Logs
			$activity_name = 'Appointment Types : Deleted appointment type ' . $appointmentType->name; 
			createActivityLog($activity_name);

			$is_success = 1;
			$msg = '';
		}

		$json_data = ['is_success' => $is_success, 'msg' => $msg];
		echo json_encode($json_data);
	}
}



/* End of file Appointment_Types.php */

/* Location: ./application/controllers/Appointment_Types.php */
