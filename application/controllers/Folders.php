<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Folders extends MY_Controller {

	private $folders_with_files;
	private $selected_folder;
	private $company_folder = '';

	public function __construct(){
		parent::__construct();
		$this->checkLogin();
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
		$parents = getFolders(-1, true);
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
		
		$children = getFolders(-1, false, true);
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
		$result = $this->getfolders(-1, true, true);
		
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
				break;
			case 'rtf':
				$return = 'fa fa-file-text-o';
				break;
			case 'png':
			case 'jpg':
			case 'gif':
				$return = 'fa fa-file-image-o';
				break;
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
				'latest_folder' => array(),
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

					$latest_folder = $this->db->query($sql = 'select ' . 

		               'a.*, '.
		               'b.FName as FCreatedBy, b.LName as LCreatedBy, '.
		               'c.folder_name as c_folder '.

		               'from file_folders a '.
		               'left join users b on b.id = a.created_by '.
		               'left join business_profile c on c.id = a.company_id '.

		               'where a.company_id = ' . $company_id . ' and a.created_by = ' . $uid . ' ' .

		               'order by create_date DESC limit 1')->row();

					$return['latest_folder'] = $latest_folder;
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
			'error' => ''
		);

		$folder_id = $_POST['folder_id'];
		$parent_id = 0;

		$files = $this->db->query('select count(*) as `filescount` from filevault where folder_id = ' . $folder_id)->row();
		$folders = $this->db->query('select count(*) as `folderscount` from file_folders where parent_id = ' . $folder_id)->row();
		if(($files->filescount > 0) || ($folders->folderscount > 0)){
			$return['error'] = 'Cannot delete folder. Folder is not empty.';
		} else {			
			$data = array(
				'softdelete' => 1,
				'softdelete_date' => date('Y-m-d h:i:s')
			);

			if(!$this->folders_model->trans_update($data, array('folder_id' => $folder_id))){
				$return['error'] = 'Error in deleting folder';
			}
		}

		echo json_encode($return);	
	}

	public function remove(){ 
		$return = array(
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

				//$return = getFoldersFiles($folder->parent_id, true);
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

	public function getFoldersFiles($parent_id = 0, $internal = false){
		if($parent_id == 0){
			$folders_path = '/<a control="gotofolder" href="0">root</a>/';
			$folders_name = 'Root';
		} else {
			$folders_path = '';
			$folders_name = '';
			$sql = 'select '.

				   'folder_id, '.
				   'folder_name, '.
				   'parent_id '.

				   'from file_folders '.

				   'where folder_id = @';

			$cSql = str_replace('@', $parent_id, $sql);
			$folder = $this->db->query($cSql)->row();

			$folders_name = $folder->folder_name;
			$folders_path = '<a control="gotofolder" href="'. $folder->folder_id .'">' . $folder->folder_name . '</a>/' . $folders_path; 
			
			$cSql = str_replace('@', $folder->parent_id, $sql);
			$folder = $this->db->query($cSql);
			while($folder->num_rows() > 0){
				$folder = $folder->row();
				

				$folders_path = '<a control="gotofolder" href="'. $folder->folder_id .'">' . $folder->folder_name . '</a>/' . $folders_path; 

				$cSql = str_replace('@', $folder->parent_id, $sql);
				$folder = $this->db->query($cSql);
			}

			$folders_path = '/<a control="gotofolder" href="0">root</a>/' . $folders_path;
		}

		$return = array(
			'folders' => getFolders($parent_id, false, false, true),
			'files' => getFiles($parent_id, true),
			'folders_path' => $folders_path,
			'folders_name' => $folders_name,
			'error' => ''
		);

		if(!$internal){
			echo json_encode($return);
		} else {
			return $return;
		}
	}

	public function getTrashRecords(){
		$return = array(
			'folders' => getFolders(-1, false, false, true, true),
			'files' => getFiles(-1, true, true)
		);

		echo json_encode($return);
	}

	public function restoreFileOrFolder(){
		$return = array(
			'folder_id' => 0,
			'error' => ''
		);

		$fid = $_POST['fid'];
		$isFolder = $_POST['isFolder'];

		$data = array(
			'softdelete' => 0
		);

		if($isFolder == 1){
			$f = $this->folders_model->getById($fid);
			$folder_id = $f->parent_id;

			if(!$this->folders_model->trans_update($data, array('folder_id' => $fid))){
				$return['error'] = 'Error restoring folder';
			}
		} else {
			$f = $this->vault_model->getById($fid);
			$folder_id = $f->folder_id;

			if(!$this->vault_model->trans_update($data, array('file_id' => $fid))){
				$return['error'] = 'Error restoring file';
			}
		}

		$return['folder_id'] = $folder_id;

		echo json_encode($return);
	}
}

?>