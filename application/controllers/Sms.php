<?php defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH.'controllers/Widgets.php';

class Sms extends Widgets {

    public function __construct() {
        parent::__construct();
        $this->checkLogin();
		$this->page_data['page']->title = 'SMS';
        $this->page_data['page']->parent = 'Dashboard';
    }

    public function index() {
        $this->load->view('v2/pages/dashboard/sms.php', $this->page_data);
    }
}