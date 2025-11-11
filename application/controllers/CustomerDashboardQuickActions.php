<?php
defined('BASEPATH') or exit('No direct script access allowed');
ini_set('max_input_vars', 30000);

class Action
{
    public function __construct($props)
    {
        foreach ($props as $key => $prop) {
            $this->$key = $prop;
        }
    }
}

class CustomerDashboardQuickActions extends MYF_Controller
{
    const ONE_MB = 1048576;

    public function __construct()
    {
        parent::__construct();
    }

    private function getActions($isArray = false)
    {
        $actions = [
            [
                'text' => 'Create Job',
                'url' => base_url('/job/new_job1?cus_id=:customerid'),
                'sub_text' => 'Jobs',
            ],
            [
                'text' => 'Submit Service Ticket',
                'url' => base_url('/tickets/addTicketCust/:customerid'),
                'sub_text' => 'Tickets',
            ],
            [
                'text' => 'Create Estimate',
                'url' => '#new_estimate_modal',
                'sub_text' => 'Estimates',
            ],
            [
                'text' => 'Add Credit Industry Item',
                'url' => base_url('/customer/add_dispute_item/:customerid'),
                'sub_text' => 'Credit Industry',
            ],
            [
                'text' => 'Call Customer',
                'url' => base_url('/customer/call/:customerid'),
                'sub_text' => 'Customers',
            ],
            [
                'text' => 'Send Secure Message, Via Client Portal',
                'url' => '',
                'sub_text' => 'Customers',
            ],
            [
                'text' => 'Show Customer Activites',
                'url' => base_url('/customer/activities/:customerid'),
                'sub_text' => 'Customers',
            ],
            [
                'text' => 'Run Dispute Wizard, Create letters/correct errors',
                'url' => base_url('/EsignEditor/wizard?customer_id=:customerid'),
                'sub_text' => 'Esign Editor',
            ],
            [
                'text' => '1-Click Import and Audit, Pull reports & Create audit',
                'url' => '',
            ],
            [
                'text' => 'Send Link Reset Password',
                'url' => '',
                'sub_text' => 'Customers',
            ],
            [
                'text' => 'Edit Customer',
                'url' => base_url('/customer/add_advance/:customerid'),
                'sub_text' => 'Customers',
            ],
            [
                'text' => 'Create Invoice',
                'url' => base_url('/accounting/banking?action=invoiceModal&customer=:customerid'),
                'sub_text' => 'Accounting',
            ],
            [
                'text' => 'Receive Payment',
                'url' => base_url('/accounting/banking?action=receivePaymentModal&customer=:customerid'),
                'sub_text' => 'Accounting',
            ],
            [
                'text' => 'Create Credit Memo',
                'url' => base_url('/accounting/banking?action=creditMemoModal&customer=:customerid'),
                'sub_text' => 'Accounting',
            ],
            [
                'text' => 'Create Sales Receipt',
                'url' => base_url('/accounting/banking?action=salesReceiptModal&customer=:customerid'),
                'sub_text' => 'Accounting',
            ],
            [
                'text' => 'Create Refund Receipt',
                'url' => base_url('/accounting/banking?action=refundReceiptModal&customer=:customerid'),
                'sub_text' => 'Accounting',
            ],
            [
                'text' => 'Create Delayed Credit',
                'url' => base_url('/accounting/banking?action=delayedCreditModal&customer=:customerid'),
                'sub_text' => 'Accounting',
            ],
            [
                'text' => 'Create Delayed Charge',
                'url' => base_url('/accounting/banking?action=delayedChargeModal&customer=:customerid'),
                'sub_text' => 'Accounting',
            ],
            [
                'text' => 'Send email',
                'url' => 'mailto::customeremail',
                'sub_text' => 'Customers',
            ],
            [
                'text' => 'Add task',
                'url' => '#estimates_import',
                'sub_text' => 'Tasks',
            ],
        ];

        if ($isArray) {
            return $actions;
        }

        return array_map(function ($action) {
            return new Action($action);
        }, $actions);
    }

