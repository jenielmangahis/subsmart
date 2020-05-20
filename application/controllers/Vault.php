<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vault extends MY_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->page_data['page']->title = 'Files Management';
		$this->page_data['page']->menu = 'vault';
	}

	public function index($folder_id = 0)
	{	
		$path = '';
		if($folder_id > 0){
			$folder = $this->folders_model->getById($folder_id);
			$path = $folder->path;
		}

		$this->page_data['files'] = $this->vault_model->getByWhere(array('folder' => $folder_id));
		$this->page_data['folder_manager'] = getFolderManagerView();
		$this->page_data['folder_id'] = $folder_id;
		$this->page_data['path'] = $path;
		$this->load->view('vault/list', $this->page_data);
	}

	public function add()
	{
		$this->page_data['folder_manager'] = getFolderManagerView();
		$this->load->view('vault/add', $this->page_data);
	}

	public function edit($id)
	{
		$vault = $this->vault_model->getById($id);
		$this->page_data['file'] = $vault;

		$folder_id = 0;
		$path = '';

		$folder = $this->folders_model->getById($vault->folder);
		$folder = (array) $folder;
		if(!empty($folder)){
			$folder_id = $folder['id'];
			$path = $folder['path'];
		}

		$this->page_data['folder_manager'] = getFolderManagerView();
		$this->page_data['folder_id'] = $folder_id;
		$this->page_data['path'] = $path;

		$this->load->view('vault/edit', $this->page_data);

	}

	public function save()
	{
		
		postAllowed();

		$folder_id = 0;
		$folder_path = '/files';

		if(!file_exists('./uploads/')){
			mkdir('./uploads/');
		}

		if(!file_exists('./uploads/files/')){
			mkdir('./uploads/files/');
		}


		if(!empty($this->input->post('fm_selected_folder'))){
			$sql = 'select * from folders where id = '. $this->input->post('fm_selected_folder');
			$folder = $this->db->query($sql)->row();

			$folder_id = $folder->id;
			$folder_path = $folder->path;
		}

		$cid=logged('comp_id');	
		$uid=logged('id');	
		$data = [
			'title' => $this->input->post('title'),
			'uid' => $uid,
			'comp_id' => $cid,
			'folder' => $folder_id
			// 'estimate_resource' => $this->input->post('estimate_resource'),
			// 'invoice_resource' => $this->input->post('invoice_resource')
		];
				
		$vaultid = $this->vault_model->create($data);
		
		if(!empty($_FILES['fullfile']['name'])) {

			$filename = $_FILES['fullfile']['name'];
			$ext = pathinfo($filename, PATHINFO_EXTENSION);
			$filename = str_replace(' ','_',$filename);
			$this->uploadlib->initialize([
				'file_name' => $filename
			]);

			$image = $this->uploadlib->uploadImage('fullfile', $folder_path);

			if($image['status']){
				$this->vault_model->update($vaultid, ['fullfile' => $filename]);
			}
		}
		
		

		//$this->activity_model->add("New File #$vault Created by User: #".logged('id'));

		// $this->session->set_flashdata('alert-type', 'success');
		// $this->session->set_flashdata('alert', 'New File Created Successfully');
		
		redirect('vault/' . $folder_id);

	}

	public function update()
	{
		
		postAllowed();

		ifPermissions('permissions_edit');

		$id = $this->input->post('vault_id');
		$folder_id = 0;
		$folder_path = '/files/';

		$vault = $this->vault_model->getById($id);
		if($vault->folder > 0){
			$folder_srce = $this->folders_model->getById($vault->folder);
			$folder_srce = $folder_srce->path;
		} else {
			$folder_srce = $folder_path;		
		}

		if(!empty($this->input->post('fm_selected_folder'))){
			$folder_dest = $this->folders_model->getById($this->input->post('fm_selected_folder'));

			$folder_id = $folder_dest->id;
			$folder_path = $folder_dest->path;
		}

		$data = [
			'title' => $this->input->post('title'),
			//'code' => $this->input->post('code'),
			'folder' => $folder_id
		];

		$file = $this->vault_model->update($id, $data);

		if(file_exists('./uploads' . $folder_srce . $vault->fullfile)){
			unlink('./uploads' . $folder_srce . $vault->fullfile);

			if(!empty($_FILES['fullfile']['name'])) {
				$filename = $_FILES['fullfile']['name'];
				$ext = pathinfo($filename, PATHINFO_EXTENSION);
				$filename = str_replace(' ','_',$filename);
				$this->uploadlib->initialize([
					'file_name' => $filename
				]);

				$image = $this->uploadlib->uploadImage('fullfile', $folder_path);

				if($image['status']){
					$this->vault_model->update($id, ['fullfile' => $filename]);
				}	
			}

		}	

		//$this->activity_model->add("File #$id Updated by User: #".logged('id'));

		// $this->session->set_flashdata('alert-type', 'success');
		// $this->session->set_flashdata('alert', 'File has been Updated Successfully');
		
		redirect('vault/' . $folder_id);

	}

	public function file_exists(){
		$return = false;

		$type = $_GET['type'];
		if($type == 'edit'){
			$id = $_GET['vault_id'];
		} else {
			$id = 0;
		}

		if(isset($_GET['filename'])){
			$filename = $_GET['filename'];
			$filename = pathinfo($filename);
			$filename = $filename['basename'];

			$sql = 'select id, count(*) as `count` from filevault where fullfile = "'. $filename .'"';
			if(isset($_GET['folder'])){
				$folder = $_GET['folder'];
				if(!empty($folder)){
					$sql .= ' and folder = ' . $folder;
				} else {
					$sql .= ' and (folder = 0 or folder is null)';	
				}
			} else {
				$sql .= ' and (folder = 0 or folder is null)';
			}

			$return = $this->db->query($sql)->row();
			$return = (($return->count > 0) && ($id != $return->id));
		}

		echo $return;
	}

	public function delete($id)
	{	

		ifPermissions('permissions_delete');

		//$this->vault_model->delete($id);

		$folder_id = 0;
		$folder_path = '/files/';

		$vault = $this->vault_model->getById($id);
		$filename = $vault->fullfile;

		if(!empty($vault->folder)){
			$folder = $this->folders_model->getById($vault->folder);
			$folder_id = $folder->id;
			$folder_path = $folder->path;
		}

		if($this->vault_model->trans_delete(array(), array('id' => $id))){
			unlink('./uploads' . $folder_path . $filename);
		}

		// $this->session->set_flashdata('alert-type', 'success');
		// $this->session->set_flashdata('alert', 'File has been Deleted Successfully');

		//$this->activity_model->add("File #$id Deleted by User: #".logged('id'));
		redirect('vault/' . $folder_id);
	}

}

/* End of file Permissions.php */
/* Location: ./application/controllers/Permissions.php */