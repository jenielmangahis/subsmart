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
}

?>