    public function seed()
    {
        $actions = $this->getActions(true);
        $fields = [];

        foreach ($actions as $action) {
            $fields = array_unique(array_merge($fields, array_keys($action)));
        }

        $actions = array_map(function ($action) use ($fields) {
            foreach ($fields as $field) {
                if (!array_key_exists($field, $action)) {
                    $action[$field] = null;
                }
            }

            return $action;
        }, $actions);

        foreach ($actions as $action) {
            $duplicateUpdate = [];
            foreach ($action as $key => $value) {
                $duplicateUpdate[] = is_null($value) ? "{$key}=NULL" : "{$key}='$value'";
            }

            $query = $this->db->insert_string('acs_dashboard_quick_actions', $action) . " ON DUPLICATE KEY UPDATE " . implode(',', $duplicateUpdate);
            $this->db->query($query);
        }

        $this->respond(['data' => 'Successfully seeded']);
    }

    private function getSavedActions()
    {
        $this->db->order_by('sub_text', 'ASC');
        $this->db->order_by('text', 'ASC');
        return $this->db->get('acs_dashboard_quick_actions')->result();
    }

    function list()
    {
        $this->respond(['data' => $this->getSavedActions()]);
    }

    private function respond($response)
    {
        header('content-type: application/json');
        exit(json_encode($response));
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false]);
            return;
        }

        $payload = json_decode(file_get_contents('php://input'), true);
        $this->db->db_debug = false;

        if (!@$this->db->insert('acs_customer_dashboard_quick_actions', $payload)) {
            $this->respond(['data' => $this->db->error()]);
        }

        $this->db->where('id', $this->db->insert_id());
        $action = $this->db->get('acs_customer_dashboard_quick_actions')->row();
        $this->respond(['data' => $action]);
    }

    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false]);
            return;
        }

        $payload = json_decode(file_get_contents('php://input'), true);
        $this->db->where('customer_id', $payload['customer_id']);
        $this->db->where('acs_dashboard_quick_actions_id', $payload['acs_dashboard_quick_actions_id']);
        $this->db->delete('acs_customer_dashboard_quick_actions');
        $this->respond(['data' => null]);
    }

    public function getCustomerActions($customerId)
    {
        $this->db->select('qa.*', false);
        $this->db->from('acs_customer_dashboard_quick_actions dqa');
        $this->db->where('customer_id', $customerId);
        $this->db->join('acs_dashboard_quick_actions qa', 'dqa.acs_dashboard_quick_actions_id = qa.id', 'left');
        $this->db->order_by('dqa.id', 'ASC');
        $query = $this->db->get();
        $actions = $query->result();
        $this->respond(['data' => $actions]);
    }

    public function getCustomerById($customerId)
    {
        $this->db->where('prof_id', $customerId);
        $customer = $this->db->get('acs_profile')->row();
        $this->respond(['data' => $customer]);
    }

    private function getCustomerDocumentPath($customer_id)
    {
        $filePath = FCPATH . (implode(DIRECTORY_SEPARATOR, ['uploads', 'customerdocuments', $customer_id]) . DIRECTORY_SEPARATOR);
        if (!file_exists($filePath)) {
            mkdir($filePath, 0777, true);
        }

        return $filePath;
    }

    public function uploadCustomerDocument()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->respond(['success' => false]);
        }

        $document = $_FILES['document'];
        ['document_type' => $documentType, 'customer_id' => $customerId, 'document_label' => $documentLabel, 'is_document_limit' => $isDocumentLimit] = $this->input->post();
        
        $filePath = $this->getCustomerDocumentPath($customerId);

        $maxSizeInMB = 8;
        if ($document['size'] > self::ONE_MB * $maxSizeInMB) {
            $this->respond([
                'success' => false,
                'reason' => "Maximum file size is less than {$maxSizeInMB}MB",
            ]);
        }

        $tempName = $document['tmp_name'];
        $fileName = $document['name'];
        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
        $fileName = uniqid($customerId) . str_replace('.tmp', '', basename($tempName)) . '.' . $fileExtension;

        $this->db->where('customer_id', $customerId);
        $this->db->where('document_type', $documentType);
        $currDocument = $this->db->get('acs_customer_documents')->row();
        $documentId = null;

        if (!is_null($currDocument) && $documentType != 'client_agreement' && $documentType != 'site_photos' && $documentType != 'photo_id_copy' ) {
            if ($currDocument->file_name && file_exists($filePath . $currDocument->file_name)) {
                unlink($filePath . $currDocument->file_name);
            }

            $this->db->where('id', $currDocument->id);
            $this->db->update('acs_customer_documents', ['file_name' => $fileName]);
            $documentId = $currDocument->id;
        } else {

            if( ($documentType == 'client_agreement' && $isDocumentLimit == 1) || ($documentType == 'site_photos' && $isDocumentLimit == 1) ){
                $this->db->where('customer_id', $customerId);
                $this->db->where('document_type', $documentType);
                $this->db->order_by('id', 'DESC');
                $lastestDocument = $this->db->get('acs_customer_documents')->row();
                if ($lastestDocument->file_name && file_exists($filePath . $lastestDocument->file_name)) {
                    unlink($filePath . $lastestDocument->file_name);
                }

                $this->db->where('id', $lastestDocument->id);
                $this->db->update('acs_customer_documents', ['file_name' => $fileName]);
                $documentId = $lastestDocument->id;

            }else{
                $predefinedTypes = [
                    'client_agreement',
                    'client_certificate',
                    'photo_id_copy',
                    'proof_of_residency',
                    'personal_guarantee',
                ];
    
                $row = [
                    'file_name' => $fileName,
                    'customer_id' => $customerId,
                    'document_type' => $documentType,
                    'document_label' => $documentLabel,
                    'is_predefined' => in_array(strtolower($documentType), $predefinedTypes),
                    'date_created' => date("Y-m-d H:i:s")
                ];
    
                $this->db->insert('acs_customer_documents', $row);
                $documentId = $this->db->insert_id();
            }
        }

        move_uploaded_file($tempName, $filePath . $fileName);

        $this->db->where('id', $documentId);
        $this->respond(['data' => $this->db->get('acs_customer_documents')->row()]);
    }

    public function deleteCustomerDocumentV1()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->respond(['success' => false]);
        }

        $payload = json_decode(file_get_contents('php://input'), true);
        ['document_type' => $documentType, 'customer_id' => $customerId] = $payload;

        $filePath = $this->getCustomerDocumentPath($customerId);

        $this->db->where('customer_id', $customerId);
        $this->db->where('document_type', $documentType);
        $currDocument = $this->db->get('acs_customer_documents')->row();

        if (!is_null($currDocument)) {
            if ($currDocument->file_name && file_exists($filePath . $currDocument->file_name)) {
                unlink($filePath . $currDocument->file_name);
            }
        }

        $forceDelete = (bool) $this->input->get('delete', true);

        if ($currDocument->is_predefined == 1 || $forceDelete) {
            $this->db->where('customer_id', $customerId);
            $this->db->where('document_type', $documentType);
            $this->db->delete('acs_customer_documents');
        } else {
            $this->db->where('id', $currDocument->id);
            $this->db->update('acs_customer_documents', ['file_name' => null]);
        }

        $this->respond(['data' => null, 'deleted' => $payload]);
    }

    public function deleteCustomerDocument()
    {
        $this->load->model('CustomerSignature_model');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->respond(['success' => false]);
        }

        $payload = json_decode(file_get_contents('php://input'), true);
        ['document_type' => $documentType, 'customer_id' => $customerId] = $payload;

        if( $documentType != 'customer_signature' ){
            $filePath = $this->getCustomerDocumentPath($customerId);

            $this->db->where('customer_id', $customerId);
            $this->db->where('document_type', $documentType);
            $currDocument = $this->db->get('acs_customer_documents')->row();

            if( $currDocument ){
                $this->db->where('id', $currDocument->id);
                $this->db->update('acs_customer_documents', ['is_active' => 0]);
            }
        }else{
            $customerSignature = $this->CustomerSignature_model->getByCustomerId($customerId);
            if( $customerSignature ){
                $this->CustomerSignature_model->delete($customerSignature->id);
            }
        }

        $this->respond(['data' => null, 'deleted' => $payload]);
    }

    public function downloadCustomerDocument()
    {
        $this->load->model('CustomerSignature_model');

        $customerId = $this->input->get('customer_id', true);
        $documentTypes = explode(',', $this->input->get('document_type', true));
        $filePath = $this->getCustomerDocumentPath($customerId);

        if (in_array('esign', $documentTypes)) {
            $id = $this->input->get('generated_esign_id', true);
            $this->db->where('docfile_id', $id);
            $generatedPDF = $this->db->get('user_docfile_generated_pdfs')->row();
            $generatedPDFPath = FCPATH . ltrim($generatedPDF->path, '/');

            if (!file_exists($generatedPDFPath)) {
                show_404();
            }

            $file = $generatedPDFPath;
            $fileName = explode('/', $generatedPDF->path);
            $fileName = 'esign_' . end(array_values($fileName));
        }elseif( $documentTypes[0] == 'customer_signature' ){
            $customerSignature = $this->CustomerSignature_model->getByCustomerId($customerId);
            if( $customerSignature ){
                $dataUri = $customerSignature->value; 
                list($type, $data) = explode(';', $dataUri);
                list(, $data)      = explode(',', $data);
                list(, $mimeType)  = explode(':', $type);
                $imageData = base64_decode($data);
                header('Content-Type: ' . $mimeType);
                header('Content-Disposition: attachment; filename="signature_image.png"'); // Adjust filename and extension
                header('Content-Length: ' . strlen($imageData));
                echo $imageData;
                exit;
            }
        } else {
            $this->db->where('customer_id', $customerId);
            $this->db->where('file_name IS NOT NULL', null, false);
            $this->db->where('file_name <>', "''", false);
            $this->db->where_in('document_type', $documentTypes);
            $documents = $this->db->get('acs_customer_documents')->result();

            $file = null;
            $fileName = null;
            $isZipArchive = false;

            if (count($documents) === 1) {
                $document = $documents[0];
                if (!$document->file_name || !file_exists($filePath . $document->file_name)) {
                    show_404();
                }

                $file = $filePath . $document->file_name;
                $fileName = $document->document_type . '_' . $document->file_name;
            } else {
                $fileName = uniqid() . '.zip';
                $file = $fileName;
                $isZipArchive = true;
                $isEmpty = true;

                $zip = new ZipArchive;
                $zip->open($fileName, ZipArchive::CREATE);

                foreach ($documents as $document) {
                    $path = $filePath . $document->file_name;
                    $name = $document->document_type . '_' . $document->file_name;

                    if ($document->file_name && file_exists($path)) {
                        $isEmpty = false;
                        $zip->addFile($path, $name);
                    }
                }

                $zip->close();

                if ($isEmpty) {
                    show_404();
                }
            }
        }

        if ($isZipArchive) {
            header('Content-Type: application/zip');
            header('Content-Length: ' . filesize($file));
        } else {
            header('Content-type: application/octet-stream');
            header('Content-Type: ' . mime_content_type($file));
        }

        header('Content-Disposition: attachment; filename=' . $fileName);
        while (ob_get_level()) {
            ob_end_clean();
        }
        readfile($file);

        if ($isZipArchive && file_exists($fileName)) {
            unlink($fileName);
        }
    }

    public function createCustomerDocumentLabel()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->respond(['success' => false]);
        }

        $payload = json_decode(file_get_contents('php://input'), true);
        $this->db->db_debug = false;

        if (!@$this->db->insert('acs_customer_documents', $payload)) {
            $this->respond(['data' => $this->db->error(), 'success' => false]);
        }

        $this->db->where('id', $this->db->insert_id());
        $this->respond(['data' => $this->db->get('acs_customer_documents')->row()]);
    }

    public function getCustomerDocuments($customerId)
    {
        $this->db->where('customer_id', $customerId);
        $this->respond(['data' => $this->db->get('acs_customer_documents')->result()]);
    }

    public function updateCustomerDocument()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->respond(['success' => false]);
        }

        $payload = json_decode(file_get_contents('php://input'), true);
        ['document_type' => $documentType, 'customer_id' => $customerId] = $payload;

        $this->db->where('customer_id', $customerId);
        $this->db->where('document_type', $documentType);
        $currDocument = $this->db->get('acs_customer_documents')->row();

        if (!$currDocument) {
            $this->respond(['data' => null]);
        }

        $this->db->where('id', $currDocument->id);
        $this->db->update('acs_customer_documents', $payload);

        $this->db->where('id', $currDocument->id);
        $this->respond(['data' => $this->db->get('acs_customer_documents')->row()]);
    }

    public function mobileDownloadCustomerDocument()
    {
        $this->load->model('FileVault_model');

        $is_success = 0;
        $msg = 'Cannot find data';
        
        $documentTypes = explode(',', $this->input->get('document_type', true));
        if (in_array('esign', $documentTypes)) {
            $id = $this->input->get('generated_esign_id', true);
            $this->db->where('docfile_id', $id);
            $generatedPDF = $this->db->get('user_docfile_generated_pdfs')->row();
            $generatedPDFPath = FCPATH . ltrim($generatedPDF->path, '/');

            if (!file_exists($generatedPDFPath)) {
                $msg = 'File does not exists.';
            }

            $file = $generatedPDFPath;
            $fileName = explode('/', $generatedPDF->path);
            $fileName = 'esign_' . end(array_values($fileName));

            $this->db->where('id', $generatedPDF->docfile_id);
            $userDocfile = $this->db->get('user_docfile')->row();
            if( $userDocfile ){
                $this->db->where('prof_id', $userDocfile->customer_id);
                $customer = $this->db->get('acs_profile')->row();
                $customer_name  = $customer->first_name . ' ' . $customer->last_name;
                $esign_filename = explode('/', $generatedPDF->path);
                $esign_filename = end(array_values($esign_filename));
                $vault_location = FCPATH . 'uploads/filevault_v2/'.$userDocfile->company_id.'/'.$esign_filename;
                $vault_location_db = 'filevault_v2/'.$userDocfile->company_id.'/'.$esign_filename;

                $isFileExists = $this->FileVault_model->getByNameAndCompanyId($esign_filename, $userDocfile->company_id);
                //if (!file_exists($vault_location)) {          
                if( !$isFileExists ){
                    $file_size = filesize($generatedPDFPath);          
                    copy($generatedPDFPath, $vault_location);                    

                    $this->db->insert('filevault_v2', [
                        'name' => $esign_filename,
                        'template_name' => $userDocfile->name,
                        'customer_name' => $customer_name,
                        'file_path' => $vault_location_db,
                        'file_size' => $file_size,
                        'file_type' => 'pdf',
                        'created_by' => $userDocfile->user_id,
                        'date_created' => date("Y-m-d H:i:s"),
                        'date_modified' => date("Y-m-d H:i:s"),
                        'last_action_performed' => 'Created',
                        'last_action_performed_by' => $userDocfile->user_id,
                        'is_folder' => 0,
                        'folder_color' => '#9A9A9A',
                        'parent_id' => 0,
                        'is_shared' => 1,
                        'is_starred' => 0,
                        'company_id' => $userDocfile->company_id,
                        'downloads_count' => 0,
                        'previews_count' => 0,
                        'softdelete' => 0,
                        'softdelete_date' => NULL,
                        'softdelete_by' => 0
                    ]);
                }
                //}

                $is_success = 1;
                $msg = '';
            }
        } 

        echo json_encode([
            'is_success' => $is_success,
            'msg' => $msg
        ]);

        exit;
    }

    public function downloadDocument($document_id)
    {
        $cid = logged('company_id');

        $customerId = $this->input->get('customer_id', true);
        $documentTypes = explode(',', $this->input->get('document_type', true));
        $this->db->where('id', $document_id);
        $this->db->where('file_name IS NOT NULL', null, false);
        $this->db->where('file_name <>', "''", false);
        $document = $this->db->get('acs_customer_documents')->row();

        $filePath = $this->getCustomerDocumentPath($document->customer_id);

        if( $document && file_exists($filePath . $document->file_name) ){
            $this->db->select('prof_id, company_id');
            $this->db->where('prof_id', $document->customer_id);
            $customer = $this->db->get('acs_profile')->row();

            if( $customer->company_id == $cid ){
                $fileName = $document->file_name;
                $file = $filePath . $fileName;
                
                header('Content-type: application/octet-stream');
                header('Content-Type: ' . mime_content_type($file));

                header('Content-Disposition: attachment; filename=' . $fileName);
                while (ob_get_level()) {
                    ob_end_clean();
                }

                readfile($file);
            }else{
                show_404();
            }
        }else{
            show_404();
        }
    }

    public function ajaxDeleteClientAgreement()
    {
        $this->load->model('AcsCustomerDocument_model');
        
        $is_success = 0;
        $msg = 'Cannot find data';

        $cid = logged('company_id');
        $post = $this->input->post();

        $filePath = $this->getCustomerDocumentPath($customerId);

        $document = $this->AcsCustomerDocument_model->getById($post['cdi']);
        if( $document && $document->company_id == $cid ){
            if ($document->file_name && file_exists($filePath . $document->file_name)) {
                unlink($filePath . $document->file_name);
            }

            $this->AcsCustomerDocument_model->delete($document->id);  
            
            $is_success = 1;
            $msg = '';
        }

        echo json_encode([
            'is_success' => $is_success,
            'msg' => $msg
        ]);
    }

    public function ajaxDeleteCustomerDocument()
    {
        $this->load->model('AcsCustomerDocument_model');
        
        $is_success = 0;
        $msg = 'Cannot find data';

        $cid = logged('company_id');
        $post = $this->input->post();

        $document = $this->AcsCustomerDocument_model->getById($post['cdi']);
        if( $document && $document->company_id == $cid ){
            $customerId = $document->customer_id;
            $filePath   = $this->getCustomerDocumentPath($customerId);
            if ($document->file_name && file_exists($filePath . $document->file_name)) {
                unlink($filePath . $document->file_name);
            }

            $this->AcsCustomerDocument_model->delete($document->id);  
            
            $is_success = 1;
            $msg = '';
        }

        echo json_encode([
            'is_success' => $is_success,
            'msg' => $msg
        ]);
    }

    public function customerTotalClientAgreement()
    {
        $cid = logged('company_id');
        $post = $this->input->post();

        $this->db->where('customer_id', $post['cid']);
        $this->db->where('document_type', 'client_agreement');
        $clientAgreements = $this->db->get('acs_customer_documents')->result();
        
        $total = count($clientAgreements);
        //$total = 3;
        echo json_encode([
            'total' => $total
        ]);
    }

    public function customerTotalSitePhotos()
    {
        $cid = logged('company_id');
        $post = $this->input->post();

        $this->db->where('customer_id', $post['cid']);
        $this->db->where('document_type', 'site_photos');
        $sitePhotos = $this->db->get('acs_customer_documents')->result();
        
        $total = count($sitePhotos);
        //$total = 3;
        echo json_encode([
            'total' => $total
        ]);
    }

    public function ajaxGetDocumentArchives()
    {
        $post = $this->input->post();

        $this->db->where('customer_id', $post['cid']);
        $this->db->where('is_active', 0);
        $archivedDocuments = $this->db->get('acs_customer_documents')->result();

        $this->page_data['archivedDocuments'] = $archivedDocuments;
        $this->load->view('v2/pages/customer/ajax_customer_document_archive_list', $this->page_data);
    }

    public function ajaxRestoreArchivedDocument()
    {
        $is_success = 0;
        $msg = 'Cannot find data';

        $cid = logged('company_id');
        $post = $this->input->post();

        $this->db->where('id', $post['cdi']);
        $document = $this->db->get('acs_customer_documents')->row();
        if( $document ){
            $this->db->select('prof_id, company_id');
            $this->db->where('prof_id', $document->customer_id);
            $customer = $this->db->get('acs_profile')->row();

            if( $customer->company_id == $cid ){
                $this->db->where('id', $document->id);
                $this->db->update('acs_customer_documents', ['is_active' => 1]);

                $is_success = 1;
                $msg = '';
            } 
        }


        echo json_encode([
            'is_success' => $is_success,
            'msg' => $msg
        ]);
    }
}
