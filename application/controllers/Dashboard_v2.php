<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH.'controllers/Widgets.php';

class Dashboard_v2 extends Widgets{
    public function __construct() {
        parent::__construct();
        $this->checkLogin();
        $this->load->library('wizardlib');
        $this->load->model('Customer_advance_model', 'customer_ad_model');
        $this->load->model('Users_model', 'user_model');
        $this->load->model('Feeds_model', 'feeds_model');
        $this->load->model('timesheet_model');
        $this->load->model('users_model');
        $this->load->model('jobs_model');
        $this->load->model('event_model');
        $this->load->model('estimate_model');
        $this->load->model('invoice_model');
        $this->load->model('Crud', 'crud');
        $this->load->model('taskhub_status_model');
        $this->load->model('Activity_model', 'activity');
        $this->load->model('General_model', 'general');
    }

    public function getWidgetList(){
        $this->load->model('widgets_model');
        $user_id = logged('id');
        $this->page_data['widgets'] = $this->widgets_model->getWidgetsList($user_id);
        $this->load->view('v2/widgets/add_widgets_details', $this->page_data);
    }

    public function index(){
        $this->load->model('widgets_model');
        $this->load->helper('functions');
        
        $user_id = logged('id');

        $this->page_data['upcomingJobs'] = $this->jobs_model->getAllUpcomingJobsByCompanyId(logged('company_id'));
        $this->page_data['estimates'] = $this->estimate_model->getAllEstimates();
        $this->page_data['upcomingEvents'] = $this->event_model->getAllUpComingEventsByCompanyId(logged('company_id'));
        $this->page_data['widgets'] = $this->widgets_model->getWidgetListPerUser($user_id);
        $this->page_data['main_widgets'] = array_filter($this->page_data['widgets'], function($widget){
            return $widget->wu_is_main == true;
        });

        $plans_query = array(
            'where' => array('company_id' => logged('company_id'), 'status' => 1),
            'table' => 'plan_type',
            'select' => 'count(*) as totalPlan',
        );
        $this->page_data['plan_type'] = $this->general->get_data_with_param($plans_query);

        $total_amount_invoice = array(
            'where' => array('company_id' => logged('company_id'), 'status' => 'Paid'),
            'table' => 'invoices',
            'select' => 'SUM(grand_total) as total',
        );
        $this->page_data['total_amount_invoice'] = $this->general->get_data_with_param($total_amount_invoice,FALSE);

        $total_invoice_paid = array(
            'where' => array('company_id' => logged('company_id'), 'status' => 'Paid'),
            'table' => 'invoices',
            'select' => 'count(*) as total',
        );
        $this->page_data['total_invoice_paid'] = $this->general->get_data_with_param($total_invoice_paid,FALSE);

        $invoice_draft = array(
            'where' => array('company_id' => logged('company_id'), 'status' => 'Draft'),
            'table' => 'invoices',
            'select' => 'count(*) as total',
        );
        $this->page_data['invoice_draft'] = $this->general->get_data_with_param($invoice_draft,FALSE);
         
        $invoice_due = array(
            'where' => array('company_id' => logged('company_id'), 'status' => 'Due'),
            'table' => 'invoices',
            'select' => 'count(*) as total',
        );
        $this->page_data['invoice_due'] = $this->general->get_data_with_param($invoice_due,FALSE);

        $estimate_draft_query = array(
            'where' => array('company_id' => logged('company_id')),
            'table' => 'estimates',
            'select' => 'id,status',
        );
        $this->page_data['estimate_draft'] = $this->general->get_data_with_param($estimate_draft_query);

        $feeds_query = array(
            'table' => 'feed',
            'select' => '*',
        );
        $this->page_data['feeds'] = $this->general->get_data_with_param($feeds_query);

        $news_query = array(
            'where' => array('company_id' => logged('company_id')),
            'table' => 'news',
            'select' => '*',
        );
        $this->page_data['news'] = $this->general->get_data_with_param($news_query);
        
        $this->load->view('dashboard_v2', $this->page_data);
	}
}