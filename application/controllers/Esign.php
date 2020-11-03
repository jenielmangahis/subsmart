<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('max_input_vars', 30000);

class Esign extends MY_Controller {

	public function __construct()
    {
        parent::__construct();
		$this->checkLogin();
		$this->load->model('Esign_model', 'Esign_model');
		add_css(array( 
            'assets/textEditor/summernote-bs4.css',
        ));

        // JS to add only Job module
        add_footer_js(array(
			// 'https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js',
            'assets/textEditor/summernote-bs4.js'
        ));
    }

	public function index()
	{
		$this->load->model('Users_sign_model', 'Users_sign_model');
		$this->page_data['users'] = $this->Users_sign_model->getUser(logged('id'));
		$this->checkLogin();
		$parent_id = getLoggedUserID();
		$cid=logged('company_id');
		$user_id = logged('id');
		$this->db->select('*');
		$this->db->from($this->Users_sign_model->table);
		$this->db->where('user_id', $user_id);
		$query = $this->db->get();
		$this->page_data['users_sign'] = $query->row();
		$this->load->view('esign/esign', $this->page_data);
	}

	public function addDefaultEsignTemplate($userId){
		try {
			$defaultData = $this->Esign_model->getAllDefaultLibrary($userId);		
			$insertedData = $this->Esign_model->insertBatchUserWiseTemplate($defaultData);
			if($insertedData){
				return true;
			}else {
				return false;
			}
			
		}
		catch(Exception $e) {
			return false;
		}
	}
	
	public function addDefaultEsignTemplateToExistingUsers(){
		try {
			$this->load->model('Users_model', 'Users_model');
			$getAllId = $this->Users_model->getAllUserId();
			$defaultData = $this->Esign_model->getAllDefaultLibrary(0);		
			$allData = [];
			foreach($getAllId as $id ){
				$currentDefaultData = $defaultData;
				foreach($currentDefaultData as $cdd ){
					$cdd['user_id'] = $id['id'];
					array_push($allData, $cdd);
				}
			}
			$insertedData = $this->Esign_model->insertBatchUserWiseTemplate($allData);
			if($insertedData){
				echo "All Data imported successfully Kindly Close this tab";
				return true;
			}else {
				return false;
			}
		}
		catch(Exception $e) {
			return false;
		}
	}

	public function blank() {
		$get = $this->input->get();
		$this->page_data['page_name'] = $get['page'];
		$this->load->view('blank', $this->page_data);
	}

	public function saveSign(){
		echo json_encode($_POST);
		$data = $_POST;
		$id = logged('id');
		$this->load->model('Users_sign_model', 'Users_sign_model');

		if(empty($this->Users_sign_model->fetch($id)))
		{
			$id = $this->Users_sign_model->create([
				'user_id' => $id,
				'esignImage' => $data['base64']
			]);
		} else {
			// $id = $this->Users_sign_model->where("user_id" , $id)->update([
			// 	'user_id' => $id,
			// 	'esignImage' => $data['base64']
			// ]);
			$this->db->where('user_id', $id);
        	$this->db->update($this->Users_sign_model->table, [
				'user_id' => $id,
				'esignImage' => $data['base64']
			]);
		}

		redirect('esign');
	}

	public function esignMain(){
		$this->page_data['users'] = $this->users_model->getUser(logged('id'));
		$this->load->view('esignMain/esignMain', $this->page_data);
	}

	public function Photos(){
		$this->load->model('User_docphoto_model', 'User_docphoto_model');
		$this->page_data['users'] = $this->User_docphoto_model->getUser(logged('id'));
		
		$this->load->view('esign/photos', $this->page_data);
	}

	public function Files(){
		
		$this->load->model('User_docflies_model', 'User_docflies_model');
		$this->page_data['users'] = $this->users_model->getUser(logged('id'));
		$this->page_data['file_id'] = $this->input->get('id');
		$this->page_data['file_url'] = "";
		if($this->page_data['file_id'] > 0) {
			$query = $this->db->from('user_docfile')->where('id',$this->page_data['file_id'])->get();
			$this->page_data['file_url'] = $query->row()->docFile;
		} 
		$this->page_data['next_step'] = ($this->input->get('next_step') == '')?0:$this->input->get('next_step');
		$queryRecipients = $this->db->from('user_docfile_recipients')->where('docfile_id',$this->page_data['file_id'])->get();
		$this->page_data['recipients'] = $queryRecipients->result_array();
		$this->load->view('esign/files', $this->page_data);
	}
	
	public function changeFavoriteStatus($id,$isFavorite){
		// $this->load->model('Esign_model', 'Esign_model');
		$whereClouser['user_id'] = logged('id');
		$whereClouser['isActive'] = 1;
		$whereClouser['esignLibraryTemplateId'] = $id;
		$dataToUpdate['isFavorite'] = $isFavorite;
		$isUpdated = $this->Esign_model->updateLibraryTemplate($whereClouser ,$dataToUpdate);
		$result['status'] = true;
		if(!$isUpdated){
			$result['status'] = false;
		}
		echo json_encode($result);
		return true;
	}
	
	public function deleteLibrary($id){
		$whereClouser['user_id'] = logged('id');
		$whereClouser['isActive'] = 1;
		$whereClouser['esignLibraryTemplateId'] = $id;
		$dataToUpdate['isActive'] = 0;
		$isUpdated = $this->Esign_model->updateLibraryTemplate($whereClouser ,$dataToUpdate);
		$result['status'] = true;
		if(!$isUpdated){
			$result['status'] = false;
		}
		echo json_encode($result);
		return true;
	}
	public function getCategories($libraryId){
		$loggedInUser = logged('id');
		$data = $this->Esign_model->getLibraryCategory($loggedInUser, $libraryId);
		$dataToSend = [];
		foreach($data as $d){
			$dataToSend[] = ['id'=> $d['category_id'], 'text' => $d['categoryName']];
		}
		echo json_encode($dataToSend);
	}
	public function createTemplate(){
		// $this->load->model('Esign_model', 'Esign_model');
		$loggedInUser = logged('id');
		$this->page_data['categories'] = $this->Esign_model->getLibraryCategory($loggedInUser);		
		$this->page_data['libraries'] = $this->Esign_model->getLibraries($loggedInUser);		
		$this->load->view('esign/createTemplate', $this->page_data);
	}
	public function templateLibrary(){
		// $this->load->model('Esign_model', 'Esign_model');
		$loggedInUser = logged('id');
		$this->page_data['templates'] = $this->Esign_model->getLibraryWithCategory($loggedInUser);
		$this->page_data['libraries'] = $this->Esign_model->getLibraries($loggedInUser); 
		// echo $this->db->last_query();
		// exit;
		$this->load->view('esign/templateLibrary', $this->page_data);
	}
	
	public function addCategory(){
		$loggedInUser = logged('id');
		$this->page_data['libraries'] = $this->Esign_model->getLibraries($loggedInUser);
		$this->load->view('esign/addCategory', $this->page_data);
	}

	public function addLibrary(){
		$this->load->view('esign/addLibrary', $this->page_data);
	}

	public function createCategory(){
		$result['status'] = false;
		$loggedInUser = logged('id');
		$dataToInsert = $this->input->post();
		$dataToInsert['user_id'] = $loggedInUser;
		$dataToInsert['isDefault'] = 0;
		$dataToInsert['isActive'] = 1;
		$isInserted = $this->Esign_model->insertCategory($dataToInsert);
		if($isInserted){
			$result['status'] = true;
		}
	 	echo json_encode($result);
	}
	
	public function createLibrary(){
		$result['status'] = false;
		$loggedInUser = logged('id');
		$dataToInsert = $this->input->post();
		$dataToInsert['userId'] = $loggedInUser;
		$dataToInsert['isActive'] = 1;
		$isInserted = $this->Esign_model->insertLibrary($dataToInsert);
		if($isInserted){
			$result['status'] = true;
		}
	 	echo json_encode($result);
	}

