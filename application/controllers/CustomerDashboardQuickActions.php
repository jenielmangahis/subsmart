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

class CustomerDashboardQuickActions extends MY_Controller
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
                'url' => base_url('/customer/addTicket?cus_id=:customerid'),
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

    function list() {
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

    private function getCustomerDocumentPath()
    {
        $filePath = FCPATH . (implode(DIRECTORY_SEPARATOR, ['uploads', 'customerdocuments']) . DIRECTORY_SEPARATOR);
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

        $filePath = $this->getCustomerDocumentPath();

        $document = $_FILES['document'];
        ['document_type' => $documentType, 'customer_id' => $customerId, 'document_label' => $documentLabel] = $this->input->post();

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

        if (!is_null($currDocument)) {
            if ($currDocument->file_name && file_exists($filePath . $currDocument->file_name)) {
                unlink($filePath . $currDocument->file_name);
            }

            $this->db->where('id', $currDocument->id);
            $this->db->update('acs_customer_documents', ['file_name' => $fileName]);
            $documentId = $currDocument->id;
        } else {
            $predefinedTypes = [
                'client_agreement',
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
            ];

            $this->db->insert('acs_customer_documents', $row);
            $documentId = $this->db->insert_id();
        }

        move_uploaded_file($tempName, $filePath . $fileName);

        $this->db->where('id', $documentId);
        $this->respond(['data' => $this->db->get('acs_customer_documents')->row()]);
    }

    public function deleteCustomerDocument()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->respond(['success' => false]);
        }

        $filePath = $this->getCustomerDocumentPath();

        $payload = json_decode(file_get_contents('php://input'), true);
        ['document_type' => $documentType, 'customer_id' => $customerId] = $payload;

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

    public function downloadCustomerDocument()
    {

        $filePath = $this->getCustomerDocumentPath();

        $customerId = $this->input->get('customer_id', true);
        $documentTypes = explode(',', $this->input->get('document_type', true));

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

        if ($isZipArchive) {
            header('Content-Type: application/zip');
            header('Content-Length: ' . filesize($file));

        } else {
            header('Content-type: application/octet-stream');
            header('Content-Type: ' . mime_content_type($file));
        }

        header('Content-Disposition: attachment; filename=' . $fileName);
        while (ob_get_level()) {ob_end_clean();}
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
}
