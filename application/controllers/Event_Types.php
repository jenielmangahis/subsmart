<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Event_Types extends MY_Controller {

	public function __construct(){

		parent::__construct();
		$this->checkLogin();

		$this->load->model('EventType_model');
		$this->load->helper(array('form', 'url', 'hashids_helper'));
		$this->load->library('session');

		$this->page_data['page']->title = 'Event Types';
		$this->page_data['page']->menu = 'event_types';		
	}


	public function index(){			
		$user_id = logged('id');
        $role_id = logged('role');
        $company_id = logged('company_id');
        if( $role_id == 1 || $role_id == 2 ){
            $eventTypes = $this->EventType_model->getAll();
        }else{
            $eventTypes = $this->EventType_model->getAllByCompanyId($company_id);
        }

		$this->page_data['eventTypes'] = $eventTypes;
		$this->load->view('event_types/index', $this->page_data);
	}

    public function add_new_event_type(){
        $this->load->view('event_types/add_new', $this->page_data);
    }

    public function create_event_type(){
        postAllowed();

        $user_id = logged('id');
        $post    = $this->input->post();

        if( $post['event_type_name'] != ''){
            $data_event_type = [
                'user_id' => $user_id,
                'event_type_name' => $post['event_type_name'],
                'created' => date("Y-m-d H:i:s"),
                'modified' => date("Y-m-d H:i:s")
            ];

            $event_type_id = $this->EventType_model->create($data_event_type);
            if( $event_type_id > 0 ){

                $this->session->set_flashdata('message', 'Add new event type was successful');
                $this->session->set_flashdata('alert_class', 'alert-success');

                redirect('event_types/index');

            }else{
                $this->session->set_flashdata('message', 'Cannot save data.');
                $this->session->set_flashdata('alert_class', 'alert-danger');

                redirect('event_types/add_new');
            }

        }else{
            $this->session->set_flashdata('message', 'Please specify event type name');
            $this->session->set_flashdata('alert_class', 'alert-danger');

            redirect('event_types/add_new');

        }
    }

    public function edit_event_type( $event_type_id ){

        $eventType = $this->EventType_model->getById($event_type_id);

        $this->page_data['eventType'] = $eventType;
        $this->load->view('event_types/edit', $this->page_data);
    }

    public function update_event_type() {
        postAllowed();
        $post    = $this->input->post();

        if( $post['event_type_name'] != '' ){

            $eventType = $this->EventType_model->getById($post['eid']);
            if( $eventType ){
                $data_event_type = [
                    'event_type_name' => $post['event_type_name'],
                    'modified' => date("Y-m-d H:i:s")
                ];

                $this->EventType_model->updateEventTypeById($post['eid'], $data_event_type);

                $this->session->set_flashdata('message', 'Event Type was successful updated');
                $this->session->set_flashdata('alert_class', 'alert-success');

                redirect('event_types/index');

            }else{
                $this->session->set_flashdata('message', 'Record not found.');
                $this->session->set_flashdata('alert_class', 'alert-danger');

                redirect('event_types/index');
            }

        }else{
            $this->session->set_flashdata('message', 'Please specify event type name');
            $this->session->set_flashdata('alert_class', 'alert-danger');

            redirect('event_types/edit/'.$post['eid']);

        }
    }   

	public function delete_event_type(){
		$id = $this->EventType_model->deleteById(post('cid'));

		$this->session->set_flashdata('message', 'Event Type has been Deleted Successfully');
		$this->session->set_flashdata('alert_class', 'alert-success');

		redirect('event_types/index');
	}
}



/* End of file Color_Settings.php */

/* Location: ./application/controllers/Color_Settings.php */