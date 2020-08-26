<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Filefolderscategories extends MY_Controller {
	public function __construct(){
		parent::__construct();
	}

	public function getCategories($internal = false){
		$uid = logged('id');

		if($internal){
			return $this->db->get_where('file_folders_categories', array('created_by' => $uid))->result_array();
		} else {
			echo json_encode($this->db->get_where('file_folders_categories', array('created_by' => $uid))->result_array());
		}
	}

	public function add(){
		$uid = logged('id');
		$company_id = logged('company_id');

		$return = array(
			'categories' => array(),
			'error' => ''
		);

		if(isset($_POST['category_name'])){
			$category_name = $_POST['category_name'];
			$category_desc = '';

			if(isset($_POST['category_desc'])){
				$category_desc = $_POST['category_desc'];
			}	

			$sql = 'select count(*) as `exists` from file_folders_categories where lower(category_name) = "'. strtolower($category_name) .'" and company_id = ' . $company_id;

			$category = $this->db->query($sql)->row();
			$count = $category->exists;

			if($count <= 0){
				$data = array(
					'category_name' => $category_name,
					'category_desc' => $category_desc,
					'company_id' => $company_id,
					'created_by' => $uid,
					'date_created' => date('Y-m-d h:i:s')
				);

				if(!$this->file_folders_categories_model->trans_create($data)){
					$return['error'] = 'Error in creating category';
				} else {
					$return['categories'] = $this->getCategories(true);
				}
			} else {
				$return['error'] = 'Category name already exists';
			}
		} else {
			$return['error'] = 'Please provide category name';
		}

		echo json_encode($return);
	}

	public function edit(){
		$uid = logged('id');
		$company_id = logged('company_id');
		
		$return = array(
			'categories' => array(),
			'error' => ''
		);

		if(isset($_POST['category_id'])){
			if(isset($_POST['category_name'])){
				$category_name = $_POST['category_name'];
				
				$data = array(
					'category_name' => $_POST['category_name'],
					'modified_by' => $uid,
					'date_last_modified' => date('Y-m-d h:i:s')
				);

				if(isset($_POST['category_desc'])){
					$data['category_desc'] = $_POST['category_desc'];
				}	

				$sql = 'select count(*) as `exists` from file_folders_categories where lower(category_name) = "'. strtolower($category_name) .'" and company_id = ' . $company_id . ' ' .
					   'and category_id <> ' . $_POST['category_id'];

				$category = $this->db->query($sql)->row();
				$count = $category->exists;

				if($count <= 0){
					if(!$this->file_folders_categories_model->trans_update($data, array('category_id' => $_POST['category_id']))){
						$return['error'] = 'Error in updating category';
					} else {
						$return['categories'] = $this->getCategories(true);
					}
				} else {
					$return['error'] = 'Category name already exists';	
				}
			} else {
				$return['error'] = 'Empty category name not allowed';	
			}
		} else {
			$return['error'] = 'Please select category';
		}

		echo json_encode($return);
	}

	public function delete(){
		$uid = logged('id');
		$company_id = logged('company_id');
		
		$return = array(
			'categories' => array(),
			'error' => ''
		);

		if(isset($_POST['category_id'])){
			$sql = 'select count(*) as `exists` from file_folders where category_id = ' . $_POST['category_id'] . ' ' .
				   'union all '.
				   'select count(*) as `exists` from filevault where category_id = ' . $_POST['category_id'];

			$rows = $this->db->query($sql)->result();
			$count = 0;
			foreach ($rows as $row) {
				$count += $row->exists;	
			}

			if($count <= 0){
				$result = $this->file_folders_categories_model->trans_delete(array(), array('category_id' => $_POST['category_id']));
				if(!$result['status']){
					$return['error'] = $result['message'];
				} else {
					$return['categories'] = $this->getCategories(true);
				}
			} else {
				$return['error'] = 'Category is being used by a folder or a file';	
			}
		} else {
			$return['error'] = 'Please select category';
		}

		echo json_encode($return);
	}
}

?>