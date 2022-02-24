<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('max_input_vars', 30000);

class Esign extends MY_Controller {
    const ONE_MB = 1048576;

	public function __construct()
    {
        parent::__construct();
		$this->checkLogin();
		$this->hasAccessModule(49);
		$this->load->model('Esign_model', 'Esign_model');
		$this->load->model('Activity_model', 'activity');
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

	public function esign_upload_docs(){

        //$sourceFile = $_SERVER['DOCUMENT_ROOT']."/uploads/esign/Website Cross Sponsorship Agreement.docx";
        //$sourceFile = $_SERVER['DOCUMENT_ROOT']."/uploads/esign/11.html";
        //$this->load->library('DocxConversion');
        // print_r(pathinfo($sourceFile));
        // echo $this->docxconversion->read_docx($sourceFile);

        //$content = file_get_contents($sourceFile,FILE_USE_INCLUDE_PATH);
        //echo $content;

        //echo str_replace( '�',' ',$content);


        //$handle = file_get_contents($sourceFile, FILE_USE_INCLUDE_PATH);
       // print_r($handle);
        if ( 0 < $_FILES['file']['error'] ) {
            echo 'Error: ' . $_FILES['file']['error'] . '<br>';
        }
        else {
            $uniquesavename=time().uniqid(rand());
            $path = $_FILES['file']['name'];
            $ext = pathinfo($path, PATHINFO_EXTENSION);
            $destination = 'uploads/esign/' .$uniquesavename.'.'.$ext;
            move_uploaded_file($_FILES['file']['tmp_name'], $destination);

            $sourceFile = $_SERVER['DOCUMENT_ROOT'].'/'.$destination;
            $content = file_get_contents($sourceFile,FILE_USE_INCLUDE_PATH);
            echo $content;
        }
        //  $sourceFile = "/uploads/esign/Website Cross Sponsorship Agreement.docx";



    }

    public function docx2text($filename) {
        return $this->readZippedXML($filename, "word/document.xml");
    }
    public function readZippedXML($archiveFile, $dataFile)
    {
        // Create new ZIP archive
        $zip = new ZipArchive;
        // Open received archive file
        if (true === $zip->open($archiveFile)) {
            // If done, search for the data file in the archive
            if (($index = $zip->locateName($dataFile)) !== false) {
// If found, read it to the string
                $data = $zip->getFromIndex($index);
// Close archive file $zip->close();
// Load XML from a string
// Skip errors and warnings
                $xml = new DOMDocument();
                $xml->loadXML($data, LIBXML_NOENT | LIBXML_XINCLUDE | LIBXML_NOERROR | LIBXML_NOWARNING);
// Return data without XML formatting tagsreturn

                return strip_tags($xml->saveXML());
            }
            $zip->close();
        }
        return "";
// In case of failure return empty string return ""; }

    }

	public function esignMain(){
		$this->page_data['users'] = $this->users_model->getUser(logged('id'));
		$this->load->view('esignMain/esignMain', $this->page_data);
	}

	public function Photos(){
		$this->load->model('User_docphoto_model', 'User_docphoto_model');

		$cid     = logged('company_id');
		$role_id = logged('role');
		if( $role_id == 1 || $role_id == 2 ){
			$this->page_data['users'] = $this->User_docphoto_model->getAll();
		}else{
			$this->page_data['users'] = $this->User_docphoto_model->getAllByCompanyId($cid);
		}

		//$this->page_data['users'] = $this->User_docphoto_model->getUser(logged('id'));

		$this->load->view('esign/photos', $this->page_data);
	}

	public function Files(){

		$this->load->model('User_docflies_model', 'User_docflies_model');
		$this->page_data['users'] = $this->users_model->getUser(logged('id'));
		$this->page_data['file_id'] = $this->input->get('id');

		$queries = array();
		parse_str($_SERVER['QUERY_STRING'], $queries);
		$isTemplate = array_key_exists('template_id', $queries);
		$isSelfSigning = array_key_exists('signing_id', $queries);

		$this->page_data['is_self_signing'] = false;
		if ($isSelfSigning) {
			$this->page_data['file_id'] = $queries['signing_id'];
			$this->page_data['is_self_signing'] = true;
		}

		$this->page_data['file_url'] = "";
		if($this->page_data['file_id'] > 0) {
			$query = $this->db->from('user_docfile')->where('id',$this->page_data['file_id'])->get();
			$this->page_data['file_url'] = $query->row()->name;
		}
		$this->page_data['next_step'] = ($this->input->get('next_step') == '')?0:$this->input->get('next_step');


		$recipients = [];
		if ($isTemplate) { // :( this shouldn't be here
			$this->db->where('template_id', $queries['template_id']);
			$recipients = $this->db->get('user_docfile_templates_recipients')->result_array();
		} else if (!$isSelfSigning) {
			$queryRecipients = $this->db->from('user_docfile_recipients')->where('docfile_id',$this->page_data['file_id'])->get();
			$recipients = $queryRecipients->result_array();
		}

		$recipients = array_map(function ($recipient, $index) {
			$index += 1;
			if (empty($recipient['name'])) { // doesnt have name
				$recipient['name'] = $recipient['role_name'];
			}

			return $recipient;
		}, $recipients, array_keys($recipients));
		$this->page_data['recipients'] = $recipients;

		add_css([
			'assets/css/esign/esign-builder/esign-builder.css',
			'assets/css/esign/docusign/docusign.css'
		]);

		add_footer_js([
			// 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js',
			'assets/js/esign/libs/pdf.js',
			'assets/js/esign/libs/pdf.worker.js',
            'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js',

			'assets/js/esign/docusign/input.autoresize.js',
			'assets/js/esign/step1.js',
			'assets/js/esign/step2.js',
			'assets/js/esign/step3.js',
		]);

		$this->load->view('esign/files', $this->page_data);
	}

	public function apiGetDocumentRecipients($id)
	{
		$queryRecipients = $this->db->from('user_docfile_recipients')->where('docfile_id', $id)->get();
		echo json_encode($queryRecipients->result_array());
	}

	public function apiCreateUserDocfileFields()
	{
    	header('content-type: application/json');

		if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
			echo json_encode(['success' => false]);
			return;
		}

		$payload = json_decode(file_get_contents('php://input'), true);

		$coordinates = json_encode($payload['coordinates']);
		$specs = $payload['specs'] ? json_encode($payload['specs']) : null;
		$docPage = $payload['doc_page'];
		$field = $payload['field'] ?? $payload['field_name'];
		$recipientId = $payload['recipient_id'];
		$userId = logged('id');
		$docfileDocumentId = $payload['docfile_document_id'];
		$docfileId = $payload['docfile_id'];
		$uniqueKey = $payload['unique_key'];

		$this->db->where('docfile_id', $docfileId);
		$this->db->where('user_id', $userId);
		$this->db->where('unique_key', $uniqueKey);
		$record = $this->db->get('user_docfile_fields')->row();
		$isCreated = false;

		if (is_null($record)) {
			$isCreated = true;
			$this->db->insert('user_docfile_fields', [
				'coordinates' => $coordinates,
				'doc_page' => $docPage,
				'docfile_id' => $docfileId,
				'docfile_document_id' => $docfileDocumentId,
				'field_name' => $field,
				'unique_key' => $uniqueKey,
				'user_id' => $userId,
                'user_docfile_recipients_id' => $recipientId,
				'specs' => $specs,
			]);
		} else {
			$this->db->where('id', $record->id);
			$this->db->update('user_docfile_fields', [
				'coordinates' => $coordinates,
				'doc_page' => $docPage,
				'docfile_id' => $docfileId,
				'docfile_document_id' => $docfileDocumentId,
				'field_name' => $field,
				'unique_key' => $uniqueKey,
				'user_id' => $userId,
				'specs' => is_null($specs) ? $record->specs : $specs,
                // 'user_docfile_recipients_id' => $recipientId,
			]);
		}

		$query = <<<SQL
        SELECT `user_docfile_fields`.*, `user_docfile_recipients`.`color` FROM `user_docfile_fields`
        LEFT JOIN `user_docfile_recipients` ON `user_docfile_recipients`.`id` = `user_docfile_fields`.`user_docfile_recipients_id`
        WHERE `user_docfile_fields`.`id` = ?
SQL;

		$recordId = $isCreated ? $this->db->insert_id() : $record->id;
		$record = $this->db->query($query, [$recordId])->row();
		echo json_encode(['record' => $record, 'is_created' => $isCreated]);
	}