	public function categoryList(){
		$loggedInUser = logged('id');
		$this->page_data['categories'] = $this->Esign_model->getLibraryCategory($loggedInUser);
		$this->page_data['libraries'] = $this->Esign_model->getLibraries($loggedInUser);
		$this->load->view('esign/categoryList', $this->page_data);
	}
	public function libraryList(){
		$loggedInUser = logged('id');
		$this->page_data['libraries'] = $this->Esign_model->getLibraries($loggedInUser);
		$this->load->view('esign/libraryList', $this->page_data);
	}
	public function deleteCategory($id){
		// $this->load->model('Esign_model', 'Esign_model');
		$whereClouser['user_id'] = logged('id');
		$whereClouser['isActive'] = 1;
		$whereClouser['category_id'] = $id;
		$dataToUpdate['isActive'] = 0;
		$isUpdated = $this->Esign_model->updateLibraryCategory($whereClouser ,$dataToUpdate);
		$result['status'] = true;
		if(!$isUpdated){
			$result['status'] = false;
		}
		echo json_encode($result);
		return true;
	}
	public function deleteLibraryMaster($id){
		$whereClouser['userId'] = logged('id');
		$whereClouser['isActive'] = 1;
		$whereClouser['pk_esignLibraryMaster'] = $id;
		$dataToUpdate['isActive'] = 0;
		$isUpdated = $this->Esign_model->updateLibraryMaster($whereClouser ,$dataToUpdate);
		$result['status'] = true;
		if(!$isUpdated){
			$result['status'] = false;
		}
		echo json_encode($result);
		return true;
	}
	public function updateLibraryMaster(){
		extract($this->input->post());
		$whereClouser['userId'] = logged('id');
		$whereClouser['isActive'] = 1;
		$whereClouser['pk_esignLibraryMaster'] = $pk_esignLibraryMaster;
		$dataToUpdate['libraryName'] = $libraryName;
		$dataToUpdate['pk_esignLibraryMaster'] = $pk_esignLibraryMaster;
		$isUpdated = $this->Esign_model->updateLibraryMaster($whereClouser ,$dataToUpdate);
		$result['status'] = true;
		if(!$isUpdated){
			$result['status'] = false;
		}
		echo json_encode($result);
		return true;
	}
	public function updateCategory(){
		// $this->load->model('Esign_model', 'Esign_model');
		extract($this->input->post());
		$whereClouser['user_id'] = logged('id');
		$whereClouser['isActive'] = 1;
		$whereClouser['category_id'] = $categoryId;
		$dataToUpdate['categoryName'] = $categoryName;
		$dataToUpdate['fk_esignLibraryMaster'] = $fk_esignLibraryMaster;
		$isUpdated = $this->Esign_model->updateLibraryCategory($whereClouser ,$dataToUpdate);
		$result['status'] = true;
		if(!$isUpdated){
			$result['status'] = false;
		}
		echo json_encode($result);
		return true;
	}

	public function editTemplate(){
		$loggedInUser = logged('id');
		// $this->load->model('Esign_model', 'Esign_model');

		$queryParams = $this->input->get();
		if(!isset($queryParams['id'])){
			redirect('esign/esignmain');
		}
		$getTemplate = $this->db->from('esign_library_template')->where('user_id',$loggedInUser)->where('isActive',1)->where('esignLibraryTemplateId',$queryParams['id'])->get();
		
		if(!$getTemplate->num_rows()){
			redirect('esign/esignmain');
		}
		
		$this->page_data['template'] = $getTemplate->row();
		$this->page_data['categories'] = $this->Esign_model->getLibraryCategory($loggedInUser);		
		$this->page_data['libraries'] = $this->Esign_model->getLibraries();		
		$this->load->view('esign/createTemplate', $this->page_data);
	}
	
	public function saveCreatedTemplate(){
		$loggedInUser = logged('id');
		extract($this->input->post());
		$data = [
			'title' => $letterTitle,
			'content' => $template,
			'status' => $status,
			'user_id' => $loggedInUser,
			'category_id' => $category_id
		];
		if(isset($esignLibraryTemplateId) && $esignLibraryTemplateId > 0 ){
			$this->db->where('user_id' , logged('id'))->where('esignLibraryTemplateId' , $esignLibraryTemplateId);
			$isUpdated = $this->db->update('esign_library_template',$data);
			if($isUpdated){
				redirect('esign/editTemplate?id='.$esignLibraryTemplateId.'&isSuccess=1');
			}else{
				redirect('esign/esignmain');
			}
		} else {
			$isInserted = $this->db->insert('esign_library_template',$data);
			if($isInserted){
				$libraryId = $this->db->insert_id();
				redirect('esign/editTemplate?id='.$libraryId.'&isSuccess=1');
			}else{
				redirect('esign/esignmain');
			}
		}
	}


