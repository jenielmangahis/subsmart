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
        $this->load->model('Icons_model');

        add_css(array(            
            'assets/css/hover.css'
        ));

        $icons = $this->Icons_model->getAll();

        $this->page_data['icons'] = $icons;
        $this->load->view('event_types/add_new', $this->page_data);
    }

    public function create_event_type(){
        postAllowed();

        $this->load->model('Icons_model');

        $user_id = logged('id');
        $company_id = logged('company_id');
        $post    = $this->input->post();

        if( $post['title'] != ''){
            if( isset($post['is_default_icon']) ){
                $icon = $this->Icons_model->getById($post['default_icon_id']);
                $marker_icon = $icon->image;
                $data_event_type = [
                    'company_id' => $company_id,
                    'user_id' => $user_id,
                    'title' => $post['title'],
                    'icon_marker' => $marker_icon,
                    'is_marker_icon_default_list' => 1,
                    'created' => date("Y-m-d H:i:s"),
                    'modified' => date("Y-m-d H:i:s")
                ];

                $event_type_id = $this->EventType_model->create($data_event_type);
                if( $event_type_id > 0 ){

                    $this->session->set_flashdata('message', 'Add new event type was successful');
                    $this->session->set_flashdata('alert_class', 'alert-success');

                    redirect('events/event_types');

                }else{
                    $this->session->set_flashdata('message', 'Cannot save data.');
                    $this->session->set_flashdata('alert_class', 'alert-danger');

                    redirect('event_types/add_new');
                }
            }else{
                if( !empty($_FILES['image']['name']) ){

                    $marker_icon = $this->moveUploadedFile();
                    $data_event_type = [
                        'company_id' => $company_id,
                        'user_id' => $user_id,
                        'title' => $post['title'],
                        'icon_marker' => $marker_icon,
                        'is_marker_icon_default_list' => 0,
                        'created' => date("Y-m-d H:i:s"),
                        'modified' => date("Y-m-d H:i:s")
                    ];

                    $event_type_id = $this->EventType_model->create($data_event_type);
                    if( $event_type_id > 0 ){

                        $this->session->set_flashdata('message', 'Add new event type was successful');
                        $this->session->set_flashdata('alert_class', 'alert-success');

                        redirect('events/event_types');

                    }else{
                        $this->session->set_flashdata('message', 'Cannot save data.');
                        $this->session->set_flashdata('alert_class', 'alert-danger');

                        redirect('event_types/add_new');
                    }
                }else{
                    $this->session->set_flashdata('message', 'Please specify event icon / marker image');
                    $this->session->set_flashdata('alert_class', 'alert-danger');

                    redirect('event_types/add_new');
                }
            }

            
        }else{
            $this->session->set_flashdata('message', 'Please specify event type name');
            $this->session->set_flashdata('alert_class', 'alert-danger');

            redirect('event_types/add_new');
        }
    }

    public function edit_event_type( $event_type_id ){
        $this->load->model('Icons_model');

        add_css(array(            
            'assets/css/hover.css'
        ));

        $eventType = $this->EventType_model->getById($event_type_id);
        $icons    = $this->Icons_model->getAll();

        $this->page_data['eventType'] = $eventType;
        $this->page_data['icons'] = $icons;
        $this->load->view('event_types/edit', $this->page_data);
    }

    public function update_event_type() {
        postAllowed();

        $this->load->model('Icons_model');

        $post    = $this->input->post();

        if( $post['title'] != '' ){

            $eventType = $this->EventType_model->getById($post['eid']);
            if( $eventType ){
                $marker_icon = $eventType->icon_marker;
                $is_marker_icon_default_list = $eventType->is_marker_icon_default_list;
                if( isset($post['is_default_icon']) ){
                    if( $post['default_icon_id'] > 0 ){
                        $icon = $this->Icons_model->getById($post['default_icon_id']);
                        $marker_icon = $icon->image;         
                        $is_marker_icon_default_list = 1;               
                    }
                }else{                    
                    if( $_FILES['image']['size'] > 0 ){
                        if( $_FILES['image']['size'] > 0 ){
                            $marker_icon = $this->moveUploadedFile();
                            $is_marker_icon_default_list = 0;        
                        }
                    }
                }

                $data_event_type = [
                    'title' => $post['title'],
                    'icon_marker' => $marker_icon,
                    'is_marker_icon_default_list' => 1,
                    'is_marker_icon_default_list' => $is_marker_icon_default_list,
                    'modified' => date("Y-m-d H:i:s")
                ];    
                $this->EventType_model->updateEventTypeById($post['eid'], $data_event_type);

                $this->session->set_flashdata('message', 'Event Type was successful updated');
                $this->session->set_flashdata('alert_class', 'alert-success');

                redirect('events/event_types');

            }else{
                $this->session->set_flashdata('message', 'Record not found.');
                $this->session->set_flashdata('alert_class', 'alert-danger');

                redirect('events/event_types');
            }

        }else{
            $this->session->set_flashdata('message', 'Please specify event type name');
            $this->session->set_flashdata('alert_class', 'alert-danger');

            redirect('event_types/edit/'.$post['eid']);

        }
    }   

	public function delete_event_type(){
		$id = $this->EventType_model->deleteById(post('eid'));

		$this->session->set_flashdata('message', 'Event Type has been Deleted Successfully');
		$this->session->set_flashdata('alert_class', 'alert-success');

        $json_data['is_success'] = 1;
        echo json_encode($json_data);
		//redirect('events/event_types');
	}

    public function moveUploadedFile() {
        if(isset($_FILES['image']) && $_FILES['image']['tmp_name'] != '') {
            $company_id = logged('company_id');
            $target_dir = "./uploads/event_types/" . $company_id . "/";
            if(!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true);
            }

            $tmp_name = $_FILES['image']['tmp_name'];
            $extension = strtolower(end(explode('.',$_FILES['image']['name'])));
            // basename() may prevent filesystem traversal attacks;
            // further validation/sanitation of the filename may be appropriate
            $name = basename($_FILES["image"]["name"]);
            move_uploaded_file($tmp_name, $target_dir . $name);

            return $name;
        }
    }
}



/* End of file Color_Settings.php */

/* Location: ./application/controllers/Color_Settings.php */