	public function apiGetUserDocfileFields($docId)
	{
        $query = <<<SQL
        SELECT `user_docfile_fields`.*, `user_docfile_recipients`.`color` FROM `user_docfile_fields`
        LEFT JOIN `user_docfile_recipients` ON `user_docfile_recipients`.`id` = `user_docfile_fields`.`user_docfile_recipients_id`
        WHERE `user_docfile_fields`.`docfile_id` = ? AND `user_docfile_fields`.`user_id` = ?
SQL;

		$records = (array) $this->db->query($query, [$docId, logged('id')])->result();

    	header('content-type: application/json');
		echo json_encode(['fields' => $records]);
	}

    public function apiDeleteDocfileField($uniqueKey) {
        if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
            echo json_encode(['success' => false]);
            return;
        }

        $this->db->where('user_id', logged('id'));
        $this->db->where('unique_key', $uniqueKey);
        $this->db->delete('user_docfile_fields');

        header('content-type: application/json');
        echo json_encode(['success' => true]);
    }

	public function apiDocumentFile($id)
	{
		$this->db->where('docfile_id', $id);
        $this->db->order_by('id', 'ASC');
        $records = $this->db->get('user_docfile_documents')->result_array();

		$this->db->where('docfile_id', $id);
        $sequence = $this->db->get('user_docfile_document_sequence')->row();
        $sorted = null;

        if ($sequence) {
            $sorted = [];
            $sequence = explode(',', $sequence->sequence);
            foreach ($sequence as $recordId) {
                foreach ($records as $record) {
                    if ($record['id'] == $recordId) {
                        $sorted[] = $record;
                        break;
                    }
                }
            }
        }

        header('content-type: application/json');
        echo json_encode(['data' => is_null($sorted) ? $records : $sorted]);
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
		$activity['activityName'] = "Template Deleted";
		$activity['activity'] = "Template ID : ".$id." Deleted By User ".logged('username');
		$activity['user_id'] = logged('id');
		$this->activity->addEsignActivity($activity);
	 	echo json_encode($result);
		return true;
	}
	public function getCategories($libraryId){
		$loggedInUser = logged('id');
		$data = $this->Esign_model->getLibraryCategory($loggedInUser, $libraryId);
		// echo $this->db->last_query();
		// print_r($data);
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

		add_css('assets/css/esign/esign-editor/esign-editor.css');
		$this->load->view('esign/createTemplate', $this->page_data);
	}
	public function templateLibrary(){
		// $this->load->model('Esign_model', 'Esign_model');
		$loggedInUser = logged('id');
		$this->page_data['templates'] = $this->Esign_model->getLibraryWithCategory($loggedInUser);
		$this->page_data['libraries'] = $this->Esign_model->getLibraries($loggedInUser);
		// echo $this->db->last_query();
		// exit;
		add_css('assets/css/esign/library/library.css');
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
		$activity['activityName'] = "Category Created";
		$activity['activity'] = "Category ".$dataToInsert['categoryName']." Created By User ".logged('username');
		$activity['user_id'] = logged('id');
		$this->activity->addEsignActivity($activity);
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
		$activity['activityName'] = "Library Created";
		$activity['activity'] = "Library ".$dataToInsert['libraryName']." Created By User ".logged('username');
		$activity['user_id'] = logged('id');
		$this->activity->addEsignActivity($activity);
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
		$activity['activityName'] = "Category Deleted";
		$activity['activity'] = "Category ID : ".$id." Deleted By User ".logged('username');
		$activity['user_id'] = logged('id');
		$this->activity->addEsignActivity($activity);
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
		$activity['activityName'] = "Library Deleted";
		$activity['activity'] = "Library ID : ".$id." Deleted By User ".logged('username');
		$activity['user_id'] = logged('id');
		$this->activity->addEsignActivity($activity);
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
		$activity['activityName'] = "Library Updated";
		$activity['activity'] = "Library ID : ".$pk_esignLibraryMaster." Updated By User ".logged('username');
		$activity['user_id'] = logged('id');
		$this->activity->addEsignActivity($activity);
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
		$activity['activityName'] = "Update Updated";
		$activity['activity'] = "Category ID : ".$categoryId." Updated By User ".logged('username');
		$activity['user_id'] = logged('id');
		$this->activity->addEsignActivity($activity);

		echo json_encode($result);
		return true;
	}

	public function content_editor(){
        $tbl = $_POST['contents'];
        echo html_entity_decode($tbl);
    }

	public function editTemplate(){
		$loggedInUser = logged('id');
		// $this->load->model('Esign_model', 'Esign_model');

		$queryParams = $this->input->get();
		if(!isset($queryParams['id'])){
			redirect('esign/esignmain');
		}
		$getTemplate = $this->Esign_model->editTemplate($loggedInUser, $queryParams['id']);

		if(!$getTemplate->num_rows()){
			redirect('esign/esignmain');
		}

		$this->page_data['template'] = $getTemplate->row();
		$this->page_data['categories'] = $this->Esign_model->getLibraryCategory($loggedInUser);
		$this->page_data['libraries'] = $this->Esign_model->getLibraries($loggedInUser);
		// echo '<pre>';
		// print_r($this->page_data);
		// exit;
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
			$this->db->where('user_id' , $loggedInUser)->where('esignLibraryTemplateId' , $esignLibraryTemplateId);
			$isUpdated = $this->db->update('esign_library_template',$data);
			$activity['activityName'] = "Template Updated";
			$activity['activity'] = "Template Id : ".$esignLibraryTemplateId." Updated By User ".logged('username');
			$activity['user_id'] = $loggedInUser;
			$this->activity->addEsignActivity($activity);
			if($isUpdated){
				redirect('esign/editTemplate?id='.$esignLibraryTemplateId.'&isSuccess=1');
			}else{
				redirect('esign/esignmain');
			}
		} else {
			$isInserted = $this->db->insert('esign_library_template',$data);
			if($isInserted){
				$libraryId = $this->db->insert_id();
				$activity['activityName'] = "Template Created";
				$activity['activity'] = "Template Id : ".$libraryId." Created By User ".logged('username');
				$activity['user_id'] = $loggedInUser;
				$this->activity->addEsignActivity($activity);
				redirect('esign/editTemplate?id='.$libraryId.'&isSuccess=1');
			}else{
				redirect('esign/esignmain');
			}
		}
	}

	/*
	public function tempDefaultTemplate(){
		// $this->load->model('Esign_model', 'Esign_model');
		$loggedInUser = logged('id');
		$this->page_data['categories'] = $this->Esign_model->getLibraryCategory($loggedInUser);
		$this->page_data['libraries'] = $this->Esign_model->getLibraries($loggedInUser);
		$this->load->view('esign/tempInsertDefaultTemplate', $this->page_data);
	}

	public function saveCreatedTemplateDefaultTemp(){
		extract($this->input->post());
		$data = [
			'title' => $letterTitle,
			'content' => $template,
			'status' => 2,
			'category_id' => 0
		];
		$isInserted = $this->db->insert('esign_default_library_template',$data);
		if($isInserted){
			$libraryId = $this->db->insert_id();
			$file_path= "/var/www/html/nsmartrac/addonQueries.sql";
			$fp = fopen($file_path, 'a');
			if(!$fp){
				echo 'file is not opend';
				exit;
			}
			fwrite($fp, $this->db->last_query()."\n\n");
			fclose($fp);
			redirect('esign/tempDefaultTemplate?isSuccess=1');
		}else{
				redirect('esign/esignmain');
		}
	}
	*/

	public function recipients() {
		$payload = json_decode(file_get_contents('php://input'), true);

		if (!array_key_exists('recipients', $payload) || !array_key_exists('doc_id', $payload)) {
			echo json_encode(null);
			return;
		}

		$docId = $payload['doc_id'];
		$nextRecipients = $payload['recipients'];
		$userId = logged('id');

		$this->db->where('docfile_id', $docId);
		$this->db->where('user_id', $userId);
		$currentRecipients = $this->db->get('user_docfile_recipients')->result();
		$nextRecipientIds = array_column($nextRecipients, 'id');

		foreach ($currentRecipients as $currentRecipient) {
			if (!in_array($currentRecipient->id, $nextRecipientIds)) {
				$this->db->where('user_id', $userId);
				$this->db->where('docfile_id', $docId);
				$this->db->where('id', $currentRecipient->id);
				$this->db->delete('user_docfile_recipients');
			}
		}

		foreach ($payload['recipients'] as $recipient) {
			//['id' => $id, 'name' => $name, 'email' => $email, 'color' => $color, 'role' => $role] = $recipient;

			$this->db->where('id', $id);
			$this->db->where('docfile_id', $docId);
			$this->db->where('user_id', $userId);
			$record = $this->db->get('user_docfile_recipients');

			if (!is_null($record->row())) {
				$this->db->where('id', $id);
				$this->db->where('docfile_id', $docId);
				$this->db->where('user_id', $userId);

				$this->db->update('user_docfile_recipients', [
					'name' => $name,
					'email' => $email,
					'role' => $role,
					'color' => $color,
				]);
			} else {
				$this->db->insert('user_docfile_recipients', [
					'name' => $name,
					'email' => $email,
					'role' => $role,
					'color' => $color,
					'docfile_id' => $docId,
					'user_id' => $userId,
				]);
			}
		}

    	header('content-type: application/json');
    	echo json_encode(['success' => true]);
	}

	public function photoSave(){
		$this->load->model('User_docphoto_model', 'User_docphoto_model');
		$id  = logged('id');
		$cid = logged('company_id');

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
			'docphoto' => $name,
			'company_id' => $cid
		]);

		// print_r("expression");
		redirect('esign/Photos');
	}

	public function fileSave(){
		header('content-type: application/json');

		if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false]);
            return;
        }

		$filepath = FCPATH . 'uploads/DocFiles/';
		if (!file_exists($filepath)) {
			mkdir($filepath, 0777, true);
		}

		$files = $_FILES['files'];
        $count = count($files['name']);

        for ($i = 0; $i < $count; $i++) {
            if ($files['size'][$i] <= self::ONE_MB * 8) {
                continue;
            }

            echo json_encode(['success' => false, 'reason' => 'Maximum file size is less than 8MB']);
            return;
        }

		//['subject' => $subject, 'message' => $message] = $this->input->post();

		$this->db->insert('user_docfile', [
			'name' => $subject,
			'type' => 'Single',
			'status' => 'Draft',
			'subject' => $subject,
			'message' => $message,
			'user_id' => logged('id'),
			'company_id' => logged('company_id'),
			'updated_at' => date('Y-m-d H:i:s'),
		]);

		$insertedId = $this->db->insert_id();

		for ($i = 0; $i < $count; $i++) {
			$tempName = $files['tmp_name'][$i];
			$filename = $files['name'][$i];
			$filename = time() . "_" . rand(1, 9999999) . "_" . basename($filename);
			$documentPath = $filepath . $filename;

			$this->db->insert('user_docfile_documents', [
				'name' => $filename,
				'path' => str_replace(FCPATH, '/', $documentPath),
				'docfile_id' => $insertedId,
			]);

			move_uploaded_file($tempName, $filepath . $filename);
		}

		// save sequence
		$this->db->where('docfile_id', $insertedId);
        $record = $this->db->get('user_docfile_document_sequence')->row();

        //['document_sequence' => $sequence] = $this->input->post();
        //['sequence' => $sequence] = json_decode($sequence, true);
		$sequence = is_array($sequence) ? $sequence : [];

        $this->db->where('docfile_id', $insertedId);
        $documents = $this->db->get('user_docfile_documents')->result_array();

        $sequenceIds = [];
        foreach ($sequence as $documentName) {
            foreach ($documents as $document) {
                if (strpos($document['name'], $documentName) !== false) {
                    $sequenceIds[] = $document['id'];
                    break;
                }
            }
        }

        $payload = ['docfile_id' => $insertedId, 'sequence' => implode(',', $sequenceIds)];
        if (!$record) {
            $this->db->insert('user_docfile_document_sequence', $payload);
        } else {
            $this->db->where('docfile_id', $insertedId);
            $this->db->update('user_docfile_document_sequence', $payload);
        }

		$this->db->where('id', $insertedId);
		$record = $this->db->get('user_docfile')->row();
		echo json_encode(['data' => $record, 'is_created' => true]);
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
		->where('esign_library_master.isActive',1 )
		->where('esign_library_category.isActive',1 )
		->join( "esign_library_category", 'esign_library_category.category_id = esign_library_template.category_id')
		->join( "esign_library_master", 'esign_library_master.pk_esignLibraryMaster = esign_library_category.fk_esignLibraryMaster');
		if($libraryId && $libraryId  != "0"){
			$this->db->where('esign_library_category.fk_esignLibraryMaster', $libraryId);
		}
		$res['count'] = $this->db->get()->num_rows();

		$this->_get_datatables_query($postData);
		$this->db->select('esignLibraryTemplateId, title, categoryName, isFavorite, status')
		->where('esign_library_template.user_id',$userId )
		->where('esign_library_template.isActive',1 )
		->where('esign_library_master.isActive',1 )
		->where('esign_library_category.isActive',1 )
		->join( "esign_library_category", 'esign_library_category.category_id = esign_library_template.category_id')
		->join( "esign_library_master", 'esign_library_master.pk_esignLibraryMaster = esign_library_category.fk_esignLibraryMaster');
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
			$editUrl = base_url('esign/editTemplate?id='.$member->esignLibraryTemplateId);
			$action  = '
				<a href="'.$editUrl.'"><i class="fa fa-edit"></i></a>
				<a class="trashColor" href="#"><i id="deleteId-'.$member->esignLibraryTemplateId.'" class="fa fa-trash"></i></a>
			';
			$title = '<a style="cursor: pointer;" redirectUrl="'.$editUrl.'" ondblclick="redirectOnDoubleClickToTitle(this)">'.$member->title.'</a>';
			$data[] = array(
				$title,
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