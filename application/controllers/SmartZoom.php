<?php
class SmartZoom extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->page_data['page']->title = 'Smart Zoom';
    }

    public function index() {
        $this->load->view('v2/pages/dashboard/smartzoom.php', $this->page_data);
    }
}