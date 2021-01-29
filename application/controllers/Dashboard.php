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
        $this->load->model('estimate_model');
        $this->load->model('invoice_model');
        $this->load->model('Crud', 'crud');
        $this->load->model('taskhub_status_model');
        $this->load->model('Activity_model', 'activity');

        add_css(array(
            'https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css',
            "assets/css/accounting/accounting.css",
            'assets/css/dashboard.css'
        ));

        add_footer_js(array(
            'https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js',
            'assets/frontend/js/dashboard/main.js',
                //"assets/css/dashboard/dasboard_box.js",
                //"assets/css/dashboard/dasboard.chunk.js",
                //"assets/css/dashboard/dasboard_client.js",
                //"assets/css/dashboard/hcui.chunk.js",
        ));
    }

    public function index() {
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
        $this->page_data['status_arr'] = $status_arr;
        $this->load->view('dashboard', $this->page_data);
    }
    

    public function tech_leaderboard() {
        $user_id = logged('id');
        $check_if_exist = $this->customer_ad_model->if_exist('fk_user_id', $user_id, "ac_dashboard_sort");
        if (!$check_if_exist) {
            $input = array();
            $input['fk_user_id'] = $user_id;
            $input['ds_values'] = "earning,analytics,report,activity,report2,newsletter,spotlight,bulletin,job,estimate,invoice,stats,installs";
            $this->customer_ad_model->add($input, "ac_dashboard_sort");
        }
        $this->page_data['feeds'] = $this->feeds_model->getByCompanyId();

        $this->page_data['job'] = $this->jobs_model->getJob(logged('company_id'));
        $this->page_data['estimate'] = $this->estimate_model->getAllByCompany(logged('company_id'));
        $this->page_data['invoice'] = $this->estimate_model->getAllByCompany(logged('company_id'));
        $this->page_data['invoice'] = $this->invoice_model->getAllByCompany(logged('company_id'), 0);

        $this->page_data['employees'] = $this->user_model->getAllUsersByCompany(logged('company_id'));
        $this->page_data['profiles'] = $this->customer_ad_model->get_customer_data($user_id);
        $this->page_data['attendance'] = $this->timesheet_model->getEmployeeAttendance();
        $this->page_data['users'] = $this->users_model->getUsers();
        $this->page_data['user_roles'] = $this->users_model->getRoles();
        $this->page_data['logs'] = $this->timesheet_model->getTimesheetLogs();
        $this->page_data['total_users'] = $this->users_model->getTotalUsers();
        $this->page_data['no_logged_in'] = $this->timesheet_model->getTotalUsersLoggedIn();
        $this->page_data['in_now'] = $this->timesheet_model->getInNow();
        $this->page_data['out_now'] = $this->timesheet_model->getOutNow();
        $this->page_data['dashboard_sort'] = "report2,newsletter,bulletin";

        $this->page_data['all_leads'] = $this->crud->total_record("ac_leads", "leads_id!=0");
        $this->page_data['assigned_leads'] = $this->crud->total_record("ac_leads", "fk_assign_id!=0");
        $this->page_data['unassigned_leads'] = $this->crud->total_record("ac_leads", "fk_assign_id=0");
        $this->page_data['converted_leads'] = $this->crud->total_record("ac_leads", "status='Converted'");

        $this->page_data['all_tasks'] = $this->crud->total_record("tasks", "task_id!=0");
        $this->page_data['my_assig_tasks'] = $this->crud->total_record("tasks", "created_by='" . logged('id') . "'");
        $today_date = date("Y-m-d");
        $this->page_data['due_today_tasks'] = $this->crud->total_record("tasks", "estimated_date_complete='" . $today_date . "'");

        $status_arr = array();
        $status_selection = $this->taskhub_status_model->get();
        foreach ($status_selection as $status_selec) {
            $task_status = $this->crud->total_record("tasks", "status_id='" . $status_selec->status_id . "'");
            $status_arr[] = $status_selec->status_text . "@#@" . $task_status;
        }
        $this->page_data['status_arr'] = $status_arr;

        $this->load->view('dashboard', $this->page_data);
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