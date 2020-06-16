<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vault extends MY_Controller {

	private $company_folder = '';

	public function __construct()
	{
		parent::__construct();
		$this->page_data['page']->title = 'Files Management';
		$this->page_data['page']->menu = 'vault';

		$this->company_folder = getCompanyFolder();
	}

	public function index()
	{	
		$this->page_data['folder_manager'] = getFolderManagerView();
		$this->load->view('vault/list', $this->page_data);
	}

	public function add()
	{	
		$return = array(
			'error' => ''
		);

		$uid = logged('id');

		$folder_id = $_POST['folder_id'];
		$file_desc = '';
		if(isset($_POST['file_desc'])){
			$file_desc = $_POST['file_desc'];
		}

		if(!empty($_FILES['fullfile'])) {
			$filename = $_FILES['fullfile']['name'];
			$filesize = $_FILES['fullfile']['size'];

			$ext = pathinfo($filename, PATHINFO_EXTENSION);

			$record = $this->db->query(
				'select count(*) as `existing` from filevault where folder_id = ' . $folder_id . ' and lower(title) = "' . strtolower($filename) . '"'
			)->row();

			if($record->existing <= 0){
				$folder = $this->folders_model->getById($folder_id);

				$this->uploadlib->initialize([
					'file_name' => $filename
				]);

				$file = $this->uploadlib->uploadImage('fullfile', $this->company_folder . $folder->path);

				if($file['status']){
					$data = array(
						'title' => $filename,
						'description' => $file_desc,
						'file_path' => $folder->path . $filename,
						'modified' => date('Y-m-d h:i:s'),
						'created' => date('Y-m-d h:i:s'),
						'file_size' => $filesize,
						'folder_id' => $folder_id,
						'user_id' => $uid,
						'company_id' => $folder->company_id
					);

					if(!$this->vault_model->trans_create($data)){
						$return['error'] = 'Error in uploading file';
					}
				}
			} else {
				$return['error'] = 'File already exists';	
			}
		} else {
			$return['error'] = 'No file to upload';
		}

		echo json_encode($return);
	}

	public function delete(){
		$return = array(
			'folder_id' => 0,
			'error' => ''
		);		

		$file_id = $_POST['file_id'];
		$file = $this->vault_model->getById($file_id);

		if($this->vault_model->trans_delete(array(), array('file_id' => $file_id))){
			unlink('./uploads/' . $this->company_folder . $file->file_path);

			$return['folder_id'] = $file->folder_id;
		} else {
			$return['error'] = 'Error in deleting file';
		}

		echo json_encode($return);
	}

	public function file_exists(){
		$return = false;

		echo $return;
	}

}

/* End of file Permissions.php */
/* Location: ./application/controllers/Permissions.php */