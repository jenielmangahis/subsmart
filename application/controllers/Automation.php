<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Automation extends MYF_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->page_data['page']->title = 'Automation';
        $this->page_data['page']->parent = 'Automation';

        add_css(array(
            "assets/css/automation/automation.css",

        ));

        $this->load->model('Customer_advance_model', 'customer_ad_model');
    }

    public function index()
    {
        $this->page_data['lead_status'] = $this->customer_ad_model->get_select_options('ac_leads', 'status');
        $this->page_data['job_status'] = $this->customer_ad_model->get_select_options('jobs', 'status');
        $this->load->view('v2/pages/automation/list', $this->page_data);
    }

    public function reminders()
    {
        $this->page_data['page']->title = 'Automation Reminders';
        $this->page_data['page']->parent = 'Automation';
        $this->page_data['lead_status'] = $this->customer_ad_model->get_select_options('ac_leads', 'status');
        $this->page_data['job_status'] = $this->customer_ad_model->get_select_options('jobs', 'status');
        $this->load->view('v2/pages/automation/reminders', $this->page_data);
    }

    public function marketing()
    {
        $this->page_data['page']->title = 'Automation Marketing';
        $this->page_data['page']->parent = 'Automation';
        $this->load->view('v2/pages/automation/marketing', $this->page_data);
    }

    public function followUps()
    {
        $this->page_data['page']->title = 'Automation Follow-ups';
        $this->page_data['page']->parent = 'Automation';
        $this->load->view('v2/pages/automation/follow_ups', $this->page_data);
    }

    public function phone()
    {
        $this->page_data['page']->title = 'Automation Phone';
        $this->page_data['page']->parent = 'Automation';
        $this->load->view('v2/pages/automation/phone', $this->page_data);
    }

    public function actions()
    {
        $this->page_data['page']->title = 'Automation Actions';
        $this->page_data['page']->parent = 'Automation';
        $this->load->view('v2/pages/automation/actions', $this->page_data);
    }
}