	public function recipients() {

		if(isset($_POST['recipients']) && count($_POST['recipients'])>0 ) {
			foreach($_POST['recipients'] as $key => $value) {
				$id = $this->db->insert('user_docfile_recipients',[
					'user_id' => logged('id'),
					'docfile_id' => $_POST['file_id'],
					'name' => $value,
					'email' => $_POST['email'][$key],
					'color' => $_POST['colors'][$key],
				]);
			}
			redirect('esign/Files?id='.(isset($_POST['file_id'])?$_POST['file_id']:0).'&next_step=3');
		}
	}

	public function photoSave(){
		$this->load->model('User_docphoto_model', 'User_docphoto_model');
		$id = logged('id');

		// $extension = pathinfo($_FILES["docphoto"]["name"], PATHINFO_EXTENSION);
		// print_r($extension);die();
		// $extension	 = strtolower(end(explode('.',$_FILES['docPhoto']['name'])));
		// print_r($extension);die();
		//$filename = time()."_".rand(1,9999999)."_"."DocPhoto"."."."jpg";
		//$location = "./uploads/DocPhoto/".$filename;
		//move_uploaded_file($_FILES['docPhoto']['name'], $location);
		$tmp_name = $_FILES['docPhoto']['tmp_name'];
        // basename() may prevent filesystem traversal attacks;
        // further validation/sanitation of the filename may be appropriate
        $name = time()."_".rand(1,9999999)."_".basename($_FILES["docPhoto"]["name"]);
		move_uploaded_file($tmp_name, "./uploads/DocPhoto/$name");
		
		// $config['upload_path']          = $_SERVER['DOCUMENT_ROOT'] .'/nsmartrac/uploads/DocPhoto/';
		// $config['allowed_types']        = 'gif|jpg|png|jpeg';
		// $config['max_size'] = 2000;
		// $config['max_width'] = 1500;
		// $config['max_height'] = 1500;
		// $config['encrypt_name'] = TRUE;
		// $config['file_name'] = $filename;
		// $config['overwrite'] = false;
		// print_r("<pre>");
		// $this->load->library('upload', $config);

		// if (!$this->upload->do_upload('docPhoto')) {
		// 	$error = array('error' => $this->upload->display_errors());
		// 	print_r($error);
		// } else {
		// 	// $data = array('docPhoto' => $this->upload->data());
		// }

		$id = $this->User_docphoto_model->create([
			'user_id' => $id,
			'docphoto' => $name
		]);
		
		// print_r("expression");
		redirect('esign/Photos');
	}

	public function fileSave(){

		$this->load->model('User_docflies_model', 'User_docflies_model');
		//$id = logged('id');
		
		// $extension	 = strtolower(end(explode('.',$_FILES['docFile']['name'])));
		// $filename = time()."_".rand(1,9999999)."_"."DocFiles".".".$extension;
		// $location = "../../uploads/DocFiles";
		// echo move_uploaded_file($filename, $location);

		
		if(isset($_FILES['docFile']) && $_FILES['docFile']['tmp_name'] != '') {
				
			$tmp_name = $_FILES['docFile']['tmp_name'];
			$extension	 = strtolower(end(explode('.',$_FILES['docFile']['name'])));
			// basename() may prevent filesystem traversal attacks;
			// further validation/sanitation of the filename may be appropriate
			$name = time()."_".rand(1,9999999)."_".basename($_FILES["docFile"]["name"]);
			move_uploaded_file($tmp_name, "./uploads/DocFiles/$name");
			$id = 0;
			
		

			if($_POST['file_id'] > 0)
			{
				$this->db->where('id', $_POST['file_id']);
				$this->db->update($this->User_docflies_model->table, [
					'docFile' => $name
				]);
					
				$id = $_POST['file_id'];
			} else {
				
				$id = $this->User_docflies_model->create([
					'user_id' => logged('id'),
					'docFile' => $name
				]);
			}

			if(isset($_POST['next_step']) && $_POST['next_step'] == 0)
			{
				redirect('esign/Files?id='.$id);
			}
			if(isset($_POST['next_step']) && $_POST['next_step'] == 1)
			{
				redirect('esign/Files?id='.$id.'&next_step=2');
			}

		} else if (isset($_POST['file_id']) && $_POST['file_id'] > 0) {
			
			if(isset($_POST['next_step']) && $_POST['next_step'] == 0)
			{
				redirect('esign/Files?id='.$_POST['file_id']);
			}
			if(isset($_POST['next_step']) && $_POST['next_step'] == 1)
			{
				redirect('esign/Files?id='.$_POST['file_id'].'&next_step=2');
			}
		}	
	}
	
