<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ClientHub extends MYF_Controller {
	public function __construct(){
		parent::__construct();
		$this->page_data['page']->title = 'nSmart - Customer Public Portal';
	}

	public function index($id){	
		$this->load->helper(array('hashids_helper'));

		$this->page_data['page']->portal_tabs = 'portal_jobs';
		$this->page_data['customer_id_incrypt'] = $id;

		$customer_id = hashids_decrypt($id, '', 45);
		$this->load->view('v2/pages/customer/client_hub/index', $this->page_data);
	}

	public function tickets($id){	
		$this->load->helper(array('hashids_helper'));

		$this->page_data['page']->portal_tabs = 'portal_tickets';
		$this->page_data['customer_id_incrypt'] = $id;

		$customer_id = hashids_decrypt($id, '', 45);
		$this->load->view('v2/pages/customer/client_hub/tickets', $this->page_data);
	}

	public function invoice_status($id){	
		$this->load->helper(array('hashids_helper'));

		$this->page_data['page']->portal_tabs = 'portal_invoice_status';
		$this->page_data['customer_id_incrypt'] = $id;
		
		$customer_id = hashids_decrypt($id, '', 45);
		$this->load->view('v2/pages/customer/client_hub/invoice_status', $this->page_data);
	}
}
