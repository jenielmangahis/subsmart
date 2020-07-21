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

		add_css(array( 
            'https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css',
            'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css',
            'https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css',
            'https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css',
        ));

        // JS to add only Job module
        add_footer_js(array(
            'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js',
            'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js',
            'https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js',
            'https://code.jquery.com/ui/1.12.1/jquery-ui.js',
            'https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js',
            'assets/frontend/js/beforeafter/main.js'
        ));
	}

	public function index()
	{	
		$this->page_data['folder_manager'] = getFolderManagerView();
		$this->load->view('vault/list', $this->page_data);
	}

	public function shared_library()
	{	
		$this->page_data['folder_manager'] = getFolderManagerView();
		$this->load->view('vault/shared_library', $this->page_data);
	}

	public function beforeafter()
	{	
        $this->load->model('Before_after_model', 'before_after_model');
		$comp_id = logged('company_id');

		$this->page_data['photos'] = $this->before_after_model->getByWhere(['company_id' => $comp_id]);
		$this->load->view('vault/beforeafter', $this->page_data);
	}

	public function businessformtemplates()
	{	
		$this->page_data['folder_manager'] = getFolderManagerView();
		$this->load->view('vault/businessformtemplates', $this->page_data);
	}

	public function add()
	{	
		$return = array(
			'error' => ''
		);

		$uid = logged('id');
		$company_id = logged('company_id');

		$folder_id = $_POST['folder_id'];
		$file_desc = '';
		if(isset($_POST['file_desc'])){
			$file_desc = $_POST['file_desc'];
		}

		if(!empty($_FILES['fullfile'])) {
			$filename = $_FILES['fullfile']['name'];
			$filesize = $_FILES['fullfile']['size'];

			if($filesize < 8000000){
				$ext = pathinfo($filename, PATHINFO_EXTENSION);

				$record = $this->db->query(
					'select count(*) as `existing` from filevault where folder_id = ' . $folder_id . ' and lower(title) = "' . strtolower($filename) . '"'
				)->row();

				if($record->existing <= 0){
					if($folder_id > 0){
						$folder = $this->folders_model->getById($folder_id);
						$folder_path = $folder->path;
					} else {
						$folder_path = '/';
					}

					$this->uploadlib->initialize([
						'file_name' => $filename
					]);

					$file = $this->uploadlib->uploadImage('fullfile', $this->company_folder . $folder_path);

					if($file['status']){
						$data = array(
							'title' => $filename,
							'description' => $file_desc,
							'file_path' => $folder_path . $filename,
							'modified' => date('Y-m-d h:i:s'),
							'created' => date('Y-m-d h:i:s'),
							'file_size' => $filesize,
							'folder_id' => $folder_id,
							'user_id' => $uid,
							'company_id' => $company_id
						);

						if(!$this->vault_model->trans_create($data)){
							$return['error'] = 'Error in uploading file';
						}
					}
				} else {
					$return['error'] = 'File already exists';	
				}
			} else {
				$return['error'] = 'File is larger than 8mb';
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

	public function most_downloads_files(){
		$company_id = logged('company_id');

		$sql = 'select ' . 

               'a.*, '.
               'b.FName as FCreatedBy, b.LName as LCreatedBy, '.
               'c.folder_name '.

               'from filevault a '.
               'left join users b on b.id = a.user_id '.
               'left join business_profile c on c.id = a.company_id '.

               'where a.company_id = ' . $company_id . ' and a.downloads_count is not null ' . 

               'order by downloads_count DESC limit 10';

        $return = $this->db->query($sql)->result_array();

        echo json_encode($return);							
	}

	public function most_previewed_files(){
		$company_id = logged('company_id');

		$sql = 'select ' . 

               'a.*, '.
               'b.FName as FCreatedBy, b.LName as LCreatedBy, '.
               'c.folder_name '.

               'from filevault a '.
               'left join users b on b.id = a.user_id '.
               'left join business_profile c on c.id = a.company_id '.

               'where a.company_id = ' . $company_id . ' and a.previews_count is not null ' . 

               'order by previews_count DESC limit 10';

        $return = $this->db->query($sql)->result_array();

        echo json_encode($return);	
	}

	public function recently_uploaded_files(){
		$company_id = logged('company_id');

		$sql = 'select ' . 

               'a.*, '.
               'DATEDIFF(NOW(), a.created) as `days`, '.
               'b.FName as FCreatedBy, b.LName as LCreatedBy, '.
               'c.folder_name '.

               'from filevault a '.
               'left join users b on b.id = a.user_id '.
               'left join business_profile c on c.id = a.company_id '.

               'where a.company_id = ' . $company_id . ' and (DATEDIFF(NOW(), a.created) <= 3) ' . 

               'order by created DESC limit 10';

        $return = $this->db->query($sql)->result_array();

        echo json_encode($return);		
	}

	public function download_file($file_id){
		$file = $this->vault_model->getById($file_id);
		$path = '/uploads/' . $this->company_folder . $file->file_path;
		$fc = file_get_contents($path);

		$data = array(
			'downloads_count' => $file->downloads_count + 1
		);

		$status = $this->vault_model->trans_update($data, array('file_id' => $file_id));

		force_download($file->title, $fc);
	}

	public function update_preview($file_id){
		$file = $this->vault_model->getById($file_id);
		$data = array(
			'previews_count' => $file->previews_count + 1
		);

		$status = $this->vault_model->trans_update($data, array('file_id' => $file_id));	
	}

}

/* End of file Permissions.php */
/* Location: ./application/controllers/Permissions.php */