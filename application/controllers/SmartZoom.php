<?php
class SmartZoom extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->checkLogin();
        $this->load->model('Smartzoom_model');
    }

    public function index() 
    {
        $this->page_data['page']->title = 'Smart Zoom';
        $this->load->view('v2/pages/dashboard/smartzoom.php', $this->page_data);
    }

    public function createRoom()
    {
        $company_id = logged('company_id');
        $host = logged('id');

        $data = array(
            "company_id" => $company_id,
            "host" => $host,
        );

        $setRoom = $this->Smartzoom_model->addRoom($data);

        echo json_encode($setRoom);
    }

    public function joinRoom()
    {
        $company_id = logged('company_id');
        $user = logged('id');
        $post_data = $this->input->post();

        $data = array(
            "company_id" => $company_id,
            "user" => $user,
            "room_id" => $post_data['room_id'],
        );

        $connectRoom = $this->Smartzoom_model->connectRoom($data);

        if (count($connectRoom) == 1) {
            $connectRoom[0]->user = $user;
        }

        echo json_encode($connectRoom);
    }

    public function deleteRoom() {
        $company_id = logged('company_id');
        $host = logged('id');
        $post_data = $this->input->post();

        $data = array(
            "company_id" => $company_id,
            "host" => $host,
            "room_id" => $post_data['room_id'],
        );

        $removeRoom = $this->Smartzoom_model->removeRoom($data);

        echo json_encode($removeRoom);
    }

    public function checkExistingRoom()
    {
        $company_id = logged('company_id');
        $host = logged('id');

        $data = array(
            "company_id" => $company_id,
            "host" => $host,
        );

        $checkExistingRoom = $this->Smartzoom_model->roomLookup($data);
        
        echo json_encode($checkExistingRoom);
    }
}