<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Campaign_Blast extends MY_Controller {



	public function __construct()
	{
		parent::__construct();
		$this->checkLogin();

		$this->load->model('MarketingCampaignBlast_model');

		$this->page_data['page']->title = 'Campaign Blast';
		$this->page_data['page']->menu = '';	
	}

	public function index()
	{	
		$campaign_blast_draft = $this->MarketingCampaignBlast_model->getAllByStatus('draft');
		$campaign_blast_queue = $this->MarketingCampaignBlast_model->getAllByStatus('queue');
		$campaign_blast_sent  = $this->MarketingCampaignBlast_model->getAllByStatus('sent');
		$campaign_blast_archive = $this->MarketingCampaignBlast_model->getAllByStatus('archive');

		$campaign_blast_all = $this->MarketingCampaignBlast_model->getAll();

		$this->page_data['count_campaign_blast']   = count($campaign_blast_all);
		$this->page_data['campaign_blast_draft']   = $campaign_blast_draft;
		$this->page_data['campaign_blast_queue']   = $campaign_blast_queue;
		$this->page_data['campaign_blast_sent']    = $campaign_blast_sent;
		$this->page_data['campaign_blast_archive'] = $campaign_blast_archive;
		$this->load->view('campaign_blast/index', $this->page_data);
	}

    public function save_blast()
    {
        postAllowed();

        $user = $this->session->userdata('logged');
        $post = $this->input->post();

        if( !empty($post) ){
        	$this->load->model('MarketingCampaignBlast_model');

        	$data = array(
        		'user_id' => $user['id'],
        		'campaign_name' => post('name'),
        		'postcard_return_address_name' => post('postcard_return_address_name'),
        		'postcard_return_address_address' => post('postcard_return_address_address'),
        		'postcard_return_address_address_secondary' => post('postcard_return_address_address_secondary'),
        		'postcard_return_address_city' => post('postcard_return_address_city'),
        		'postcard_return_address_zip' => post('postcard_return_address_zip'),
        		'postcard_return_address_state' => post('postcard_return_address_state'),
        		'postcard_return_address_country' => post('postcard_return_address_country'),
        		'status' => 'draft',
        		'date_created' => date("Y-m-d H:i:s")
        	);
        	$campaign_blast = $this->MarketingCampaignBlast_model->create($data);

        	$this->session->set_flashdata('message', 'Add New Campaign Blast');
        	$this->session->set_flashdata('alert_class', 'alert-success');
        }

        redirect('campaign_blast');                

    }	

    public function delete_blast()
    {
    	$id = $this->MarketingCampaignBlast_model->delete(post('tid'));

		$this->activity_model->add("Campaign Blast #$id Deleted by User:".logged('name'));

		$this->session->set_flashdata('message', 'Campaign Blast has been Deleted Successfully');
		$this->session->set_flashdata('alert_class', 'alert-success');

		redirect('campaign_blast');
    }      
}



/* End of file Comapny.php */

/* Location: ./application/controllers/Users.php */