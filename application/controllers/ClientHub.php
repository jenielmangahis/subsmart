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
		$this->load->model('Invoice_model', 'invoice_model');
		$this->load->model('Invoice_settings_model', 'invoice_settings_model');
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
		$invoices = $this->invoice_model->getAllByCustomerId($customer_id);
		
		$this->page_data['invoices'] = $invoices;
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
	
	public function ajax_view_customer_invoice_details()
	{
		$post   = $this->input->post();
		$format = $post['format'];
		$id     = $post['invoice_id'];

        $this->load->model('general_model');
        $this->load->model('AcsProfile_model');
        $invoice = get_invoice_by_id($post['invoice_id']);
        $get_company_info = array(
            'where' => array(
                'company_id' => $invoice->company_id,
            ),
            'table' => 'business_profile',
            'select' => 'id,business_phone,business_name,business_logo,business_email,street,city,postal_code,state,business_image',
        );

        $company = $this->general_model->get_data_with_param($get_company_info, false);
      
        $this->page_data['invoice']  = $invoice;
        $this->page_data['items']    = $items = $this->invoice_model->getItemsInv($id);
        $this->page_data['users']    = $this->invoice_model->getInvoiceCustomer($id);
        $this->page_data['customer'] = $this->AcsProfile_model->getByProfId($invoice->customer_id);

        if (!empty($invoice)) {
            foreach ($invoice as $key => $value) {
                if (is_serialized($value)) {
                    $invoice->{$key} = unserialize($value);
                }
            }
            $this->page_data['invoice'] = $invoice;
        }
        $this->page_data['company'] = $company;
        $this->page_data['format']  = $format;

        $setting = $this->invoice_settings_model->getAllByCompany($invoice->company_id);	
        if ($format === "html") {
            $img = explode("/", parse_url((companyProfileImage($invoice->company_id)) ? companyProfileImage($invoice->company_id) : $url->assets)['path']);
            $this->page_data['profile'] = $img[2] . "/" . $img[3] . "/" . $img[4];
            $filename = "nSmarTrac_invoice_".$id;
            if($setting[0]->invoice_template == 1){
			  $this->load->view('invoice/pdf/standard_template_web', $this->page_data);
            }
            if($setting[0]->invoice_template == 3){
				$this->load->view('invoice/pdf/template_web', $this->page_data);
            }
        }		
	}

    public function invoice_preview_pdf($id)
    {
        $this->load->model('general_model');
        $this->load->model('AcsProfile_model');
        $invoice = get_invoice_by_id($id);
        $get_company_info = array(
            'where' => array(
                'company_id' => $invoice->company_id,
            ),
            'table' => 'business_profile',
            'select' => 'id,business_phone,business_name,business_logo,business_email,street,city,postal_code,state,business_image',
        );

        $company = $this->general_model->get_data_with_param($get_company_info, false);
      
        $this->page_data['invoice']  = $invoice;
        $this->page_data['items']    = $this->invoice_model->getItemsInv($id);
        $this->page_data['users']    = $this->invoice_model->getInvoiceCustomer($id);
        $this->page_data['customer'] = $this->AcsProfile_model->getByProfId($invoice->customer_id);

        if (!empty($invoice)) {
            foreach ($invoice as $key => $value) {
                if (is_serialized($value)) {
                    $invoice->{$key} = unserialize($value);
                }
            }

            $this->page_data['invoice'] = $invoice;
        }
        $format = $this->input->get('format');
        $this->page_data['company'] = $company;
        $this->page_data['format']  = $format;

        $setting = $this->invoice_settings_model->getAllByCompany($invoice->company_id);

        if ($format === "pdf") {
            $img = explode("/", parse_url((companyProfileImage($invoice->company_id)) ? companyProfileImage($invoice->company_id) : $url->assets)['path']);
            $this->page_data['profile'] = $img[2] . "/" . $img[3] . "/" . $img[4];
            $filename = "nSmarTrac_invoice_".$id;
            $this->load->library('pdf');
            if($setting[0]->invoice_template == 1){
              $this->pdf->load_view('invoice/pdf/standard_template', $this->page_data, $filename, "portrait");
            }
            if($setting[0]->invoice_template == 3){
                $this->pdf->load_view('invoice/pdf/template', $this->page_data, $filename, "portrait");
              }
        }
    }	
}
