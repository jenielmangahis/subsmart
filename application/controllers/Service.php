<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Service extends MY_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->checkLogin();

		$this->page_data['page']->title = 'Service';
        $this->page_data['page']->menu = 'service';
        
        // $this->load->model('Service_model', 'service_model');
	}

	public function index()
	{
		// ifPermissions('roles_list');
		// $this->page_data['services'] = $this->service_model->getByWhere(['user_id' => logged('id')], ['order' => array('title', 'asc')]);
		$this->load->view('service/list', $this->page_data);
    }

	public function json_list()
	{
        // ifPermissions('roles_list');
        $get = $this->input->get();
		$services = $this->service_model->getAll($get);
        
        echo json_encode($services);
    }

	public function add()
	{
		// ifPermissions('roles_add');
		$this->load->view('service/add', $this->page_data);
	}

	public function save()
	{
        postAllowed();

		$post = $this->input->post();

		$data = array(
		    'user_id' => logged('id'),
            'title' => post('title')
        );

		if ( $this->service_model->create($data) !== 0) {

            $this->session->set_flashdata('alert-type', 'success');
            $this->session->set_flashdata('alert', 'Service has been created Successfully');
        } else {

            $this->session->set_flashdata('alert-type', 'error');
            $this->session->set_flashdata('alert', 'Service does not created. Try again later');
        }

        redirect('services');
	}

	public function edit($id)
	{
        $this->page_data['service'] = $this->service_model->getById($id);
		$this->load->view('service/edit', $this->page_data);
	}


	public function update($id)
	{
		
		postAllowed();

        $post = $this->input->post();

        $this->service_model->update($id, $post);
		
		$this->activity_model->add("Service Updated by User: #".logged('id'));
		
		$this->session->set_flashdata('alert-type', 'success');
		$this->session->set_flashdata('alert', 'Service has been Updated Successfully');
		
		redirect('services');

	}


    /**
     * @param $id
     */
    public function delete($id)

    {

        if ($id !== 1 && $id != logged($id)) {
        } else {

            redirect('/', 'refresh');

            return;
        }


        $id = $this->service_model->delete($id);


        $this->activity_model->add("Service #$id Deleted by User:" . logged('name'));


        $this->session->set_flashdata('alert-type', 'success');

        $this->session->set_flashdata('alert', 'Service has been Deleted Successfully');


        redirect('services');
    }


}

/* End of file Service.php */
/* Location: ./application/controllers/Service.php */