	private function _get_datatables_query($postData){
		$tableName = 'esign_library_template';
		$column_search = array( 'title', 'categoryName');
		$column_order = array( 'title', 'status', 'categoryName' );
		$order = array('esignLibraryTemplateId' => 'desc');
		
        $this->db->from($tableName);
        $i = 0;
        // loop searchable columns 
        foreach($column_search as $item){
            // if datatable send POST for search
            if($postData['search']['value']){
                // first loop
                if($i===0){
                    // open bracket
                    $this->db->group_start();
                    $this->db->like($item, $postData['search']['value']);
                }else{
                    $this->db->or_like($item, $postData['search']['value']);
                }
                
                // last loop
                if(count($column_search) - 1 == $i){
                    // close bracket
                    $this->db->group_end();
                }
            }
            $i++;
        }
         
        if(isset($postData['order'])){
            $this->db->order_by($column_order[$postData['order']['0']['column']], $postData['order']['0']['dir']);
        }else if(isset($order)){
            // $order = $order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
	}
	// public function countFiltered($postData){
	// 	$this->_get_datatables_query($postData);
	// 	$query = $this->db->get();
    //     return $query->num_rows();
	// }
    
	public function getRows($postData, $userId, $libraryId){
		$this->_get_datatables_query($postData);
		$this->db->where('esign_library_template.user_id',$userId )
		->where('esign_library_template.isActive',1 )
		->join( "esign_library_category", 'esign_library_category.category_id = esign_library_template.category_id');
		if($libraryId && $libraryId  != "0"){
			$this->db->where('esign_library_category.fk_esignLibraryMaster', $libraryId);
		}
		$res['count'] = $this->db->get()->num_rows();
		
		$this->_get_datatables_query($postData);
		$this->db->select('esignLibraryTemplateId, title, categoryName, isFavorite, status')
		->where('esign_library_template.user_id',$userId )
		->where('esign_library_template.isActive',1 )
		->join( "esign_library_category", 'esign_library_category.category_id = esign_library_template.category_id');
		if($libraryId && $libraryId  != "0"){
			$this->db->where('esign_library_category.fk_esignLibraryMaster', $libraryId);
		}
        if($postData['length'] != -1){
            $this->db->limit($postData['length'], $postData['start']);
		}
		$res['data'] = $this->db->get();
		return $res;
	}

	public function dtGetLibrary($libraryId=0){
		$data = $row = array();
		$userId = logged('id');
		$queryData  = $this->getRows($_POST, $userId, $libraryId);
		$memData = $queryData['data']->result();

	    foreach($memData as $member){
			$status = ($member->status == 1)?'Active':'Inactive';
			$favStatus = $member->isFavorite ? 'favorite' : 'notFavorite';
			$fav = '<a href="#" onclick="changeFavorite(this)" class="changeFavorite"> <i id="'.$member->esignLibraryTemplateId.'" class="fa fa-star '.$favStatus.'"> </i></a>';
			$action  = '
				<a href="'.base_url('esign/editTemplate?id='.$member->esignLibraryTemplateId).'"><i class="fa fa-edit"></i></a>
				<a class="trashColor" href="#"><i id="deleteId-'.$member->esignLibraryTemplateId.'" class="fa fa-trash"></i></a>
			';
			$data[] = array( 
				$member->title, 
				$status, 
				$member->categoryName, 
				$fav,
				$action
			);
		}
		
		// print_r($data);

        $countFiltered = $queryData['count'];
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $countFiltered,
            "recordsFiltered" => $countFiltered,
            "data" => $data,
        );
        
        // Output to JSON format
        echo json_encode($output);
	}
}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */