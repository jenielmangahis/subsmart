<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Affiliate extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
        $this->checkLogin();
		$this->page_data['page']->title = 'Affiliate';
		$this->page_data['page']->menu = 'affiliate';
        $this->load->model('Affiliate_model', 'affiliate_model');

		add_css(array( 
            'https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css',
            'https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css',
        ));

        // JS to add only Job module
        add_footer_js(array(
            'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js',
            'https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js',
            'assets/frontend/js/affiliate/main.js'
        ));
	}

	public function index()
	{
		// ifPermissions('activity_log_list');
		$arg = array('company_id'=>logged('company_id'));
		$this->page_data['affiliates'] = $this->affiliate_model->getByWhere($arg, [
			'order' => [ 'id', 'desc' ]
		]);
		$this->load->view('affiliate/list', $this->page_data);

	}

	public function add()
	{
		// ifPermissions('activity_log_view');
		// $this->page_data['activity'] = $this->activity_model->getById($id);
		$this->load->view('affiliate/add', $this->page_data);

	}

	public function view($id)
	{
		ifPermissions('activity_log_view');
		$this->page_data['activity'] = $this->activity_model->getById($id);
		$this->load->view('activity_logs/view', $this->page_data);

	}

	public function saveAffiliate() 
    {
        postAllowed();
		$comp_id = logged('company_id');
		$target_dir = "./uploads/affiliate/$comp_id/";
		
		if(!file_exists($target_dir)) {
			mkdir($target_dir, 0777, true);
		}

		$affiliate_image = $this->moveUploadedFile();

        $data = array(
            'company_id' => $comp_id,
            'first_name' => $this->input->post('first_name'),
            'last_name' => ucfirst($this->input->post('last_name')),
            'gender' => $this->input->post('genderRadioOptions'),
            'company' => $this->input->post('company'),
            'website_url' => $this->input->post('website_url'),
            'email' => $this->input->post('email'),
            'phone' => $this->input->post('phone'),
            'phone_ext' => $this->input->post('phone_ext'),
            'alternate_phone' => $this->input->post('alternate_phone'),
            'fax' => $this->input->post('fax'),
            'mailing_address' => $this->input->post('mailing_address'),
            'city' => $this->input->post('city'),
            'state' => $this->input->post('state'),
            'status' => $this->input->post('status'),
            'notes' => $this->input->post('notes'),
            'photo' => $affiliate_image,
            'assigned_to' => 1,
            'add_master_contact_list' => $this->input->post('add_masterlist'),
            'portal_access' => $this->input->post('portal_access'),
        );

        $message_1 = "New";
        $message_2 = "New affiliate Created Successfully";

        $permission = $this->affiliate_model->create($data);

        $this->activity_model->add($message_1 . " item #$permission Created by User: #" . logged('id'));
        $this->session->set_flashdata('alert-type', 'success');
        $this->session->set_flashdata('alert', $message_2);
        
        redirect('affiliate');
    }

	public function moveUploadedFile() {
		$comp_id = logged('company_id');
		if(isset($_FILES['image']) && $_FILES['image']['tmp_name'] != '') {
			$tmp_name = $_FILES['image']['tmp_name'];
			$extension	 = strtolower(end(explode('.',$_FILES['image']['name'])));
			// basename() may prevent filesystem traversal attacks;
			// further validation/sanitation of the filename may be appropriate
			$name = basename($_FILES["image"]["name"]);
			move_uploaded_file($tmp_name, "./uploads/affiliate/$comp_id/$name");

			return $name;
		}
	}

}

/* End of file Activity_logs.php */
/* Location: ./application/controllers/Activity_logs.php */