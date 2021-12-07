<?php

defined('BASEPATH') or exit('No direct script access allowed');


class Support extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        
    }

    public function index()
    {
        $this->load->model('Users_model');

        $user_id = getLoggedUserID();
        $user    = $this->Users_model->getUser($user_id);

        $this->page_data['user'] = $user;
        $this->load->view('support/index', $this->page_data);
    }

    public function ajax_send_email()
    {
        
    }
}
