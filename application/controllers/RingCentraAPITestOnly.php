<?php
class RingCentraAPITestOnly extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->view('ringcentral_api_test', $this->page_data);
    }
}