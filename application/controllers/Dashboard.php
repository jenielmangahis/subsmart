<?php defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH.'controllers/Widgets.php';

class Dashboard extends Widgets {

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

        add_css(array(
           // 'https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css',
            "assets/css/accounting/accounting.css",
            'assets/css/dashboard.css',
            'assets/barcharts/css/chart.min.css',
            'assets/barcharts/css/chart.min.css',
            'assets/fa-5/css/fontawesome.min.css',
            'assets/fa-5/css/all.min.css'
        ));
        add_header_js(array(
            'assets/barcharts/js/chart.min.js',
            'assets/barcharts/js/utils.js',
            'assets/barcharts/js/chartjs-plugin-labels.js',
            'assets/js/timeago/dist/timeago.min.js',
            
        ));
        add_footer_js(array(
            //'https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js',
            'assets/frontend/js/dashboard/main.js',
            'assets/ringcentral/config.js',
            'assets/ringcentral/es6-promise.auto.js',
            'assets/ringcentral/fetch.umd.js',
            'assets/ringcentral/pubnub.4.20.1.js',
            'assets/ringcentral/ringcentral.js',
            'assets/ringcentral/rc_authentication.js'
        ));
    }
    
    
    public function sendSMS()
    {
        $this->load->library('Ringcentral');
        $this->ringcentral->sample();
        
    }
    
    
    public function getWidgetList(){
        $this->load->model('widgets_model');
        $user_id = logged('id');
        $this->page_data['widgets'] = $this->widgets_model->getWidgetsList($user_id);
        $this->load->view('widgets/add_widgets_details', $this->page_data);
    }

    public function index() {
        // load necessary model and functions
        $this->load->model('widgets_model');
        $this->load->helper('functions');

        $user_id = logged('id');
        $this->page_data['activity_list'] = $this->activity->getActivity($user_id, [6, 0], 0);
        // echo $this->db->last_query(); 
        // echo "<br>";
        $this->page_data['activity_list_count'] = sizeof($this->page_data['activity_list']);
        if ($this->page_data['activity_list_count'] > 5) {
            array_pop($this->page_data['activity_list']);
        }
        $this->page_data['history_activity_list'] = $this->activity->getActivity($user_id, [6, 0], 1);
        // echo $this->db->last_query();
        $this->page_data['history_activity_list_count'] = sizeof($this->page_data['history_activity_list']);
        if ($this->page_data['history_activity_list_count'] > 5) {
            array_pop($this->page_data['history_activity_list']);
        }
        $check_if_exist = $this->customer_ad_model->if_exist('fk_user_id', $user_id, "ac_dashboard_sort");
        if (!$check_if_exist) {
            $input = array();
            $input['fk_user_id'] = $user_id;
            $input['ds_values'] = "bulletin,open_estimates,upcoming_job,jobs,sales_leaderbord,tech_leaderbord,tags,lead_source,activities,history,today_stats,taskhub_stats,tasks,income,
                                   expenses,bank_accounts,sales,messages,paid_invoices,lead_stats,overdue_invoices,invoicing,task_stats,plan_setup,discover_more";
            $this->customer_ad_model->add($input, "ac_dashboard_sort");
        }

        $status_arr = array();
        $status_selection = $this->taskhub_status_model->get();
        foreach ($status_selection as $status_selec) {
            $task_status = $this->crud->total_record("tasks", "status_id='" . $status_selec->status_id . "'");
            $status_arr[] = $status_selec->status_text . "@#@" . $task_status;
        }
        
        $this->page_data['estimate'] = $this->estimate_model->getAllByCompany(logged('company_id'));
        
        $this->page_data['job'] = $this->jobs_model->getJob(logged('company_id'));
        $this->page_data['events'] = $this->event_model->get_all_events(5);
        $this->page_data['widgets'] = $this->widgets_model->getWidgetListPerUser($user_id);
        $this->page_data['status_arr'] = $status_arr;
        $this->load->view('dashboard', $this->page_data);
    }
    
    public function getInbox(){
        $this->load->view('dashboard/inbox');
    }
    
    public function getSMS(){
        $this->load->view('dashboard/sms');
    }
    
    public function getPhoneCalls(){
        $this->load->view('dashboard/calls');
    }
    
    public function ac_dashboard_sort() {
        //$user_id = logged('id');
        $input = $this->input->post();
        if ($this->customer_ad_model->update_data($input, "ac_dashboard_sort", "acds_id")) {
            echo "Module Sort Updated!";
        } else {
            echo "Error";
        }
    }

    public function blank() {
        $get = $this->input->get();
        $this->page_data['page_name'] = $get['page'];
        $this->load->view('blank', $this->page_data);
    }

    public function saveFeed() {
        postAllowed();

        $comp_id = logged('company_id');

        $id = $this->feeds_model->create([
            'company_id' => $comp_id,
            'customer_id' => post('recipient_id'),
            'subject' => post('feed_subject'),
            'description' => post('feed_description')
        ]);

        $this->activity_model->add('New Feeds Added Created by User:' . logged('name'), logged('id'));
        $this->session->set_flashdata('alert-type', 'success');
        $this->session->set_flashdata('alert', 'New Feed Added Successfully');

        redirect('dashboard');
    }

}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */