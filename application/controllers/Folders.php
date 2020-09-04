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
			$category = '';
			if(isset($_POST['parent_id'])){
				$parent_id = $_POST['parent_id'];
			}

			if(isset($_POST['category'])){
				$category = $_POST['category'];
			}

			$description = '';
			$path = '';

			$record = $this->db->query('select count(*) as `existing`, category_id from file_folders where lower(folder_name) = "' . strtolower($folder_name) . '" and parent_id = ' . $parent_id . ' and company_id = ' . $company_id)->row();

			if($record->existing > 0){
				$return['error'] = 'Folder already exists';
				if(!empty($record->category_id)){
					$return['error'] .= ' in <strong>Business Form Templates</strong> section';
				}
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

				if($category != ''){
					$data['category_id'] = $category;
				}

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
		$uid = logged('id');

		$return = array(
			'error' => ''
		);

		$section = $_POST['section'];
		$folder_id = $_POST['folder_id'];
		$parent_id = 0;

		$folder = $this->folders_model->getById($folder_id);
		$files = $this->db->query('select count(*) as `filescount` from filevault where folder_id = ' . $folder_id . ' and softdelete <= 0')->row();
		$folders = $this->db->query('select count(*) as `folderscount` from file_folders where parent_id = ' . $folder_id . ' and softdelete <= 0')->row();
		if(($files->filescount > 0) || ($folders->folderscount > 0)){
			$return['error'] = 'Cannot delete folder. Folder is not empty.';
		} else if(($folder->created_by != $uid) && (($section == 'sharedlibrary') || ($section == 'businessformtemplates'))){
			$return['error'] = 'Cannot delete folder. Folder is not yours.';
		} else {			
			$data = array(
				'softdelete' => 1,
				'softdelete_date' => date('Y-m-d h:i:s'),
				'softdelete_by' => $uid
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

	public function getFoldersFiles($parent_id = 0, $getByCurrentUser = 0, $getByWithCategory = 0, $internal = false){
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

		$ofUser = ($getByCurrentUser == 1);
		$ofCategorized = ($getByWithCategory == 1);

		$return = array(
			'folders' => getFolders($parent_id, false, false, true, false, $ofUser, $ofCategorized),
			'files' => getFiles($parent_id, true, false, $ofUser, $ofCategorized),
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

	public function getTrashRecords($getByCurrentUser = 0, $getByWithCategory = 0){

		$ofUser = ($getByCurrentUser == 1);
		$ofCategorized = ($getByWithCategory == 1);

		$return = array(
			'folders' => getFolders(-1, false, false, true, true, $ofUser, $ofCategorized),
			'files' => getFiles(-1, true, true, $ofUser, $ofCategorized)
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

			$continue = true;
			if($folder_id != 0){
				$folder = $this->folders_model->getById($folder_id);
				$continue = ($folder->softdelete <= 0);
			}

			if($continue){
				if(!$this->folders_model->trans_update($data, array('folder_id' => $fid))){
					$return['error'] = 'Error restoring folder';
				}
			} else {
				$return['error'] = 'Parent folder is also in trash.</br>Please restore the parent folder first.';	
			}
		} else {
			$f = $this->vault_model->getById($fid);
			$folder_id = $f->folder_id;

			$continue = true;
			if($folder_id != 0){
				$folder = $this->folders_model->getById($folder_id);
				$continue = ($folder->softdelete <= 0);
			}
			
			if($continue){
				if(!$this->vault_model->trans_update($data, array('file_id' => $fid))){
					$return['error'] = 'Error restoring file';
				}
			} else {
				$return['error'] = 'Parent folder is also in trash.</br>Please restore the parent folder first.';
			}
		}

		$return['folder_id'] = $folder_id;

		echo json_encode($return);
	}

	public function move($to_folder = 0, $folder_id = 0){
		$uid = logged('id');
		$company_id = logged('company_id');

		$return = array(
			'error' => ''
		);

		if($folder_id == 0){
			$return['error'] = 'Please select folder to move';
		} else if($to_folder == $folder_id){
			$return['error'] = 'Moving to self is not allowed at the moment';
		} else if($this->IfSameAncestor($to_folder, $folder_id)){ 
			$return['error'] = 'Moving to sub folder is not allowed at the moment';
	    } else {
			$folder = $this->folders_model->getById($folder_id);
			$exists_count = $this->db->query(
				'select count(*) as `exists` from file_folders where parent_id = ' . $to_folder . ' and lower(folder_name) = "' . strtolower($folder->folder_name) . '" and company_id = ' . $company_id
			)->row();

			if($exists_count->exists > 0){
				$return['error'] = 'Cannot move. Folder name already exists in the destination folder';
			} else {
			//create top folder initially ---------------------------------------------------------------------------------
				$parent_folder = $this->db->query('select * from file_folders where folder_id = ' . $to_folder)->row();

				$this->recurseFolder($to_folder, $parent_folder, $folder, true);
			}
		}

		echo json_encode($return);
	}

	private function IfSameAncestor($to_folder_id, $folder_id){
		if($to_folder_id != 0){
			$to_folder = $this->folders_model->getById($to_folder_id);
			$parent_id = $to_folder->parent_id;
			while($parent_id > 0){
				if($parent_id == $folder_id){
					return TRUE;

					break;
				} else {
					$to_folder = $this->folders_model->getById($parent_id);
					$parent_id = $to_folder->parent_id;	
				}
			}

			return FALSE;
		} else {
			return FALSE;
		}
	}

	private function recurseFolder($to_folder_id, $to_folder, $folder, $move = false, $repath = false){
		$uid = logged('id');

		if($move){
			$old_path = './uploads/' . $this->company_folder . $folder->path;
			if($to_folder_id == 0){
				$new_path = './uploads/' . $this->company_folder . '/' . $folder->folder_name;
			} else {
				$new_path = './uploads/' . $this->company_folder . $to_folder->path . $folder->folder_name;
			}

			if(mkdir($new_path,0777)){
				if($to_folder_id == 0){
					$path = '/' . $folder->folder_name . '/';
				} else {
					$path = $to_folder->path . $folder->folder_name . '/';
				}

				if($to_folder_id == 0){
					$parent_id = $to_folder_id;
				} else {
					$parent_id = $to_folder->folder_id;
				}

				$data = array(
					'path' => $path,
					'parent_id' => $parent_id,
					'date_modified' => date('Y-m-d h:i:s'),
					'modified_by' => $uid
				);

				if($this->folders_model->trans_update($data, array('folder_id' => $folder->folder_id))){
					$new_folder = $this->folders_model->getById($folder->folder_id);
					$folders = getFolders($new_folder->folder_id)->result();
					foreach ($folders as $vFolder) {
						$this->recurseFolder($new_folder->folder_id, $new_folder, $vFolder, true);
					}

					$this->moveFiles($new_folder, $folder);
					rmdir($old_path);	
				}
			}
		} else if($repath) {
			$new_to_folder = $this->folders_model->getById($to_folder_id);
			$folders = getFolders($to_folder_id)->result();
			foreach ($folders as $vFolder) {
				$new_path = $new_to_folder->path . $vFolder->folder_name . '/';

				$data = array(
					'path' => $new_path,
					'modified_by' => $uid,
					'date_modified' => date('Y-m-d h:i:s')
				);

				if($this->folders_model->trans_update($data, array('folder_id' => $vFolder->folder_id))){
					$this->recurseFolder($vFolder->folder_id, $vFolder, null, false, true);
				}
			}

			
			$this->moveFiles(null, $new_to_folder, true);
		}
	}

	private function moveFiles($to_folder, $folder, $repath = false){
		$uid = logged('id');

		$files = getFiles($folder->folder_id)->result();
		foreach ($files as $file) {
			if(!$repath){
				$old_path = './uploads/' . $this->company_folder . $file->file_path;
				$new_path = './uploads/' . $this->company_folder . $to_folder->path . $file->title;

				if(rename($old_path, $new_path)){
					$data = array(
						'file_path' => $to_folder->path . $file->title,
						'modified' => date('Y-m-d h:i:s'),
						'modified_by' => $uid
					);

					$this->vault_model->trans_update($data, array('file_id' => $file->file_id));
				}
			} else {
				$data = array(
					'file_path' => $folder->path . $file->title,
					'modified' => date('Y-m-d h:i:s'),
					'modified_by' => $uid
				);

				$this->vault_model->trans_update($data, array('file_id' => $file->file_id));	
			}
		}
	}

	public function getFolder($folder_id){
		$return = $this->db->query('select folder_id, folder_name, description, category_id from file_folders where folder_id = ' . $folder_id)->row_array();

		echo json_encode($return);
	}

	public function update(){
		$uid = logged('id');
		$company_id = logged('company_id');

		if($this->company_folder != ''){
			$return = array(
				'latest_folder' => array(),
				'error' => ''
			);

			$folder_id = $_POST['folder_id'];
			$folder_name = $_POST['folder_name'];
			$parent_id = 0;
			$category = '';
			if(isset($_POST['parent_id'])){
				$parent_id = $_POST['parent_id'];
			}

			if(isset($_POST['category'])){
				$category = $_POST['category'];
			}

			$description = '';
			$path = '';

			$record = $this->db->query('select count(*) as `existing`, category_id from file_folders where lower(folder_name) = "' . strtolower($folder_name) . '" and parent_id = ' . $parent_id . ' and folder_id <> '. $folder_id .' and company_id = ' . $company_id)->row();

			if($record->existing > 0){
				$return['error'] = 'Folder already exists';
				if(!empty($record->category_id)){
					$return['error'] .= ' in <strong>Business Form Templates</strong> section';
				}
			} else {
				$folder = $this->folders_model->getById($folder_id);
				$parent_folder = $this->db->query('select * from file_folders where folder_id = ' . $parent_id);
				if($parent_folder->num_rows() > 0){
					$parent_folder = $parent_folder->row();

					$old_path = $parent_folder->path . $folder->folder_name . '/';
					$new_path = $parent_folder->path . $folder_name . '/';
				} else {
					$old_path = '/' . $folder->folder_name . '/';
					$new_path = '/' . $folder_name . '/';
				}

				if(isset($_POST['folder_desc'])){
					$description = $_POST['folder_desc'];
				}

				$data = array(
					'folder_name' => $folder_name,
					'description' => $description,
					'path' => $new_path,
					'modified_by' => $uid,
					'date_modified' => date('Y-m-d h:i:s')
				);

				if($category != ''){
					$data['category_id'] = $category;
				}

				if($this->folders_model->trans_update($data, array('folder_id' => $folder_id))){
					if(rename('./uploads/' . $this->company_folder . $old_path, './uploads/' . $this->company_folder . $new_path)){
						$this->recurseFolder($folder_id, $folder, null, false, true);
					} else {
						$return['error'] = 'Error in renaming the actual file. Please contact our support';
					}
				} else {
					$return['error'] = 'Error in updating folder. Please contact our support';
				}
			}
		} else {
			$return['error'] = 'Error in initializing root folder';
		}

		echo json_encode($return);
	}
}

?>