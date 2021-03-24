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
        $is_allowed = $this->isAllowedModuleAccess(50);
        if( !$is_allowed ){
            $this->page_data['module'] = 'affiliates';
            echo $this->load->view('no_access_module', $this->page_data, true);
            die();
        }

		// ifPermissions('activity_log_list');
		$get = $this->input->get();
        $role_id = logged('role');
        if( $role_id == 1 || $role_id == 2 ){
            $arg = array();
        }else{
            $arg = array('company_id'=>logged('company_id'));
        }

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

	public function edit()
	{
		// ifPermissions('activity_log_view');
		$get = $this->input->get();

		$this->page_data['affiliate'] = $this->affiliate_model->getById($get['id']);
		$this->load->view('affiliate/add', $this->page_data);

	}

	// public function view($id)
	// {
	// 	ifPermissions('activity_log_view');
	// 	$this->page_data['activity'] = $this->activity_model->getById($id);
	// 	$this->load->view('activity_logs/view', $this->page_data);

	// }

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

		if ($this->input->post('affiliate_id') != '') {
			$permission = $this->affiliate_model->update($data, array("id" => $this->input->post('affiliate_id')));
		} else {
			$permission = $this->affiliate_model->create($data);
		}

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

	public function delete() {
        $get = $this->input->get();

		$this->affiliate_model->delete($get['id']);

        $message_2 = "Affiliate deleted Successfully";
		$this->session->set_flashdata('alert-type', 'success');
		$this->session->set_flashdata('alert', $message_2);

        redirect('affiliate');
	}

	public function exportAffiliates()
    {
        $affiliates = $this->affiliate_model->getByCompanyId(logged('company_id'));
        $delimiter = ",";
        $filename = "my_affiliates_".date('m-d-Y').".csv";

        $f = fopen('php://memory', 'w');

        $fields = array('First Name', 'Last Name', 'Company', 'Email', 'Phone', 'PhoneExt', 'Alternate Phone', 'Fax', 'Gender', 'Status', 'Register Date', 'Internal Note', 'Mailing Address', 'Mailing City', 'Mailing State', 'Mailing Zip', 'Mailing Country', 'Website URL');
        fputcsv($f, $fields, $delimiter);

        if (!empty($affiliates)) {
            foreach ($affiliates as $affiliate) {
                $csvData = array($affiliate->first_name, $affiliate->last_name, $affiliate->company, $affiliate->email, $affiliate->phone, $affiliate->phone_ext, $affiliate->alternate_phone, $affiliate->fax, $affiliate->gender, $affiliate->status, $affiliate->date_created, $affiliate->notes, $affiliate->mailing_address, $affiliate->city, $affiliate->state, $affiliate->zipcode, "United States", $affiliate->website_url);
                fputcsv($f, $csvData, $delimiter);
            }
        } else {
            $csvData = array('');
            fputcsv($f, $csvData, $delimiter);
        }

        fseek($f, 0);

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '";');

        fpassthru($f);
    }

    public function importAffiliates () {
        $data = array();
        $itemData = array();
        $last_id = 0;

        // if ($this->input->post('importSubmit')) {
            $this->form_validation->set_rules('file', 'CSV file', 'callback_file_check');

            if ($this->form_validation->run() == true) {
                $insertCount = $updateCount = $rowCount = $notAddCount = 0;

                if (is_uploaded_file($_FILES['file']['tmp_name'])) {
                    $this->load->library('CSVReader');

                    $csvData = $this->csvreader->parse_csv($_FILES['file']['tmp_name']);

                    if (!empty($csvData)) {
                        foreach ($csvData as $row) {
                            $rowCount++;

                            $itemData = array(
                                'company_id' => logged('company_id'),
                                'first_name' => $row['First Name'],
                                'last_name' => $row['Last Name'],
                                'company' => $row['Company'],
                                'email' => $row['Email'],
                                'phone' => $row['Phone'],
                                'phone_ext' => $row['PhoneExt'],
                                'alternate_phone' => $row['Alternate Phone'],
                                'fax' => $row['Fax'],
                                'gender' => $row['Gender'],
                                'status' => $row['Status'],
                                'notes' => $row['Internal Note'],
                                'mailing_address' => $row['Mailing Address'],
                                'city' => $row['Mailing City'],
                                'state' => $row['Mailing State'],
                                'zipcode' => $row['Mailing Zip'],
                                'country' => $row['Mailing Country'],
                                'website_url' => $row['Website URL']
                            );

                            $con = array(
                                'where' => array(
                                    'first_name' => $row['First Name'],
                                    'last_name' => $row['Last Name']
                                ),
                                'returnType' => 'count'
							);

							$prevCount = $this->affiliate_model->getRows($con);

                            if ($prevCount > 0) {
                                $condition = array('first_name' => $row['First Name'], 'last_name' => $row['Last Name']);
                                $update = $this->affiliate_model->update($itemData, $condition);
                                $updateItem = $this->affiliate_model->getByName($row['First Name'], $row['Last Name']);
                                $last_id = $updateItem[0]->id;
                                if ($update) {
                                    $updateCount++;
                                }
                            } else {
                                $insert = $this->affiliate_model->insert($itemData);
                                $last_id = $insert;

                                if ($insert) {
                                    $insertCount++;
                                }
                            }
                        }

                        $notAddCount = ($rowCount - ($insertCount + $updateCount));
                        $successMsg = 'affiliates imported successfully. Total Rows ('.$rowCount.') | Inserted ('.$insertCount.') | Updated ('.$updateCount.') | Not Inserted ('.$notAddCount.')';
                        $this->session->set_userdata('success_msg', $successMsg);

                        $this->activity_model->add($successMsg);
                        $this->session->set_flashdata('alert-type', 'success');
                        $this->session->set_flashdata('alert', $successMsg);
                    }
                } else {
                    $this->session->set_userdata('error_msg', 'Error on file upload, please try again.');
                }
            } else {
                $this->session->set_userdata('error_msg', 'Invalid file, please select only CSV file.');
            }
        // }
        redirect('affiliate');
    }

    /*
     * Callback function to check file value and type during validation
     */
    public function file_check($str){
        $allowed_mime_types = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
        if(isset($_FILES['file']['name']) && $_FILES['file']['name'] != ""){
            $mime = get_mime_by_extension($_FILES['file']['name']);
            $fileAr = explode('.', $_FILES['file']['name']);
            $ext = end($fileAr);
            if(($ext == 'csv') && in_array($mime, $allowed_mime_types)){
                return true;
            }else{
                $this->form_validation->set_message('file_check', 'Please select only CSV file to upload.');
                return false;
            }
        }else{
            $this->form_validation->set_message('file_check', 'Please select a CSV file to upload.');
            return false;
        }
    }

}

/* End of file Activity_logs.php */
/* Location: ./application/controllers/Activity_logs.php */
