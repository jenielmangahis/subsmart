<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Appointment_Types extends MY_Controller {

	public function __construct()
	{

		parent::__construct();
		$this->checkLogin();
        $this->hasAccessModule(4); 

		$this->load->model('AppointmentType_model');
		$this->load->helper(array('form', 'url', 'hashids_helper'));
		$this->load->library('session');

		$this->page_data['page']->title = 'Appointment Types';
		$this->page_data['page']->menu = 'appointment_types';
	}

	public function index()
	{

		$user_id = logged('id');        
        $company_id = logged('company_id');

		$appointmentTypes = $this->AppointmentType_model->getAllByCompany($company_id);

		$this->page_data['appointmentTypes'] = $appointmentTypes;
		$this->load->view('appointment_types/index', $this->page_data);
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
}



/* End of file Appointment_Types.php */

/* Location: ./application/controllers/Appointment_Types.php */
