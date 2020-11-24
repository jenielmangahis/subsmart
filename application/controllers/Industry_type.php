<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Industry_Type extends MY_Controller {

	public function __construct() {
		parent::__construct();

		//$this->checkLogin();
		$role_id = 1; //this is for nsmart admin user
		$this->isCheckLoginAndRole($role_id);

		$this->page_data['page_title'] = 'Industry Template';

		$this->load->helper(array('form', 'url', 'hashids_helper'));
		$this->load->library('session');

		$this->load->model('IndustryTemplate_model');
		$this->load->model('IndustryType_model');
	}

	public function index() {
		$this->load->library('pagination');
		//$offset = ($page-1)*$config["per_page"];
		$industryTemplate   = $this->IndustryTemplate_model->getAll();

		$total_records = $this->IndustryType_model->countAllRecords();
		$uri_segment   = $this->uri->segment(3);
		$per_page      = 10;
	    if($uri_segment == 0 || empty($uri_segment)){
	    	$uri_segment = 5;
	    }else{
	    	$uri_segment = $uri_segment + $per_page;
	    }

	    $industryTypes   = $this->IndustryType_model->getAll(array('limit_perpage' => $per_page, 'offset' => $uri_segment));		

		$config['total_rows']  = $total_records;
  		$config['per_page']    = $per_page;
  		$config['base_url']    = base_url(). 'industry_type/index';
  		$config['total_rows']  = $total_records;
  		$config['num_links']   = 1;

  		$config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tagl_close'] = '</a></li>';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tagl_close'] = '</li>';
        $config['first_tag_open'] = '<li class="page-item disabled">';
        $config['first_tagl_close'] = '</li>';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tagl_close'] = '</a></li>';
        $config['attributes'] = array('class' => 'page-link');

  		$this->pagination->initialize($config);

  		$this->page_data['pagination']    = $this->pagination->create_links();
		$this->page_data['industryTypes'] = $industryTypes;
		$this->page_data['industryTemplate'] = $industryTemplate;
		$this->load->view('industry_type/index', $this->page_data);
	}

	public function add_new_industry_type() {
		$businessTypes = [ 
		  'Building Contractors' => 'Building Contractors',
		  'Financial Services' => 'Financial Services',
		  'Technical Services' => 'Technical Services',
		  'Health And Beauty' => 'Health And Beauty',
		  'Transportation' => 'Transportation',
		  'Organization / Cleaning' => 'Organization / Cleaning',
		  'Entertainment Services' => 'Entertainment Services',
		  'Design Services' => 'Design Services',
		  'Other' => 'Other',
        ];
		$industryTemplate   = $this->IndustryTemplate_model->getAll();

		$this->page_data['industryTemplate'] = $industryTemplate;
		$this->page_data['businessTypes'] = $businessTypes;            
		$this->load->view('industry_type/add_new_industry_type', $this->page_data);
	}

	public function create_type() {
		postAllowed();

        $user = $this->session->userdata('logged');
        $post = $this->input->post();

        if( $post['name'] != '' ){
        	if( $this->IndustryType_model->getByName($post['name']) ){
        		$this->session->set_flashdata('message', 'Type name already exists');
        		$this->session->set_flashdata('alert_class', 'alert-danger');
        	}else{
        		$data = [
        			'name' => $post['name'],
        			'business_type_name' => $post['business_type_name'],
        			'industry_template_id' => $post['industry_template_id'],
        			'status' => 1,
        			'date_created' => date("Y-m-d H:i:s")
        		];

        		$industryType = $this->IndustryType_model->create($data);

        		$this->session->set_flashdata('message', 'Add new type was successful');
        		$this->session->set_flashdata('alert_class', 'alert-success');
        	}
        }else{
        	$this->session->set_flashdata('message', 'Please enter type name');
        	$this->session->set_flashdata('alert_class', 'alert-danger');
        }

        redirect('industry_type/add_new_industry_type');
	}

	public function edit_industry_type($type_id) {

		$industryType = $this->IndustryType_model->getById($type_id);
		$industryTemplate   = $this->IndustryTemplate_model->getAll();
		$businessTypes = [ 
					  'Building Contractors' => 'Building Contractors',
					  'Financial Services' => 'Financial Services',
					  'Technical Services' => 'Technical Services',
					  'Health And Beauty' => 'Health And Beauty',
					  'Transportation' => 'Transportation',
					  'Organization / Cleaning' => 'Organization / Cleaning',
					  'Entertainment Services' => 'Entertainment Services',
					  'Design Services' => 'Design Services',
					  'Other' => 'Other',
		            ];

		if( $industryType ){
			$this->page_data['businessTypes'] = $businessTypes;
			$this->page_data['industryType'] = $industryType;
		    $this->page_data['industryTemplate'] = $industryTemplate;
		    $this->load->view('industry_type/edit_industry_type', $this->page_data);
		}else{
			$this->session->set_flashdata('message', 'Cannot find data');
        	$this->session->set_flashdata('alert_class', 'alert-danger');
        	redirect('industry_type/index');
		}
	}

	public function update_type() {
		postAllowed();

        $user = $this->session->userdata('logged');
        $post = $this->input->post();

        $industryTemplate = $this->IndustryType_model->getById($post['type_id']);

        if( $industryTemplate ){
        	if( $post['name'] != '' ){
	        	$data = [
        			'name' => $post['name'],
        			'business_type_name' => $post['business_type_name'],
        			'industry_template_id' => $post['industry_template_id'],
        			'status' => $post['status'],
        			'date_modified' => date("Y-m-d H:i:s")
        		];
        		$industryTemplateUpdate = $this->IndustryType_model->updateIndustryType($post['type_id'],$data);

        		$this->session->set_flashdata('message', 'Type was successfully updated');
        		$this->session->set_flashdata('alert_class', 'alert-success');
	        }else{
	        	$this->session->set_flashdata('message', 'Please enter type name');
	        	$this->session->set_flashdata('alert_class', 'alert-danger');
	        }

	        redirect('industry_type/edit_industry_type/'.$post['type_id']);

        }else{
        	$this->session->set_flashdata('message', 'Cannot find data');
	        $this->session->set_flashdata('alert_class', 'alert-danger');

	        redirect('industry_type/index');
        }
	}

	
	
	public function delete_type()
    {
    	$post = $this->input->post();

    	$id = $this->IndustryType_model->deleteIndustryType(post('type_id'));

		$this->session->set_flashdata('message', 'Industry Type has been Deleted Successfully');
		$this->session->set_flashdata('alert_class', 'alert-success');

		redirect('industry_type/index');
    }
}

/* End of file Industry_Type.php */
/* Location: ./application/controllers/Industry_Type.php */
