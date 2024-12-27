<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ClientHub extends MYF_Controller {
	public function __construct(){
		parent::__construct();
		$this->page_data['page']->title = 'nSmart - Customer Public Portal';

		$this->load->helper(array('hashids_helper'));
		$this->load->model('Jobs_model');
		$this->load->model('Tickets_model');
		$this->load->model('AcsProfile_model');
		$this->load->model('Business_model');
	}

	public function index($id){	
		$this->page_data['page']->portal_tabs = 'portal_customer_information';
		$this->page_data['customer_id_incrypt'] = $id;
		$customer_id = hashids_decrypt($id, '', 45);

		$profile_info = $this->AcsProfile_model->getByProfId($customer_id);
		$this->page_data['profile_info'] = $profile_info;
		$this->page_data['sales_area']   = [];
		$this->load->view('v2/pages/customer/client_hub/profile', $this->page_data);
	}

	public function jobs($id){	
		$this->page_data['page']->portal_tabs = 'portal_jobs';
		$this->page_data['customer_id_incrypt'] = $id;
		$customer_id = hashids_decrypt($id, '', 45);

		$jobs = $this->Jobs_model->getAllJobsByCustomerId($customer_id);
		$this->page_data['jobs'] = $jobs;
		$this->load->view('v2/pages/customer/client_hub/jobs', $this->page_data);
	}

	public function tickets($id){	
		$this->page_data['page']->portal_tabs = 'portal_tickets';
		$this->page_data['customer_id_incrypt'] = $id;

		$customer_id = hashids_decrypt($id, '', 45);
		$tickets = $this->Tickets_model->getAllByCustomerId($customer_id);

		$this->page_data['tickets'] = $tickets;
		$this->load->view('v2/pages/customer/client_hub/tickets', $this->page_data);
	}

	public function invoice_status($id){	
		$this->page_data['page']->portal_tabs = 'portal_invoice_status';
		$this->page_data['customer_id_incrypt'] = $id;
		
		$customer_id = hashids_decrypt($id, '', 45);
		$this->load->view('v2/pages/customer/client_hub/invoice_status', $this->page_data);
	}

	public function customer_profile(){
		$customer_id = hashids_decrypt($id, '', 45);
	}

	public function ajax_view_customer_job()
    {
        $post     = $this->input->post();
		$id       = hashids_decrypt($post['jobid'], '', 45);
		$job      = $this->Jobs_model->get_specific_job($id);
		$business = $this->Business_model->getByCompanyId($job->company_id);   
    }

    public function ajax_view_customer_ticket_details()
    {
        $this->load->model('User_docflies_model');
        $this->load->model('Customer_advance_model');
		$this->load->model('Tickets_model', 'tickets_model');

        $post        = $this->input->post();
        $id          = $post['appointment_id'];

        $esign   = $this->User_docflies_model->getByTicketId($id);        
        $tickets = $this->tickets_model->get_tickets_data_one($id);

        $billing = $this->Customer_advance_model->get_data_by_id('fk_prof_id', $tickets->customer_id, 'acs_billing');
        $ticket_rep  = $tickets->sales_rep;
        
        $this->page_data['reps'] = $this->tickets_model->get_ticket_representative($ticket_rep);
        $this->page_data['ticketsCompany'] = $this->tickets_model->get_tickets_company($tickets->company_id);
        $this->page_data['tickets'] = $tickets;
        $this->page_data['billing'] = $billing;
        $this->page_data['esign'] = $esign;
        $this->page_data['items'] = $this->tickets_model->get_ticket_items($id);
        $this->page_data['payment'] = $this->tickets_model->get_ticket_payments($id);
        $this->page_data['clients'] = $this->tickets_model->get_tickets_clients($tickets->company_id);
		$this->load->view('v2/pages/customer/client_hub/ajax_quick_view_ticket_details', $this->page_data);
    }	
}
