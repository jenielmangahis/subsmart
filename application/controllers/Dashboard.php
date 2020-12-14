<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {


	public function __construct()
    {
        parent::__construct();
        $this->checkLogin();
        $this->load->model('Customer_advance_model', 'customer_ad_model');
        add_css(array(
            'https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css',
            "assets/css/accounting/accounting.css",
        ));

        add_footer_js(array(
            'https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js',
            'assets/frontend/js/dashboard/main.js'
        ));
    }


	public function index()
	{
        $user_id = logged('id');
        $check_if_exist = $this->customer_ad_model->if_exist('fk_user_id',$user_id,"ac_dashboard_sort");
        if(!$check_if_exist){
            $input = array();
            $input['fk_user_id'] = $user_id ;
            $input['ds_values'] = "earning,analytics,report,activity,report2,newsletter,spotlight,bulletin,job,estimate,invoice,stats,installs" ;
            $this->customer_ad_model->add($input,"ac_dashboard_sort");
        }

        // get customers data and display to modal for selecting an existing client
        $this->page_data['profiles'] = $this->customer_ad_model->get_customer_data($user_id);

        $this->page_data['dashboard_sort'] = $this->customer_ad_model->get_data_by_id('fk_user_id',$user_id,"ac_dashboard_sort");
		$this->load->view('dashboard', $this->page_data);
	}

    public function ac_dashboard_sort(){
        //$user_id = logged('id');
        $input = $this->input->post();
        if($this->customer_ad_model->update_data($input,"ac_dashboard_sort","acds_id")){
            echo "Module Sort Updated!";
        }else{
            echo "Error";
        }
    }


    public function blank() {
	    $get = $this->input->get();
        $this->page_data['page_name'] = $get['page'];
        $this->load->view('blank', $this->page_data);
    }

    public function saveFeed()
    {
        postAllowed();

        $comp_id = logged('company_id');

        $id = $this->feeds_model->create([
            'company_id' => $comp_id,
            'customer_id' => post('customer_id'),
            'title' => post('title'),
            'date' => date('Y-m-d', strtotime(post('date'))),
            'subject' => post('subject'),
            'description' => post('description')
        ]);
            
        $this->activity_model->add('New Feeds Added Created by User:' . logged('name'), logged('id'));
        $this->session->set_flashdata('alert-type', 'success');
        $this->session->set_flashdata('alert', 'New Feed Added Successfully');

        redirect('invoice/genview/'.post('invoice_id'));
    }

}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */