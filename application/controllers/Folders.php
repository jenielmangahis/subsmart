<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Folders extends MY_Controller {

	private $folders_with_files;

	public function __construct(){
		parent::__construct();

		$this->folders_with_files = array();
	}

	public function getfolders($use_internal = false, $load_files = false){
		$selected_folder = 0;
		if(isset($_GET['selected_folder'])){
			$selected_folder = $_GET['selected_folder'];
		}

		$result = array();
		$parents = getFoldersByRole(true);
		$parents = $parents->result();

		$isSelected = false;
		if(!empty($parents)){
			foreach ($parents as $key => $value) {
				$files = array();
				if(($load_files) && (!in_array($value->id, $this->folders_with_files))){
					$files = $this->getfolderfiles($value->id, $value->path);
				}

				$isSelected = ($value->id == $selected_folder);
				$folder = array(
					'id' => $value->id,
					'path' => $value->path,
					'isFile' => false,
					'text' => $value->folder_name,
					'state' => array('expanded' => false, 'selected' => $isSelected)
				);

				if(!empty($files)){
					$folder['nodes'] = $files;
				}

				array_push($result, $folder);		
			}
		}
		
		$children = getFoldersByRole(false, true);
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
		if($parent['id'] == $child->parent){
			$files = array();
			if(($load_files) && (!in_array($child->id, $this->folders_with_files))){
				$files = $this->getfolderfiles($child->id, $child->path);
			}

			$isSelected = ($child->id == $selected_folder);
			$folder = array(
				'id' => $child->id,
				'path' => $child->path,
				'isFile' => false,
				'text' => $child->folder_name,
				'state' => array('expanded' => false, 'selected' => $isSelected)
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
		$files = $this->vault_model->getByWhere(array('folder' => $folder_id));
		foreach ($files as $key => $value) {
			$file = array(
				'id' => $value->id,
				'path' => $folder_path . $value->fullfile,
				'isFile' => true,
				'text' => $value->fullfile,
				'icon' => $this->getfileicon($value->fullfile)
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

	public function save(){
		$return = array(
			'folders' => array(),
			'error' => ''
		);

		$uid = logged('id');
		$role_id = logged('role');
		$company_id = logged('company_id');
		$parent = 0;

		if(isset($_POST['roles'])){
			$roles = $_POST['roles'];
		} else {
			$roles = array();
		}

		$folder_name = $_POST['folder_name'];
		if(isset($_POST['parent_folder_id'])){
			$parent = $_POST['parent_folder_id'];	
		}

		$sql = 'select count(*) as `count` from folders where folder_name = "'. $folder_name .'" and parent = ' . $parent;
		$folder = $this->db->query($sql)->row();
		if($folder->count <= 0){
	
			if($parent != 0){
				$parent_folder = $this->db->get_where('folders', array('id' => $parent))->row();

				$path = $parent_folder->path . $folder_name . '/';
			} else {
				$path = '/' . $folder_name . '/';
			}

			$sql = 'select '.

				   'folder_order '.

				   'from folders '.

				   'where company_id = ' . $company_id . ' ' .

				   'order by folder_order DESC ' .

				   'limit 1';


			$folder_order = $this->db->query($sql);
			if($folder_order->num_rows() <= 0){
				$folder_order = 1;
			} else {
				$folder_order = $folder_order->row();
				$folder_order = $folder_order->folder_order + 1;
			}

			$data = array(
				'uid' => $uid,
				'folder_name' => $folder_name,
				'path' => $path,
				'parent' => $parent,
				'company_id' => $company_id,
				'folder_order' => $folder_order 
			);

			if($this->folders_model->trans_create($data)){

				$sql = 'select id from folders where uid = ' . $uid . ' order by folder_order DESC limit 1';
				$last_record = $this->db->query($sql)->row();

				$data_batch = array();
				$new_data = array(
					'folder_id' => $last_record->id,
					'role_id' => $role_id
				);

				array_push($data_batch, $new_data);

				foreach ($roles as $key => $value) {
					$new_data = array(
						'folder_id' => $last_record->id,
						'role_id' => $value['role_id']
					);

					array_push($data_batch, $new_data);
				}


				if($this->folders_permissions_model->trans_create($data_batch, true)){
					if(!file_exists('./uploads/')){
						mkdir('./uploads/');
					}

					if(!file_exists('./uploads' . $path)){
						mkdir('./uploads' . $path);
					}

					$return['folders'] = $this->getfolders(true);
				} else {
					$return['error'] = 'Error creating folder';	
				}
			} else {
				$return['error'] = 'Error creating folder';
			}

		} else {

			$return['error'] = 'Folder name already exists';
				
		}

		echo json_encode($return);
	}

	public function delete(){
		$return = array(
			'folders' => array(),
			'error' => ''
		);

		$folder_id = $_POST['folder_id'];
		
		$sql = 'select count(*) as `count` from filevault where folder = ' . $folder_id;
		$fcount = $this->db->query($sql)->row();
		$fcount = $fcount->count;

		$sql = 'select count(*) as `count` from folders where parent = ' . $folder_id;
		$scount = $this->db->query($sql)->row();
		$scount = $scount->count;

		$folder = $this->folders_model->getById($folder_id);

		if($fcount > 0){
			$return['error'] = 'Folder has files in it';
		} else if($scount > 0){
			$return['error'] = 'Folder has sub folders in it';
		} else {

			if(($this->folders_permissions_model->trans_delete(array(), array('folder_id' => $folder_id))) &&
			   ($this->folders_model->trans_delete(array(), array('id' => $folder_id)))){
				if(file_exists('./uploads' . $folder->path)){
					rmdir('./uploads' . $folder->path);

					$return['folders'] = $this->getfolders(true);
				}
			}
		}

		echo json_encode($return);
	}

	public function update_permissions(){
		$return = array(
			'error' => ''
		);

		$role_id = logged('role');
		$folder_id = $_POST['folder_id'];
		if(isset($_POST['roles'])){
			$roles = $_POST['roles'];
		} else {
			$roles = array();
		}

		if($this->db->query('delete from folders_permissions where folder_id = ' . $folder_id . ' and role_id <> ' . $role_id)){
			$data_batch = array();

			foreach ($roles as $key => $value) {
				$new_data = array(
					'folder_id' => $folder_id,
					'role_id' => $value['role_id']
				);

				array_push($data_batch, $new_data);
			}

			if(!$this->folders_permissions_model->trans_create($data_batch, true)){
				$return['error'] = 'Error in recreate folder permissions';
			}
		} else {
			$return['error'] = 'Error in reset folder permissions';
		}
		
		echo json_encode($return);
	}

	public function getFolderPermissions(){
		$folder_id = $_GET['folder_id'];

		$return = $this->db->get_where('folders_permissions', array('folder_id' => $folder_id))->result_array();

		echo json_encode($return);
	}
}

?>