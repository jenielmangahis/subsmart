<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Folders extends MY_Controller {

	private $folders_with_files;
	private $selected_folder;
	private $company_folder = '';

	public function __construct(){
		parent::__construct();

		$this->folders_with_files = array();
		$this->selected_folder = 0;
		$this->company_folder = getCompanyFolder();
	}

	public function getfolders($use_internal = false, $load_files = false){
		$selected_folder = 0;
		if($this->selected_folder == 0){
			if(isset($_GET['selected_folder'])){
				$selected_folder = $_GET['selected_folder'];
			}
		} else {
			$selected_folder = $this->selected_folder;
		}

		$result = array();
		$parents = getFolders(true);
		$parents = $parents->result();

		$isSelected = false;
		if(!empty($parents)){
			foreach ($parents as $key => $value) {
				$files = array();
				if(($load_files) && (!in_array($value->folder_id, $this->folders_with_files))){
					$files = $this->getfolderfiles($value->folder_id, $value->path);
				}

				$isSelected = ($value->folder_id == $selected_folder);
				$folder = array(
					'id' => $value->folder_id,
					'path' => $value->path,
					'isFile' => false,
					'text' => $value->folder_name,
					'state' => array('expanded' => $isSelected, 'selected' => false)
				);

				if(!empty($files)){
					$folder['nodes'] = $files;
				}

				array_push($result, $folder);		
			}
		}
		
		$children = getFolders(false, true);
		$children = $children->result();

		foreach ($children as $c => $child) {
			foreach ($result as &$parent) {
				if($this->findandupdatefolder($parent, $child, $selected_folder, $load_files)){
					unset($parent);

					break;
				}

				unset($parent);
			}	
		}

		if(!$use_internal){
			echo json_encode($result);
		} else {
			return $result;
		}
	}

	public function getfiles(){
		$result = $this->getfolders(true, true);
		
		echo json_encode($result);
	}

	private function findandupdatefolder(&$parent, $child, $selected_folder, $load_files){
		if($parent['id'] == $child->parent_id){
			$files = array();
			if(($load_files) && (!in_array($child->folder_id, $this->folders_with_files))){
				$files = $this->getfolderfiles($child->folder_id, $child->path);
			}

			$isSelected = ($child->folder_id == $selected_folder);
			$folder = array(
				'id' => $child->folder_id,
				'path' => $child->path,
				'isFile' => false,
				'text' => $child->folder_name,
				'state' => array('expanded' => $isSelected, 'selected' => false)
			);

			if(!empty($files)){
				$folder['nodes'] = $files;
			}

			if(!array_key_exists('nodes', $parent)){
				$parent['nodes'] = array();
			}
			
			array_push($parent['nodes'], $folder);

			return TRUE;
		} else if(array_key_exists('nodes', $parent)){
			if(count($parent['nodes'])){
				foreach ($parent['nodes'] as &$node) {
					if($this->findandupdatefolder($node, $child, $selected_folder, $load_files)){
						unset($node);

						return TRUE;

						break;
					}

					unset($node);
				}
			}
		} else {
			return FALSE;
		}
	}

	private function getfolderfiles($folder_id, $folder_path){
		$return = array();
		$files = $this->vault_model->getByWhere(array('folder_id' => $folder_id));
		foreach ($files as $key => $value) {
			$file = array(
				'id' => $value->file_id,
				'path' => $value->file_path,
				'isFile' => true,
				'text' => $value->title,
				'icon' => $this->getfileicon($value->file_path)
			);

			array_push($return, $file);
		}

		array_push($this->folders_with_files, $folder_id);

		return $return;
	}

	private function getfileicon($filename){
		$ext = pathinfo($filename);
		$ext = $ext['extension'];

		switch ($ext) {
			case 'pdf':
				$return = 'fa fa-file-pdf-o';
				break;
			case 'doc':
			case 'docx':
				$return = 'fa fa-file-word-o';
			case 'rtf':
				$return = 'fa fa-file-text-o';
			case 'png':
			case 'jpg':
			case 'gif':
				$return = 'fa fa-file-image-o';
			default:
				$return = 'fa fa-file-o';
				break;
		}

		return $return;
	}

	public function create(){
		$uid = logged('id');
		$company_id = logged('company_id');

		if($this->company_folder != ''){
			$return = array(
				'file_folders' => array(),
				'error' => ''
			);

			$folder_name = $_POST['folder_name'];
			$parent_id = 0;
			if(isset($_POST['parent_id'])){
				$parent_id = $_POST['parent_id'];
			}

			$description = '';
			$path = '';

			$record = $this->db->query('select count(*) as `existing` from file_folders where lower(folder_name) = "' . strtolower($folder_name) . '" and parent_id = ' . $parent_id)->row();
			$record = $record->existing;

			if($record > 0){
				$return['error'] = 'Folder already exists';
			} else {
				$parent_folder = $this->db->query('select * from file_folders where folder_id = ' . $parent_id);
				if($parent_folder->num_rows() > 0){
					$parent_folder = $parent_folder->row();

					$path = $parent_folder->path . $folder_name . '/';
				} else {
					$path = '/' . $folder_name . '/';
				}

				if(isset($_POST['folder_desc'])){
					$description = $_POST['folder_desc'];
				}

				$data = array(
					'folder_name' => $folder_name,
					'parent_id' => $parent_id,
					'description' => $description,
					'path' => $path,
					'created_by' => $uid,
					'create_date' => date('Y-m-d h:i:s'),
					'company_id' => $company_id
				);

				if($this->folders_model->trans_create($data)){
					mkdir('./uploads/' . $this->company_folder . $path, 0777);

					$latest_folder_id = $this->db->query('select max(folder_id) as `latest_folder_id` from file_folders where company_id = ' . $company_id)->row();
					$latest_folder_id = $latest_folder_id->latest_folder_id;

					$this->selected_folder = $latest_folder_id;

					$return['file_folders'] = $this->getfolders(true, true);
				} else {
					$return['error'] = 'Error in creating folder. Please contact our support';
				}
			}
		} else {
			$return['error'] = 'Error in initializing root folder';
		}

		echo json_encode($return);
	}

	public function delete(){ 
		$return = array(
			'file_folders' => array(),
			'error' => ''
		);

		$folder_id = $_POST['folder_id'];
		$parent_id = 0;

		$files = $this->db->query('select count(*) as `filescount` from filevault where folder_id = ' . $folder_id)->row();
		$folders = $this->db->query('select count(*) as `folderscount` from file_folders where parent_id = ' . $folder_id)->row();
		if(($files->filescount > 0) || ($folders->folderscount > 0)){
			$return['error'] = 'Cannot delete folder. Folder is not empty.';
		} else {
			$folder = $this->folders_model->getById($folder_id);
			$delete_result = $this->folders_model->trans_delete(array(), array('folder_id' => $folder_id));
			if($delete_result['status']){
				rmdir('./uploads/' . $this->company_folder . $folder->path);

				$this->selected_folder = $folder->parent_id;

				$return['file_folders'] = $this->getFolders(true, true);
			} else {
				$return['error'] = $delete_result['message'];
			}
		}

		echo json_encode($return);
	}

	public function update_permissions(){
	}

	public function getFolderPermissions(){
	}
}

?>