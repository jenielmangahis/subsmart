<?php


defined('BASEPATH') or exit('No direct script access allowed');


class Marketing extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->page_data['page']->title = 'Marketing Features';
        $this->page_data['page']->menu = 'marketing';
        $this->load->model('Customer_model', 'customer_model');

        $this->checkLogin();
        $this->load->library('session');
        $user_id = getLoggedUserID();

        // concept
        $uid = $this->session->userdata('uid');

        if (empty($uid)) {

            $this->page_data['uid'] = md5(time());
            $this->session->set_userdata(['uid' => $this->page_data['uid']]);

        } else {

            $uid = $this->session->userdata('uid');
            $this->page_data['uid'] = $uid;
        }
    }


    public function index()
    {
        $this->page_data['page']->title = 'Marketing Features';
		$this->page_data['page']->parent = 'Marketing';

        $is_allowed = $this->isAllowedModuleAccess(47);
        if( !$is_allowed ){
            $this->page_data['module'] = 'marketing';
            echo $this->load->view('no_access_module', $this->page_data, true);
            die();
        }

        $this->load->view('v2/pages/marketing/main', $this->page_data);
    }
}
