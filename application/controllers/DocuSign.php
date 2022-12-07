<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DocuSign extends MYF_Controller
{
    const ONE_MB = 1048576;
    private $password = 'Riwb5moQi%S@$c8ZM3dq';

    public function __construct()
    {
        parent::__construct();
    }

    public function signing()
    {
        $this->load->view('esign/docusign/signing', $this->page_data);
    }

    public function apiSigning()
    {
        $decrypted = decrypt($this->input->get('hash', true), $this->password);
        $decrypted = json_decode($decrypted, true);
        ['recipient_id' => $recipientId, 'document_id' => $documentId] = $decrypted;
        $isSelfSigned = $decrypted['is_self_signed'] ?? false;

        $this->db->where('id', $recipientId);
        $this->db->where('docfile_id', $documentId);
        $recipient = $this->db->get('user_docfile_recipients')->row();

        $this->db->where('docfile_id', $documentId);
        if (!$isSelfSigned) {
            $this->db->where('user_docfile_recipients_id', $recipientId);
        }
        $fields = $this->db->get('user_docfile_fields')->result();

        foreach ($fields as $field) {
            $this->db->where('recipient_id', $field->user_docfile_recipients_id);
            $this->db->where('field_id', $field->id);
            $field->value = $this->db->get('user_docfile_recipient_field_values')->row();
        }

        $this->db->where('docfile_id', $documentId);
        $this->db->where('completed_at !=', null);
        $this->db->where('id !=', $recipientId);
        $completedRecipients = $this->db->get('user_docfile_recipients')->result();

        $coRecipientFields = [];
        foreach ($completedRecipients as $_recipient) {
            $this->db->where('docfile_id', $documentId);
            $this->db->where('user_docfile_recipients_id', $_recipient->id);
            $_fields = $this->db->get('user_docfile_fields')->result();

            foreach ($_fields as $field) {
                $this->db->where('recipient_id', $field->user_docfile_recipients_id);
                $this->db->where('field_id', $field->id);
                $field->value = $this->db->get('user_docfile_recipient_field_values')->row();
            }

            $coRecipientFields[] = [
                'recipient' => $_recipient,
                'fields' => $_fields,
            ];
        }

        $this->db->where('id', $documentId);
        $document = $this->db->get('user_docfile')->row();

        $this->db->where('docfile_id', $documentId);
        $this->db->order_by('id', 'ASC');
        $files = $this->db->get('user_docfile_documents')->result_array();

        $this->db->where('user_docfile_recipient_id', $recipientId);
        $workorderRecipient = $this->db->get('user_docfile_workorder_recipients')->row();

        if ($workorderRecipient) {
            $workorderRecipient = $this->_getWorkorderCustomer($workorderRecipient->workorder_id);
        }

        $jobRecipient = null;
        if (!$workorderRecipient) {
            $this->db->where('user_docfile_recipient_id', $recipientId);
            $jobRecipient = $this->db->get('user_docfile_job_recipients')->row();

            if ($jobRecipient) {
                $jobRecipient = $this->_getJobCustomer($jobRecipient->job_id);
            }
        }

        header('content-type: application/json');
        echo json_encode([
            'document' => $document,
            'recipient' => $recipient,
            'fields' => $fields,
            'files' => $files,
            'workorder_recipient' => $workorderRecipient,
            'job_recipient' => $jobRecipient,
            'co_recipients' => $coRecipientFields,
            'decrypted' => $decrypted,
        ]);
    }

    public function send()
    {
        header('content-type: application/json');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false]);
            return;
        }

        $payload = json_decode(file_get_contents('php://input'), true);
        $documentId = $payload['document_id'] ?? null;

        $this->db->where('id', $documentId);
        $document = $this->db->get('user_docfile')->row_array();

        if (!$document) {
            set_status_header(404);
            echo json_encode(['error' => 404]);
            return;
        }

        $this->db->where('docfile_id', $documentId);
        $this->db->where('completed_at is NULL', null, false);
        $this->db->order_by('id', 'asc');
        $this->db->limit(1);
        $recipient = $this->db->get('user_docfile_recipients')->row_array();

        $response = json_encode(['data' => $document]);
        if ($recipient['role'] === 'Needs to Sign') {
            ['error' => $error] = $this->sendEnvelope($document, $recipient);
            $response = json_encode(['success' => is_null($error), 'error' => $error]);
        } else if ($recipient['role'] === 'Signs in Person') {
            $message = json_encode(['recipient_id' => $recipient['id'], 'document_id' => $document['id']]);
            $hash = encrypt($message, $this->password);
            $response = json_encode(['hash' => $hash]);

            $this->db->where('id', $recipient['id']);
            $this->db->update('user_docfile_recipients', ['sent_at' => date('Y-m-d H:i:s')]);
        }

        $this->db->where('id', $documentId);
        $this->db->update('user_docfile', ['status' => 'Waiting for Others']);
        echo $response;
    }

    public function manage()
    {
        $this->checkLogin();

        add_css([
            'https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css',
            'assets/css/esign/docusign/manage/manage.css',
            'assets/css/esign/docusign/template-create/template-create.css',
            'assets/css/esign/esign-builder/esign-builder.css',
            'assets/css/esign/esign.css',
        ]);

        add_footer_js([
            'assets/js/esign/libs/pdf.js',
            'assets/js/esign/libs/pdf.worker.js',

            'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js',
            'https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js',
            'assets/js/esign/docusign/manage.js',
        ]);

        $this->load->view('esign/docusign/manage', $this->page_data);
    }

    public function apiManage($view)
    {
        $view = strtolower($view);
        $documents = $this->getManageData($view);
        $data = [];

        foreach ($documents as $document) {
            if ($view === 'deleted') {
                $trashedAt = strtotime($document->trashed_at);
                $timeDiff = strtotime('now') - $trashedAt;
                $isMoreThan24Hours = $timeDiff > 86400;

                if ($isMoreThan24Hours) {
                    $this->db->where('id', $document->id);
                    $this->db->update('user_docfile', ['status' => 'Deleted']);
                    continue;
                }
            }

            $this->db->where('docfile_id', $document->id);
            $document->recipients = $this->db->get('user_docfile_recipients')->result();

            if ($document->status === 'Waiting for Others') {
                // makes sure to order recipients.
                $recipientsCopy = array_merge([], $document->recipients);
                usort($recipientsCopy, function ($recipientA, $recipientB) {
                    return (int) $recipientA->id - (int) $recipientB->id;
                });

                $nextSignsInPerson = current(array_filter($recipientsCopy, function ($recipient) {
                    return $recipient->role === 'Signs in Person' && is_null($recipient->completed_at);
                }));

                if ($nextSignsInPerson) {
                    $document->next_recipient = $nextSignsInPerson;

                    $message = json_encode([
                        'recipient_id' => $document->next_recipient->id,
                        'document_id' => $document->id,
                    ]);

                    $hash = encrypt($message, $this->password);
                    $document->next_recipient->signing_url = $this->getSigningUrl() . '/signing?hash=' . $hash;
                }
            }

            array_push($data, $document);
        }

        if ($view === 'action_required') {
            foreach ($data as $document) {
                $recipientId = null;
                foreach ($document->recipients as $recipient) {
                    if ($recipient->email === logged('email')) {
                        $recipientId = $recipient->id;
                        break;
                    }
                }

                $message = json_encode([
                    'recipient_id' => $recipientId,
                    'document_id' => $document->id,
                ]);
                $hash = encrypt($message, $this->password);
                $document->signing_url = $this->getSigningUrl() . '/signing?hash=' . $hash;
            }
        }

        header('content-type: application/json');
        echo json_encode(['data' => $data, 'view' => $view]);
    }

    private function getManageData($view)
    {
        $view = strtolower($view);

        if ($view === 'action_required') {
            return $this->getActionRequired();
        }

        $this->db->where('user_id', logged('id'));
        switch ($view) {
            case 'sent':
                $this->db->select('docfile_id');
                $this->db->group_by('docfile_id');
                $this->db->where('sent_at is NOT NULL', null, false);
                $docfileIds = $this->db->get('user_docfile_recipients')->result();
                $docfileIds = array_column($docfileIds, 'docfile_id');

                $this->db->where_not_in('status', ['Trashed', 'Deleted']);
                $this->db->where_in('id', empty($docfileIds) ? [-1] : $docfileIds);
                break;

            case 'drafts':
                $this->db->where('status', 'Draft');
                break;

            case 'deleted':
                $this->db->where('status', 'Trashed');
                $this->db->where('trashed_at is NOT NULL', null, false);
                break;

            default:
                $this->db->where('status !=', 'Deleted');
        }

        return $this->db->get('user_docfile')->result();
    }

    public function apiTrash($documentId)
    {
        $this->db->where('id', $documentId);
        $this->db->update('user_docfile', ['status' => 'Trashed', 'trashed_at' => date('Y-m-d H:i:s')]);

        $this->db->where('id', $documentId);
        $document = $this->db->get('user_docfile')->row();

        header('content-type: application/json');
        echo json_encode(['data' => $document]);
    }

    public function apiVoid($documentId)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false]);
            return;
        }

        $payload = json_decode(file_get_contents('php://input'), true);
        $reason = $payload['reason'] ?? null;

        if (!$reason || empty($reason)) {
            echo json_encode(['success' => false]);
            return;
        }

        $this->db->where('id', $documentId);
        $this->db->update('user_docfile', [
            'status' => 'Voided',
            'reason' => $reason,
        ]);

        $this->db->where('id', $documentId);
        $document = $this->db->get('user_docfile')->row();

        $this->db->where('id', logged('id'));
        $inviter = $this->db->get('users')->row();
        $inviterName = implode(' ', [$inviter->FName, $inviter->LName]);

        $this->db->where('docfile_id', $documentId);
        $this->db->where('role', 'Needs to Sign');
        $recipients = $this->db->get('user_docfile_recipients')->result();

        $mail = email__getInstance();
        $templatePath = VIEWPATH . 'esign/docusign/email/void.html';
        $template = file_get_contents($templatePath);

        foreach ($recipients as $recipient) {
            if (!is_null($recipient->signed_at)) {
                continue;
            }

            $data = [
                '%inviter%' => $inviterName,
                '%document_name%' => $document->name,
                '%reason%' => $document->reason,
            ];

            $message = strtr($template, $data);

            $mail->MsgHTML($message);
            $mail->addAddress($recipient->email);
            $mail->send();
            $mail->ClearAllRecipients();
        }

        header('content-type: application/json');
        echo json_encode(['data' => $document]);
    }

    public function apiStoreFieldValue()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false]);
            return;
        }

        $payload = json_decode(file_get_contents('php://input'), true);
        $isCreated = false;
        $tableName = 'user_docfile_recipient_field_values';

        $this->db->where('recipient_id', $payload['recipient_id']);
        $this->db->where('field_id', $payload['field_id']);
        $record = $this->db->get($tableName)->row();

        if (is_null($record)) {
            $isCreated = true;
            $this->db->insert($tableName, $payload);
        } else {
            $this->db->where('id', $record->id);
            $this->db->update($tableName, $payload);
        }

        $id = $isCreated ? $this->db->insert_id() : $record->id;
        $this->db->where('id', $id);
        $record = $this->db->get($tableName)->row();

        header('content-type: application/json');
        echo json_encode(['data' => $record, 'is_created' => $isCreated]);
    }

    public function apiCopy($documentId)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false]);
            return;
        }

        $this->db->where('id', $documentId);
        $source = (array) $this->db->get('user_docfile')->row();
        $source['status'] = 'Draft';
        unset($source['id']);
        unset($source['created_at']);
        unset($source['updated_at']);

        // 1. copy document
        $this->db->insert('user_docfile', $source);
        $this->db->where('id', $this->db->insert_id());
        $record = $this->db->get('user_docfile')->row();

        $this->db->where('docfile_id', $documentId);
        $recipients = $this->db->get('user_docfile_recipients')->result_array();

        foreach ($recipients as $recipient) {
            $currRecipientId = $recipient['id'];
            $recipient['docfile_id'] = $record->id;

            unset($recipient['id']);
            unset($recipient['sent_at']);
            unset($recipient['signed_at']);

            // 2. copy recipients
            $this->db->insert('user_docfile_recipients', $recipient);
            $recipientId = $this->db->insert_id();

            $this->db->where('docfile_id', $documentId);
            $this->db->where('user_docfile_recipients_id', $currRecipientId);
            $recipientFields = $this->db->get('user_docfile_fields')->result_array();

            if (empty($recipientFields)) {
                continue;
            }

            $fields = array_map(function ($field) use ($record, $recipientId) {
                unset($field['id']);
                unset($field['docfile_id']);
                unset($field['user_docfile_recipients_id']);
                unset($field['unique_key']);

                $field['docfile_id'] = $record->id;
                $field['user_docfile_recipients_id'] = $recipientId;
                $field['unique_key'] = uniqid();
                return $field;
            }, $recipientFields);

            $this->db->insert_batch('user_docfile_fields', $fields);
        }

        header('content-type: application/json');
        echo json_encode(['data' => $record]);
    }

    public function apiComplete()
    {
        header('content-type: application/json');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false]);
            return;
        }

        $payload = json_decode(file_get_contents('php://input'), true);
        $decrypted = decrypt($payload['hash'], $this->password);
        $decrypted = json_decode($decrypted, true);
        ['recipient_id' => $recipientId, 'document_id' => $documentId] = $decrypted;

        $this->db->where('id', $recipientId);
        $this->db->update('user_docfile_recipients', ['completed_at' => date('Y-m-d H:i:s')]);

        $this->db->where('docfile_id', $documentId);
        $this->db->where('completed_at is NULL', null, false);
        $totalPending = $this->db->count_all_results('user_docfile_recipients');

        if ($totalPending === 0) {
            $this->db->where('id', $documentId);
            $this->db->update('user_docfile', ['status' => 'Completed']);
        }

        $this->db->where('id', $recipientId);
        $record = $this->db->get('user_docfile_recipients')->row();

        $this->db->where('docfile_id', $documentId);
        $this->db->where('completed_at is NULL', null, false);
        $this->db->where('id !=', $recipientId);
        $this->db->order_by('id', 'asc');
        $this->db->limit(1);
        $recipients = $this->db->get('user_docfile_recipients')->result_array();

        $nextRecipient = null;
        foreach ($recipients as $recipient) {
            if ($recipient['id'] > $recipientId && $recipient['role'] !== 'Receives a copy') {
                $nextRecipient = $recipient;
                break;
            }
        }

        $this->db->where('id', $documentId);
        $envelope = $this->db->get('user_docfile')->row_array();

        if (!is_null($nextRecipient)) {
            if ($nextRecipient['role'] === 'Signs in Person') {
                $message = json_encode(['recipient_id' => $nextRecipient['id'], 'document_id' => $envelope['id']]);
                $hash = encrypt($message, $this->password);

                $this->db->where('id', $nextRecipient['id']);
                $this->db->update('user_docfile_recipients', ['sent_at' => date('Y-m-d H:i:s')]);

                echo json_encode(['hash' => $hash]);
                return;
            }

            if ($nextRecipient['role'] === 'Needs to Sign') {
                $this->sendEnvelope($envelope, $nextRecipient);
            }
        } else {
            // Document is completed.
            $this->db->where('docfile_id', $documentId);
            $this->db->order_by('id', 'asc');
            $allRecipients = $this->db->get('user_docfile_recipients')->result_array();
            $this->sendCompletedNotice($envelope, $allRecipients);
        }

        echo json_encode([
            'data' => $record,
            'next_recipient' => $nextRecipient,
            'has_user' => logged('id') !== false,
        ]);
    }

    private function sendCompletedNotice(array $envelope, array $recipients)
    {
        $mail = email__getInstance(['subject' => 'Your document has been completed']);
        $templatePath = VIEWPATH . 'esign/docusign/email/completed.html';
        $template = file_get_contents($templatePath);

        $attachmentName = preg_replace('/\s+/', '_', $envelope['subject']);
        $attachment = $this->generatePDF($envelope['id']);
        $mail->addStringAttachment($attachment, $attachmentName . '.pdf');

        $errors = [];
        foreach ($recipients as $recipient) {
            $message = json_encode([
                'recipient_id' => $recipient['id'],
                'document_id' => $envelope['id'],
                'is_self_signed' => false,
            ]);
            $hash = encrypt($message, $this->password);
            $companyLogo = $this->getCompanyProfile();

            $data = [
                '%link%' => $this->getSigningUrl() . '/signing?hash=' . $hash,
                '%company_logo%' => is_null($companyLogo) ? 'https://nsmartrac.com/uploads/users/business_profile/1/logo.jpg?1624851442' : $companyLogo,
            ];

            $message = strtr($template, $data);

            $mail->MsgHTML($message);
            $mail->addAddress($recipient['email']);
            $isSent = $mail->send();
            $mail->ClearAllRecipients();

            if (!$isSent) {
                $errors[$recipient['id']] = $mail->ErrorInfo;
            } else if ($recipient['role'] === 'Receives a copy') {
                $this->db->where('id', $recipient['id']);
                $this->db->update('user_docfile_recipients', ['completed_at' => date('Y-m-d H:i:s')]);
            }
        }

        $this->db->where('id', $envelope['id']);
        $this->db->update('user_docfile', ['status' => 'Completed']);
        return ['errors' => $errors];
    }

    public function apiUploadAttachment()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false]);
            return;
        }

        $file = $_FILES['attachment'];
        ['field_id' => $fieldId, 'recipient_id' => $recipientId] = $this->input->post();

        if ($file['size'] > self::ONE_MB * 8) {
            echo json_encode([
                'success' => false,
                'reason' => 'Maximum file size is less than 8MB',
            ]);
            return;
        }

        $filepath = FCPATH . 'uploads/docusign/';
        if (!file_exists($filepath)) {
            mkdir($filepath, 0777, true);
        }

        $tempName = $file['tmp_name'];
        $filename = $file['name'];
        $filename = time() . "_" . rand(1, 9999999) . "_" . basename($filename);

        $isCreated = false;
        $tableName = 'user_docfile_recipient_field_values';

        $this->db->where('field_id', $fieldId);
        $this->db->where('recipient_id', $recipientId);
        $record = $this->db->get($tableName)->row();

        $data = [
            'value' => $filename,
            'field_id' => $fieldId,
            'recipient_id' => $recipientId,
        ];

        if (!is_null($record) && file_exists($filepath . $record->value)) {
            unlink($filepath . $record->value);
        }

        move_uploaded_file($tempName, $filepath . $filename);

        if (is_null($record)) {
            $isCreated = true;
            $this->db->insert($tableName, $data);
        } else {
            $this->db->where('id', $record->id);
            $this->db->update($tableName, $data);
        }

        $id = $isCreated ? $this->db->insert_id() : $record->id;
        $this->db->where('id', $id);
        $record = $this->db->get($tableName)->row();

        header('content-type: application/json');
        echo json_encode(['data' => $record, 'is_created' => $isCreated]);
    }

    public function templateCreate()
    {
        $this->checkLogin();

        add_css([
            'assets/css/esign/esign-builder/esign-builder.css',
            'assets/css/esign/docusign/template-create/template-create.css',
        ]);

        add_footer_js([
            'https://code.jquery.com/ui/1.12.1/jquery-ui.js',

            'assets/js/esign/libs/pdf.js',
            'assets/js/esign/libs/pdf.worker.js',
            'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js',
            'assets/js/esign/docusign/template-create.js',
        ]);

        $this->load->view('esign/docusign/template-create/index', $this->page_data);
    }

    public function apiStoreTemplate()
    {
        header('content-type: application/json');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false]);
            return;
        }

        $files = $_FILES['files'];
        $count = count($files['name']);

        for ($i = 0; $i < $count; $i++) {
            if ($files['size'][$i] <= self::ONE_MB * 20) {
                continue;
            }

            echo json_encode(['success' => false, 'reason' => 'Maximum file size is less than 8MB']);
            return;
        }

        $filepath = FCPATH . 'uploads/docusigntemplates/';
        if (!file_exists($filepath)) {
            mkdir($filepath, 0777, true);
        }

        [
            'name' => $name,
            'description' => $description,
            'subject' => $subject,
            'message' => $message,
            'recipients' => $recipients,
        ] = $this->input->post();

        $id = (int) $this->input->post('id');
        $recipients = json_decode($recipients, true);

        $payload = [
            'name' => $name,
            'description' => $description,
            'subject' => $subject,
            'message' => $message,
            'user_id' => logged('id'),
            'company_id' => logged('company_id'),
        ];

        $isCreated = false;
        if (!$id) { // not created yet
            $this->db->insert('user_docfile_templates', $payload);
            $id = $this->db->insert_id();

            $this->db->where('id', $id);
            $record = $this->db->get('user_docfile_templates')->row();
            $isCreated = true;
        } else {
            $this->db->where('id', $id);
            $this->db->update('user_docfile_templates', $payload);
        }

        $this->db->where('template_id', $id);
        $documents = $this->db->get('user_docfile_templates_documents')->result_array();

        foreach ($documents as $document) {
            if (in_array($document['name'], $files['name'])) {
                continue;
            }

            $this->db->where('id', $document['id']);
            $this->db->delete('user_docfile_templates_documents');
            unlink($filepath . $document['name']);

            $this->db->where('docfile_document_id', $document['id']);
            $this->db->delete('user_docfile_templates_fields');
        }

        for ($i = 0; $i < $count; $i++) {
            $tempName = $files['tmp_name'][$i];
            $filename = $files['name'][$i];

            $this->db->where('name', $filename);
            $document = $this->db->get('user_docfile_templates_documents')->row_array();

            if ($document) {
                continue;
            }

            $filename = time() . "_" . rand(1, 9999999) . "_" . basename($filename);
            $payload = [
                'name' => $filename,
                'path' => str_replace(FCPATH, '/', $filepath . $filename),
                'template_id' => $id,
            ];

            $this->db->insert('user_docfile_templates_documents', $payload);
            move_uploaded_file($tempName, $filepath . $filename);
        }

        $this->db->where('template_id', $id);
        $currRecipients = $this->db->get('user_docfile_templates_recipients')->result_array();
        $newRecipientIds = array_column($recipients, 'id');

        foreach ($currRecipients as $recipient) {
            if (!in_array($recipient['id'], $newRecipientIds)) {
                $this->db->where('id', $recipient['id']);
                $this->db->delete('user_docfile_templates_recipients');

                $this->db->where('recipients_id', $recipient['id']);
                $this->db->delete('user_docfile_templates_fields');
            }
        }

        if (!empty($recipients)) {
            foreach ($recipients as $recipient) {
                $payload = [
                    'user_id' => logged('id'),
                    'template_id' => $id,
                    'name' => $recipient['name'],
                    'email' => $recipient['email'],
                    'role' => $recipient['role'],
                    'color' => $recipient['color'],
                    'role_name' => $recipient['role_name'],
                ];

                if (strpos($recipient['id'], 'temp') === 0) {
                    $this->db->insert('user_docfile_templates_recipients', $payload);
                } else {
                    $this->db->where('id', $recipient['id']);
                    $this->db->update('user_docfile_templates_recipients', $payload);
                }
            }
        }

        $this->db->where('template_id', $id);
        $record = $this->db->get('user_docfile_templates_document_sequence')->row();

        ['document_sequence' => $sequence] = $this->input->post();
        ['sequence' => $sequence] = json_decode($sequence, true);

        $this->db->where('template_id', $id);
        $documents = $this->db->get('user_docfile_templates_documents')->result_array();

        $sequenceIds = [];
        foreach ($sequence as $documentName) {
            foreach ($documents as $document) {
                if (strpos($document['name'], $documentName) !== false) {
                    $sequenceIds[] = $document['id'];
                    break;
                }
            }
        }

        $payload = ['template_id' => $id, 'sequence' => implode(',', $sequenceIds)];
        if (!$record) {
            $this->db->insert('user_docfile_templates_document_sequence', $payload);
        } else {
            $this->db->where('template_id', $id);
            $this->db->update('user_docfile_templates_document_sequence', $payload);
        }

        $this->db->where('id', $id);
        $record = $this->db->get('user_docfile_templates')->row();
        echo json_encode(['data' => $record, 'is_created' => $isCreated, 's' => $sequenceIds]);
    }

    public function apiTemplates()
    {
        $sharedOnly = filter_var($this->input->get('shared'), FILTER_VALIDATE_BOOLEAN);
        $sharedAndOwned = filter_var($this->input->get('all'), FILTER_VALIDATE_BOOLEAN);

        $getOwned = function () {
            $this->db->where('company_id', logged('company_id'));
            $this->db->where('user_id', logged('id'));
            $this->db->order_by('created_at', 'DESC');
            return $this->db->get('user_docfile_templates')->result();
        };

        $getShared = function () {
            $this->db->where('user_id', logged('id'));
            $sharedTemplates = $this->db->get('user_docfile_templates_shared')->result_array();

            if (empty($sharedTemplates)) {
                return [];
            }

            $sharedTemplateIds = array_map(function ($template) {
                return $template['template_id'];
            }, $sharedTemplates);

            $this->db->where_in('id', $sharedTemplateIds);
            $this->db->order_by('created_at', 'DESC');
            $results = $this->db->get('user_docfile_templates')->result();

            $usersMap = []; // user_id => user_object
            foreach ($results as $result) {
                if (!array_key_exists($result->user_id, $usersMap)) {
                    $this->db->where('id', $result->user_id);
                    $usersMap[$result->user_id] = $this->db->get('users')->row();
                }

                $result->user = $usersMap[$result->user_id];
                $result->is_shared = true;
            }

            return $results;
        };

        $records = [];
        if ($sharedAndOwned) {
            $records = array_merge($getOwned(), $getShared());
        } else {
            $records = $sharedOnly ? $getShared() : $getOwned();
        }

        foreach ($records as $record) {
            $this->db->where_in('template_id', $record->id);
            $record->thumbnail = $this->db->get('user_docfile_templates_thumbnail')->row();
        }

        $companyId = logged('company_id');
        $this->db->where('company_id', $companyId);
        $default = $this->db->get('user_docfile_template_defaults')->row();

        if ($default) {
            foreach ($records as $record) {
                $record->is_default = $default->template_id == $record->id;
            }
        }

        header('content-type: application/json');
        echo json_encode(['data' => $records]);
    }

    public function apiTemplatesFromParams()
    {
        $sharedOnly = filter_var($this->input->get('shared'), FILTER_VALIDATE_BOOLEAN);
        $sharedAndOwned = filter_var($this->input->get('all'), FILTER_VALIDATE_BOOLEAN);

        $companyId = filter_var($this->input->get('company_id'));
        $userId = filter_var($this->input->get('user_id'));

        $getOwned = function () use ($userId, $companyId) {
            $this->db->where('company_id', $companyId);
            $this->db->where('user_id', $userId);
            $this->db->order_by('created_at', 'DESC');
            return $this->db->get('user_docfile_templates')->result();
        };

        $getShared = function () use ($userId) {
            $this->db->where('user_id', $userId);
            $sharedTemplates = $this->db->get('user_docfile_templates_shared')->result_array();

            if (empty($sharedTemplates)) {
                return [];
            }

            $sharedTemplateIds = array_map(function ($template) {
                return $template['template_id'];
            }, $sharedTemplates);

            $this->db->where_in('id', $sharedTemplateIds);
            $this->db->order_by('created_at', 'DESC');
            $results = $this->db->get('user_docfile_templates')->result();

            $usersMap = []; // user_id => user_object
            foreach ($results as $result) {
                if (!array_key_exists($result->user_id, $usersMap)) {
                    $this->db->where('id', $result->user_id);
                    $usersMap[$result->user_id] = $this->db->get('users')->row();
                }

                $result->user = $usersMap[$result->user_id];
                $result->is_shared = true;
            }

            return $results;
        };

        $records = [];
        if ($sharedAndOwned) {
            $records = array_merge($getOwned(), $getShared());
        } else {
            $records = $sharedOnly ? $getShared() : $getOwned();
        }

        foreach ($records as $record) {
            $this->db->where_in('template_id', $record->id);
            $record->thumbnail = $this->db->get('user_docfile_templates_thumbnail')->row();
        }

        $this->db->where('company_id', $companyId);
        $default = $this->db->get('user_docfile_template_defaults')->row();

        if ($default) {
            foreach ($records as $record) {
                $record->is_default = $default->template_id == $record->id;
            }
        }

        header('content-type: application/json');
        echo json_encode(['data' => $records]);
    }

    public function apiGetDefaultTemplate()
    {
        $companyId = logged('company_id');
        $this->db->where('company_id', $companyId);
        $default = $this->db->get('user_docfile_template_defaults')->row();

        header('content-type: application/json');
        echo json_encode(['data' => $default]);
    }

    public function apiSetDefault()
    {
        header('content-type: application/json');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false]);
            return;
        }

        $payload = json_decode(file_get_contents('php://input'), true);
        $userId = logged('id');
        $companyId = logged('company_id');

        $this->db->where('company_id', $companyId);
        $this->db->delete('user_docfile_template_defaults');

        $this->db->insert('user_docfile_template_defaults', [
            'user_id' => $userId,
            'company_id' => $companyId,
            'template_id' => $payload['template_id'],
        ]);

        $this->db->where('company_id', $companyId);
        $row = $this->db->get('user_docfile_template_defaults')->row();
        echo json_encode(['data' => $row]);
    }

    public function apiGetTemplateFields($templateId)
    {
        $query = <<<SQL
        SELECT `user_docfile_templates_fields`.*, `user_docfile_templates_recipients`.`color` FROM `user_docfile_templates_fields`
        LEFT JOIN `user_docfile_templates_recipients` ON `user_docfile_templates_recipients`.`id` = `user_docfile_templates_fields`.`recipients_id`
        WHERE `user_docfile_templates_fields`.`template_id` = ? AND `user_docfile_templates_fields`.`user_id` = ?
SQL;

        $records = $this->db->query($query, [$templateId, logged('id')])->result_array();
        header('content-type: application/json');
        echo json_encode(['fields' => $records]);
    }

    public function apiTemplateFile($templateId)
    {
        header('content-type: application/json');
        echo json_encode(['data' => $this->getSortedDocument($templateId)]);
    }

    private function getSortedDocument($templateId)
    {
        $this->db->where('template_id', $templateId);
        $this->db->order_by('id', 'ASC');
        $records = $this->db->get('user_docfile_templates_documents')->result();

        foreach ($records as $record) {
            $this->db->where('docfile_document_id', $record->id);
            $record->total_fields = $this->db->get('user_docfile_templates_fields')->num_rows();
        }

        $this->db->where('template_id', $templateId);
        $sequence = $this->db->get('user_docfile_templates_document_sequence')->row();
        $sorted = null;

        if ($sequence) {
            $sorted = [];
            $sequence = explode(',', $sequence->sequence);
            foreach ($sequence as $recordId) {
                foreach ($records as $record) {
                    if ($record->id == $recordId) {
                        $sorted[] = $record;
                        break;
                    }
                }
            }
        }

        return is_null($sorted) ? $records : $sorted;
    }

    public function apiTemplate($templateId)
    {
        $this->db->where('id', $templateId);
        $records = $this->db->get('user_docfile_templates')->row();

        header('content-type: application/json');
        echo json_encode(['data' => $records]);
    }

    public function apiTemplateRecipients($templateId)
    {
        $this->db->where('template_id', $templateId);
        $records = $this->db->get('user_docfile_templates_recipients')->result();

        foreach ($records as $record) {
            $this->db->where('recipients_id', $record->id);
            $record->total_fields = $this->db->get('user_docfile_templates_fields')->num_rows();
        }

        header('content-type: application/json');
        echo json_encode(['data' => $records]);
    }

    public function apiCreateTemplateFields()
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
        $field = $payload['field'];
        $recipientId = $payload['recipient_id'];
        $userId = logged('id');
        $docfileDocumentId = $payload['docfile_document_id'];
        $templateId = $payload['template_id'];
        $uniqueKey = $payload['unique_key'];

        $this->db->where('template_id', $templateId);
        $this->db->where('user_id', $userId);
        $this->db->where('unique_key', $uniqueKey);
        $record = $this->db->get('user_docfile_templates_fields')->row();
        $isCreated = false;

        if (is_null($record)) {
            $isCreated = true;
            $this->db->insert('user_docfile_templates_fields', [
                'coordinates' => $coordinates,
                'doc_page' => $docPage,
                'docfile_document_id' => $docfileDocumentId,
                'template_id' => $templateId,
                'field_name' => $field,
                'unique_key' => $uniqueKey,
                'user_id' => $userId,
                'recipients_id' => $recipientId,
                'specs' => $specs,
            ]);
        } else {
            $this->db->where('id', $record->id);
            $this->db->update('user_docfile_templates_fields', [
                'coordinates' => $coordinates,
                'doc_page' => $docPage,
                'docfile_document_id' => $docfileDocumentId,
                'template_id' => $templateId,
                'field_name' => $field,
                'unique_key' => $uniqueKey,
                'user_id' => $userId,
                'specs' => is_null($specs) ? $record->specs : $specs,
            ]);
        }

        $query = <<<SQL
        SELECT `user_docfile_templates_fields`.*, `user_docfile_templates_recipients`.`color` FROM `user_docfile_templates_fields`
        LEFT JOIN `user_docfile_templates_recipients` ON `user_docfile_templates_recipients`.`id` = `user_docfile_templates_fields`.`recipients_id`
        WHERE `user_docfile_templates_fields`.`id` = ?
SQL;

        $recordId = $isCreated ? $this->db->insert_id() : $record->id;
        $record = $this->db->query($query, [$recordId])->row();
        echo json_encode(['record' => $record, 'is_created' => $isCreated]);
    }

    public function apiDeleteTemplateField($uniqueKey)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
            echo json_encode(['success' => false]);
            return;
        }

        $this->db->where('user_id', logged('id'));
        $this->db->where('unique_key', $uniqueKey);
        $this->db->delete('user_docfile_templates_fields');

        header('content-type: application/json');
        echo json_encode(['success' => true]);
    }

    public function templatePrepare()
    {
        return $this->templateCreate();
    }

    public function templateEdit()
    {
        return $this->templateCreate();
    }


    public function sendTemplate($templateId, $userId, $companyId)
    {
        header('content-type: application/json');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false]);
            return;
        }

        $filepath = FCPATH . 'uploads/docusign/';
        if (!file_exists($filepath)) {
            mkdir($filepath, 0777, true);
        }

        $payload = json_decode(file_get_contents('php://input'), true);
        $message = $payload['message'];
        $subject = $payload['subject'];
        $recipients = $payload['recipients'];
        $workorderId = $payload['workorder_id'] ?? null;
        $jobId = $payload['job_id'] ?? null;

        // copy template to user_docfile

        $this->db->where('id', $templateId);
        $template = $this->db->get('user_docfile_templates')->row();

        $this->db->insert('user_docfile', [
            'user_id' => $userId,
            'name' => $template->name,
            'type' => count($recipients) > 1 ? 'Multiple' : 'Single',
            'status' => 'Draft',
            'subject' => $subject,
            'message' => $message,
            'company_id' => $companyId,
        ]);
        $docfileId = $this->db->insert_id();

        // copy template document to user_docfile_documents

        $this->db->where('template_id', $template->id);
        $this->db->order_by('id', 'ASC');
        $templateFiles = $this->db->get('user_docfile_templates_documents')->result();

        foreach ($templateFiles as $file) {
            $documentPath = $filepath . $file->name;
            copy(FCPATH . $file->path, $documentPath);
            $this->db->insert('user_docfile_documents', [
                'name' => $file->name,
                'path' => str_replace(FCPATH, '/', $documentPath),
                'docfile_id' => $docfileId,
                'template_id' => $file->id,
            ]);
        }

        $this->db->where('id', $docfileId);
        $document = $this->db->get('user_docfile')->row();

        // copy template recipients to user_docfile_recipients and
        // template recipient fields to user_docfile_fields

        $this->db->where('template_id', $template->id);
        $templateRecipients = $this->db->get('user_docfile_templates_recipients')->result_array();

        $idToDocumentMap = [];
        foreach ($recipients as $recipient) {
            $payload = [
                'user_id' => $userId,
                'docfile_id' => $docfileId,
                'name' => $recipient['name'],
                'email' => $recipient['email'],
                'role' => $recipient['role'],
                'color' => $recipient['color'],
            ];

            if (strpos($recipient['id'], 'temp') === 0) {
                $this->db->insert('user_docfile_recipients', $payload);
                continue;
            }

            $matchedRecipient = null;
            foreach ($templateRecipients as $templateRecipient) {
                if ($templateRecipient['id'] == $recipient['id']) {
                    $matchedRecipient = $templateRecipient;
                    break;
                }
            }

            if (is_null($matchedRecipient)) {
                continue;
            }

            $this->db->insert('user_docfile_recipients', $payload);
            $recipientId = $this->db->insert_id();

            $this->db->where('recipients_id', $matchedRecipient['id']);
            $this->db->where('user_id', $matchedRecipient['user_id']);
            $this->db->where('template_id', $matchedRecipient['template_id']);
            $recipientFields = $this->db->get('user_docfile_templates_fields')->result_array();

            $createdRecipientsFields = [];
            foreach ($recipientFields as $field) {
                if (!array_key_exists($field['docfile_document_id'], $idToDocumentMap)) {
                    $this->db->where('docfile_id', $docfileId);
                    $this->db->where('template_id', $field['docfile_document_id']);
                    $idToDocumentMap[$field['docfile_document_id']] = $this->db->get('user_docfile_documents')->row(); // the file where the field belongs
                }

                array_push($createdRecipientsFields, [
                    'coordinates' => $field['coordinates'],
                    'docfile_id' => $docfileId,
                    'field_name' => $field['field_name'],
                    'doc_page' => $field['doc_page'],
                    'docfile_document_id' => $idToDocumentMap[$field['docfile_document_id']]->id,
                    'unique_key ' => uniqid(),
                    'user_id' => $userId,
                    'user_docfile_recipients_id' => $recipientId,
                    'specs' => $field['specs'],
                ]);
            }

            $groupedFields = array_chunk($createdRecipientsFields, 50);
            foreach ($groupedFields as $group) {
                $this->db->insert_batch('user_docfile_fields', $group);
            }

            if (!is_null($workorderId)) {
                $this->db->insert('user_docfile_workorder_recipients', [
                    'user_docfile_recipient_id' => $recipientId,
                    'workorder_id' => $workorderId,
                ]);
            }

            if (!is_null($jobId)) {
                $this->db->insert('user_docfile_job_recipients', [
                    'user_docfile_recipient_id' => $recipientId,
                    'job_id' => $jobId,
                ]);
            }
        }

        // copy sequence
        $this->db->where('template_id', $template->id);
        $sequence = $this->db->get('user_docfile_templates_document_sequence')->row();

        if ($sequence) {
            $this->db->where('docfile_id', $docfileId);
            $documents = $this->db->get('user_docfile_documents')->result();

            $sequence = explode(',', $sequence->sequence);
            $sequenceIds = [];

            foreach ($sequence as $recordId) {
                foreach ($documents as $document) {
                    if ($document->template_id == $recordId) {
                        $sequenceIds[] = $document->id;
                        break;
                    }
                }
            }

            $payload = ['docfile_id' => $docfileId, 'sequence' => implode(',', $sequenceIds)];
            $this->db->insert('user_docfile_document_sequence', $payload);
        }

        $this->db->where('id', $docfileId);
        $envelope = $this->db->get('user_docfile')->row_array();

        $this->db->where('docfile_id', $docfileId);
        $this->db->where('completed_at is NULL', null, false);
        $this->db->order_by('id', 'asc');
        $this->db->limit(1);
        $recipient = $this->db->get('user_docfile_recipients')->row_array();

        $response = json_encode(['data' => $envelope]);
        if ($recipient['role'] === 'Needs to Sign') {
            ['error' => $error] = $this->sendEnvelope($envelope, $recipient);
            $response = json_encode(['success' => is_null($error), 'error' => $error]);
        } else if ($recipient['role'] === 'Signs in Person') {
            $message = json_encode(['recipient_id' => $recipient['id'], 'document_id' => $envelope['id']]);
            $hash = encrypt($message, $this->password);
            $response = json_encode(['hash' => $hash]);

            $this->db->where('id', $recipient['id']);
            $this->db->update('user_docfile_recipients', ['sent_at' => date('Y-m-d H:i:s')]);
        }

        $this->db->where('id', $envelope['id']);
        $this->db->update('user_docfile', ['status' => 'Waiting for Others']);
        echo $response;
    }

    public function apiSendCompleteNotice($documentId)
    {
        $this->db->where('id', $documentId);
        $document = $this->db->get('user_docfile')->row();

        if (!$document) {
            set_status_header(404);
            exit(json_encode(['error' => 'Document not found']));
        }

        $this->db->where('docfile_id', $documentId);
        $this->db->where('completed_at is NULL', null, false);
        $this->db->where('role !=', 'Receives a copy');
        $this->db->order_by('id', 'asc');
        $this->db->limit(1);
        $pendingRecipient = $this->db->get('user_docfile_recipients')->row();

        if ($pendingRecipient) {
            header('content-type: application/json');
            exit(json_encode(['next_recipient' => $pendingRecipient, 'is_sent' => false]));
        }

        $this->db->where('id', $documentId);
        $this->db->update('user_docfile', ['status' => 'Completed']);

        $this->db->where('docfile_id', $documentId);
        $this->db->order_by('id', 'asc');
        $allRecipients = $this->db->get('user_docfile_recipients')->result_array();

        $this->db->where('id', $documentId);
        $envelope = $this->db->get('user_docfile')->row_array();

        $envelope['subject'] = 'Your document has been completed';
        $this->sendCompletedNotice($envelope, $allRecipients);

        header('content-type: application/json');
        exit(json_encode(['next_recipient' => null, 'is_sent' => true]));
    }

    public function apiSendTemplatePublic($templateId)
    {
        $userId = (int) $this->input->get('user_id', true);
        $companyId = (int) $this->input->get('company_id', true);
        $this->sendTemplate($templateId, $userId, $companyId);
    }

    public function apiSendTemplate($templateId)
    {
        $this->sendTemplate($templateId, logged('id'), logged('company_id'));
    }

    private function getSigningUrl()
    {
        $baseUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . "://$_SERVER[HTTP_HOST]";

        if (isLocalhost()) {
            $baseUrl .= '/';
        }

        return $baseUrl . '/eSign';
    }

    private function sendEnvelope(array $envelope, array $recipient, bool $isSelfSigned = false)
    {
        $mail = email__getInstance(['subject' => $envelope['subject']]);
        $templatePath = VIEWPATH . 'esign/docusign/email/invitation.html';
        $template = file_get_contents($templatePath);

        $this->db->where('id', logged('id'));
        $inviter = $this->db->get('users')->row();
        $inviterName = implode(' ', [$inviter->FName, $inviter->LName]);

        $message = json_encode([
            'recipient_id' => $recipient['id'],
            'document_id' => $envelope['id'],
            'is_self_signed' => $isSelfSigned,
        ]);
        $hash = encrypt($message, $this->password);
        $companyLogo = $this->getCompanyProfile();

        $data = [
            '%link%' => $this->getSigningUrl() . '/signing?hash=' . $hash,
            '%inviter%' => $inviterName,
            '%message%' => nl2br(htmlentities($envelope['message'], ENT_QUOTES, 'UTF-8')),
            '%inviter_email%' => $inviter->email,
            '%company_logo%' => is_null($companyLogo) ? 'https://nsmartrac.com/uploads/users/business_profile/1/logo.jpg?1624851442' : $companyLogo,
        ];

        $message = strtr($template, $data);

        $mail->MsgHTML($message);
        $mail->addAddress($recipient['email']);
        $isSent = $mail->send();
        $mail->ClearAllRecipients();

        $error = null;
        if (!$isSent) {
            $error = $mail->ErrorInfo;
        } else {
            $this->db->where('id', $recipient['id']);
            $this->db->update('user_docfile_recipients', ['sent_at' => date('Y-m-d H:i:s')]);
        }

        return ['error' => $error];
    }

    public function getCustomer($customerId)
    {
        $this->db->where('company_id', logged('company_id'));
        $this->db->where('prof_id', $customerId);
        $row = $this->db->get('acs_profile')->row();

        header('content-type: application/json');
        echo json_encode(['data' => $row]);
    }

    public function getWorkorderCustomer($workorderId)
    {
        header('content-type: application/json');
        echo json_encode(['data' => $this->_getWorkorderCustomer($workorderId)]);
    }

    private function _getWorkorderCustomer($workorderId)
    {
        $query = <<<SQL
        SELECT * FROM `work_orders`
        LEFT JOIN acs_profile ON work_orders.customer_id = acs_profile.prof_id WHERE work_orders.id = ?
SQL;

        return $this->db->query($query, [$workorderId])->row();
    }

    public function getJobCustomer($jobId)
    {
        $job = $this->_getJobCustomer($jobId);
        $job->employee = $this->getJobEmployee($job);
        $job->admin = $this->getCompanyAdmin();

        header('content-type: application/json');
        echo json_encode(['data' => $job]);
    }

    private function _getJobCustomer($jobId)
    {
        $query = <<<SQL
        SELECT * FROM `jobs`
        LEFT JOIN acs_profile ON jobs.customer_id = acs_profile.prof_id WHERE jobs.id = ?
SQL;

        return $this->db->query($query, [$jobId])->row();
    }

    private function getJobEmployee($job)
    {
        $employee = null;
        $employeeIdKeys = [
            'employee_id',
            'employee2_id',
            'employee3_id',
            'employee4_id',
        ];

        foreach ($employeeIdKeys as $key) {
            if (!is_null($employee)) {
                break;
            }

            if (is_null($job->$key) || $job->$key === 0) {
                continue;
            }

            $this->db->where('id', $job->$key);
            $employee = $this->db->get('users')->row();
        }

        return $employee;
    }

    private function getCompanyAdmin()
    {
        $this->db->where('company_id', logged('company_id'));
        $this->db->where('user_type', 7); // 7 is for admins
        return $this->db->get('users')->row();
    }

    public function apiCopyTemplate($templateId)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false]);
            return;
        }

        $filepath = FCPATH . 'uploads/docusigntemplates/';
        if (!file_exists($filepath)) {
            mkdir($filepath, 0777, true);
        }

        $this->db->where('id', $templateId);
        $baseTemplate = $this->db->get('user_docfile_templates')->row_array();
        unset($baseTemplate['id']);
        unset($baseTemplate['created_at']);
        $baseTemplate['name'] = $baseTemplate['name'] . ' - Copy';

        // copy template
        $this->db->insert('user_docfile_templates', $baseTemplate);

        // get new template
        $this->db->where('id', $this->db->insert_id());
        $newTemplate = $this->db->get('user_docfile_templates')->row();

        // get base template files
        $baseTemplateFiles = $this->getSortedDocument($templateId);
        $sequenceIds = [];
        $storedRecipientIds = [];
        foreach ($baseTemplateFiles as $baseFile) {

            // copy template file
            $documentPath = $filepath . $baseFile->name;
            $this->db->insert('user_docfile_templates_documents', [
                'name' => $baseFile->name,
                'path' => str_replace(FCPATH, '/', $documentPath),
                'template_id' => $newTemplate->id,
            ]);

            $newTemplateDocumentFileId = $this->db->insert_id();
            array_push($sequenceIds, $newTemplateDocumentFileId);

            $this->db->where('template_id', $templateId);
            $this->db->where('docfile_document_id', $baseFile->id);
            $recipientFields = $this->db->get('user_docfile_templates_fields')->result_array();

            // group fields with recipient id as key
            $groupedFields = [];
            foreach ($recipientFields as $field) {
                $groupedFields[$field['recipients_id']][] = $field;
            }

            foreach ($groupedFields as $recipientId => $fields) {
                if (!array_key_exists($recipientId, $storedRecipientIds)) {
                    // copy recipient
                    $this->db->where('id', $recipientId);
                    $baseTemplateRecipient = $this->db->get('user_docfile_templates_recipients')->row_array();
                    unset($baseTemplateRecipient['id']);
                    unset($baseTemplateRecipient['template_id']);

                    $baseTemplateRecipient['template_id'] = $newTemplate->id;
                    $this->db->insert('user_docfile_templates_recipients', $baseTemplateRecipient);
                    $storedRecipientIds[$recipientId] = $this->db->insert_id();
                }

                $newRecipientId = $storedRecipientIds[$recipientId];

                // copy recipient fields
                $newFields = array_map(function ($field) use ($newTemplate, $newRecipientId, $newTemplateDocumentFileId) {
                    unset($field['id']);
                    unset($field['template_id']);
                    unset($field['recipients_id']);
                    unset($field['unique_key']);
                    unset($field['docfile_document_id']);

                    $field['template_id'] = $newTemplate->id;
                    $field['recipients_id'] = $newRecipientId;
                    $field['unique_key'] = uniqid();
                    $field['docfile_document_id'] = $newTemplateDocumentFileId;
                    return $field;
                }, $fields);

                $this->db->insert_batch('user_docfile_templates_fields', $newFields);
            }
        }

        $payload = ['template_id' => $newTemplate->id, 'sequence' => implode(',', $sequenceIds)];
        $this->db->insert('user_docfile_templates_document_sequence', $payload);

        header('content-type: application/json');
        echo json_encode(['data' => $newTemplate]);
    }

    public function apiGetUsers($templateId)
    {
        $query = <<<SQL
        SELECT * FROM `users` WHERE company_id = ? AND id != ?
SQL;

        $users = $this->db->query($query, [logged('company_id'), logged('id')])->result_array();

        $this->db->where('template_id', $templateId);
        $sharedUsers = $this->db->get('user_docfile_templates_shared')->result_array();
        $sharedUserIds = array_column($sharedUsers, 'user_id');

        $users = array_map(function ($user) use ($sharedUserIds) {
            $user['is_selected'] = in_array($user['id'], $sharedUserIds);
            return $user;
        }, $users);

        header('content-type: application/json');
        echo json_encode(['data' => $users]);
    }

    public function apiShareTemplate()
    {
        header('content-type: application/json');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['data' => null]);
            return;
        }

        $payload = json_decode(file_get_contents('php://input'), true);
        $userIds = $payload['user_ids'] ?? [];
        $templateId = $payload['template_id'];

        $this->db->where('template_id', $templateId);
        $sharedUsers = $this->db->get('user_docfile_templates_shared')->result_array();

        if (!empty($sharedUsers)) {
            $this->db->where('template_id', $templateId);
            $this->db->delete('user_docfile_templates_shared');
        }

        if (empty($userIds)) {
            echo json_encode(['data' => null]);
            return;
        }

        $fields = array_map(function ($id) use ($templateId) {
            return ['user_id' => $id, 'template_id' => $templateId];
        }, $userIds);

        $this->db->insert_batch('user_docfile_templates_shared', $fields);
        echo json_encode(['data' => $fields]);
    }

    public function apiDeleteTemplate($templateId)
    {
        $this->db->where('id', $templateId);
        $this->db->delete('user_docfile_templates');

        $this->db->where('template_id', $templateId);
        $documents = $this->db->get('user_docfile_templates_documents')->result_array();

        foreach ($documents as $document) {
            $this->db->where('id !=', $document['id']);
            $this->db->where('name', $document['name']);
            $result = $this->db->get('user_docfile_templates_documents')->row();

            if (!$result) { // used on another template
                // TODO: delete if not used.
                // unlink(FCPATH . 'uploads/docusigntemplates/' . $document['name']);
            }
        }

        $this->db->where('template_id', $templateId);
        $this->db->delete('user_docfile_templates_documents');

        $this->db->where('template_id', $templateId);
        $this->db->delete('user_docfile_templates_fields');

        $this->db->where('template_id', $templateId);
        $this->db->delete('user_docfile_templates_recipients');

        $this->db->where('template_id', $templateId);
        $this->db->delete('user_docfile_templates_shared');

        $this->db->where('template_id', $templateId);
        $this->db->delete('user_docfile_templates_document_sequence');

        $this->db->where('template_id', $templateId);
        $thumbnail = $this->db->get('user_docfile_templates_thumbnail')->row_array();

        if ($thumbnail) {
            unlink(FCPATH . 'uploads/docusigntemplatesthumbnail/' . $thumbnail['filename']);
        }

        $this->db->where('template_id', $templateId);
        $this->db->delete('user_docfile_templates_thumbnail');

        header('content-type: application/json');
        echo json_encode(['success' => true]);
    }

    public function apiSaveEnvelopeAsTemplate($envelopeId)
    {

        $filepath = FCPATH . 'uploads/docusigntemplates/';
        if (!file_exists($filepath)) {
            mkdir($filepath, 0777, true);
        }

        $this->db->where('id', $envelopeId);
        $envelope = $this->db->get('user_docfile')->row_array();

        $this->db->insert('user_docfile_templates', [
            'user_id' => logged('id'),
            'company_id' => logged('company_id'),
            'name' => $envelope['name'],
            'description' => '',
            'subject' => $envelope['subject'],
            'message' => $envelope['message'],
        ]);
        $templateId = $this->db->insert_id();

        $this->db->where('docfile_id', $envelopeId);
        $recipients = $this->db->get('user_docfile_recipients')->result_array();

        foreach ($recipients as $index => $recipient) {
            $index += 1;
            $this->db->insert('user_docfile_templates_recipients', [
                'user_id' => logged('id'),
                'template_id' => $templateId,
                'name' => $recipient['name'],
                'email' => $recipient['email'],
                'role' => $recipient['role'],
                'color' => $recipient['color'],
                'role_name' => 'Recipient ' . $index,
            ]);

            $recipientId = $this->db->insert_id();

            $this->db->where('user_docfile_recipients_id', $recipient['id']);
            $fields = $this->db->get('user_docfile_fields')->result_array();

            $documents = []; // document_id => document
            $templateDocuments = []; // document_name => document_id

            foreach ($fields as $field) {
                if (!array_key_exists($field['docfile_document_id'], $documents)) {
                    $this->db->where('id', $field['docfile_document_id']);
                    $documents[$field['docfile_document_id']] = $this->db->get('user_docfile_documents')->row_array();
                }

                $document = $documents[$field['docfile_document_id']];
                $documentPath = $filepath . $document['name'];

                if (!array_key_exists($document['name'], $templateDocuments)) {
                    copy(FCPATH . $document['path'], $documentPath);
                    $this->db->insert('user_docfile_templates_documents', [
                        'name' => $document['name'],
                        'path' => str_replace(FCPATH, '/', $filepath . $document['name']),
                        'template_id' => $templateId,
                    ]);

                    $templateDocuments[$document['name']] = $this->db->insert_id();
                }

                $docfileDocumentId = $templateDocuments[$document['name']];
                $this->db->insert('user_docfile_templates_fields', [
                    'coordinates' => $field['coordinates'],
                    'doc_page' => $field['doc_page'],
                    'docfile_document_id' => $docfileDocumentId,
                    'template_id' => $templateId,
                    'field_name' => $field['field_name'],
                    'unique_key' => uniqid(),
                    'user_id' => logged('id'),
                    'recipients_id' => $recipientId,
                    'specs' => $field['specs'],
                ]);
            }
        }

        $this->db->where('id', $templateId);
        $template = $this->db->get('user_docfile_templates')->row();

        header('content-type: application/json');
        echo json_encode(['data' => $template]);
    }

    public function apiUploadTemplateThumbnail()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false]);
            return;
        }

        $filepath = FCPATH . 'uploads/docusigntemplatesthumbnail/';
        if (!file_exists($filepath)) {
            mkdir($filepath, 0777, true);
        }

        $file = $_FILES['thumbnail'];
        ['template_id' => $templateId] = $this->input->post();

        if ($file['size'] > self::ONE_MB * 8) {
            echo json_encode([
                'success' => false,
                'reason' => 'Maximum file size is less than 8MB',
            ]);
            return;
        }

        $tempName = $file['tmp_name'];
        $filename = $file['name'];
        $filename = time() . "_" . rand(1, 9999999) . "_" . basename($filename);

        $isCreated = false;
        $tableName = 'user_docfile_templates_thumbnail';

        $this->db->where('template_id', $templateId);
        $record = $this->db->get($tableName)->row();

        if (!is_null($record) && file_exists($filepath . $record->filename)) {
            unlink($filepath . $record->filename);
        }

        move_uploaded_file($tempName, $filepath . $filename);

        $data = [
            'template_id' => $templateId,
            'filename' => $filename,
            'filepath' => str_replace(FCPATH, '/', $filepath . $filename),
        ];

        if (is_null($record)) {
            $isCreated = true;
            $this->db->insert($tableName, $data);
        } else {
            $this->db->where('id', $record->id);
            $this->db->update($tableName, $data);
        }

        $id = $isCreated ? $this->db->insert_id() : $record->id;
        $this->db->where('id', $id);
        $record = $this->db->get($tableName)->row();

        header('content-type: application/json');
        echo json_encode(['data' => $record, 'is_created' => $isCreated]);
    }

    public function apiUserDetails()
    {
        $userId = logged('id');
        $this->db->where('user_id', $userId);
        $signature = $this->db->get('user_signatures')->row();

        $this->db->where('id', $userId);
        $details = $this->db->get('users')->row();

        $this->db->where('id', $details->company_id);
        $company = $this->db->get('business_profile')->row();

        header('content-type: application/json');
        echo json_encode([
            'data' => [
                'signature' => $signature,
                'details' => $details,
                'company' => $company,
            ],
        ]);
    }

    public function apiSubmitSelfSigned($envelopeId)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false]);
            return;
        }

        $payload = json_decode(file_get_contents('php://input'), true);
        $payloadRecipients = $payload['recipients'] ?? [];
        $subject = $payload['subject'] ?? '';
        $message = $payload['message'] ?? '';

        foreach ($payloadRecipients as $recipient) {
            $this->db->insert('user_docfile_recipients', [
                'user_id' => logged('id'),
                'docfile_id' => $envelopeId,
                'name' => $recipient['name'],
                'email' => $recipient['email'],
                'role' => 'Receives a copy',
            ]);
        }

        $this->db->where('id', $envelopeId);
        $this->db->update('user_docfile', [
            'subject' => $subject,
            'message' => $message,
            'status' => 'Completed',
        ]);

        $this->db->where('id', $envelopeId);
        $envelope = $this->db->get('user_docfile')->row_array();

        $this->db->where('docfile_id', $envelopeId);
        $recipients = $this->db->get('user_docfile_recipients')->result_array();

        foreach ($recipients as $recipient) {
            $this->sendEnvelope($envelope, $recipient, true);
            $this->db->where('id', $recipient['id']);
            $this->db->update('user_docfile_recipients', ['completed_at' => date('Y-m-d H:i:s')]);
        }

        header('content-type: application/json');
        echo json_encode([
            'data' => [
                'status' => '👌',
                'envelope_id' => $envelopeId,
                'recipients' => $recipients,
            ],
        ]);
    }

    private function getCompanyProfile()
    {
        $this->db->where('company_id', logged('company_id'));
        $this->db->where('business_image is NOT NULL', null, false);
        $this->db->select('business_image, id');
        $companyProfile = $this->db->get('business_profile')->row();

        if ($companyProfile) {
            return urlUpload('users/business_profile/' . $companyProfile->id . '/' . $companyProfile->business_image . '?' . time());
        }

        return null;
    }

    public function apiGetActionRequired()
    {
        header('content-type: application/json');
        echo json_encode(['data' => $this->getActionRequired()]);
    }

    private function getActionRequired()
    {
        $this->db->where('id', logged('id'));
        $this->db->select(['email']);
        $user = $this->db->get('users')->row();
        $currUserEmail = $user->email;

        $query = <<<SQL
        SELECT `user_docfile_recipients`.`docfile_id` FROM `user_docfile_recipients`
        LEFT JOIN `user_docfile` ON `user_docfile`.`id` = `user_docfile_recipients`.`docfile_id`
        WHERE `user_docfile`.`user_id` = ? AND `user_docfile_recipients`.`email` = ? AND
        `user_docfile_recipients`.`sent_at` IS NOT NULL AND `user_docfile_recipients`.`completed_at` IS NULL
SQL;

        $results = $this->db->query($query, [logged('id'), $currUserEmail])->result();
        $docfileIds = array_map(function ($result) {
            return $result->docfile_id;
        }, $results);

        if (empty($docfileIds)) {
            return [];
        }

        $this->db->where_in('id', $docfileIds);
        $this->db->order_by('id', 'DESC');
        return $this->db->get('user_docfile')->result();
    }

    public function apiGetHash()
    {
        $recipientId = $this->input->get('recipient_id', true);
        $decrypted = $this->input->get('document_id', true);

        $message = json_encode(['recipient_id' => $recipientId, 'document_id' => $decrypted]);
        $hash = encrypt($message, $this->password);
        $url = rtrim($this->getSigningUrl(), '/') . '/signing?hash=' . $hash;

        header('content-type: application/json');
        echo json_encode([
            'data' => $url
        ]);
    }

    public function generatePDF($documentId)
    {

        $this->db->where('id', $documentId);
        $document = $this->db->get('user_docfile')->row();

        if (is_null($document)) {
            return;
        }

        if ($document->status !== 'Completed') {
            return;
        }

        $this->db->where('docfile_id', $document->id);
        $this->db->order_by('id', 'ASC');
        $files = $this->db->get('user_docfile_documents')->result();

        require_once(APPPATH . 'libraries/tcpdf/tcpdf.php');
        require_once(APPPATH . 'libraries/tcpdf/tcpdi.php');

        $this->db->where('docfile_id', $document->id);
        $fields = $this->db->get('user_docfile_fields')->result();

        $this->db->where('docfile_id', $document->id);
        $recipients = $this->db->get('user_docfile_recipients')->result();

        foreach ($fields as $field) {
            if (in_array($field->field_name, ['Email', 'Name'])) {
                $recipientMatch = null;

                foreach ($recipients as $recipient) {
                    if ($recipient->id === $field->user_docfile_recipients_id) {
                        $recipientMatch = $recipient;
                        break;
                    }
                }

                if (!is_null($recipientMatch)) {
                    $field->value = $recipientMatch;
                    continue;
                }
            }


            $this->db->where('recipient_id', $field->user_docfile_recipients_id);
            $this->db->where('field_id', $field->id);
            $field->value = $this->db->get('user_docfile_recipient_field_values')->row();
        }

        $pdf = new FPDI('P', 'px');

        foreach ($files as $file) {
            $filepath = FCPATH . ltrim($file->path, '/');
            $pageCount = $pdf->setSourceFile($filepath);

            for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
                $pageIndex = $pdf->importPage($pageNo);
                $pdf->AddPage();
                $pdf->useTemplate($pageIndex, null, null, 0, 0, true);


                foreach ($fields as $field) {
                    if ((int) $field->doc_page !== $pageIndex) {
                        continue;
                    }

                    if ($field->docfile_document_id !== $file->id) {
                        continue;
                    }

                    if (!$field->value) {
                        continue;
                    }

                    $value = $field->value;
                    $coordinates = json_decode($field->coordinates);

                    if ($field->field_name === 'Name') {
                        $top = (int) $coordinates->top;
                        $left = (int) $coordinates->left;

                        $topAdjusted = (29 / 100) * $top;
                        $topAdjusted = $top - $topAdjusted;

                        $leftAdjusted = (32.666666666666664 / 100) * $left;
                        $leftAdjusted = $left - $leftAdjusted;

                        $pdf->setY($topAdjusted);
                        $pdf->setX($leftAdjusted);

                        $pdf->SetFont('Courier', '', 10);
                        $pdf->Write(0, $value->name);
                    }

                    if ($field->field_name === 'Email') {
                        $top = (int) $coordinates->top;
                        $left = (int) $coordinates->left;

                        $topAdjusted = (31.6 / 100) * $top;
                        $topAdjusted = $top - $topAdjusted;

                        $leftAdjusted = (32.666666666666664 / 100) * $left;
                        $leftAdjusted = $left - $leftAdjusted;

                        $pdf->setY($topAdjusted);
                        $pdf->setX($leftAdjusted);

                        $pdf->SetFont('Courier', '', 10);
                        $pdf->Write(0, $value->email);
                    }

                    if (in_array($field->field_name, ['Checkbox', 'Radio'])) {
                        $value = json_decode($value->value);

                        $top = (int) $coordinates->top;
                        $left = (int) $coordinates->left;

                        $topAdjusted = (31.3 / 100) * $top;
                        $topAdjusted = $top - $topAdjusted;

                        $leftAdjusted = (31.5 / 100) * $left;
                        $leftAdjusted = $left - $leftAdjusted;

                        if (is_array($value->subCheckbox)) {
                            foreach ($value->subCheckbox as $subItem) {
                                if ($subItem->isChecked) {

                                    $myTopAdjusted = ((int) $subItem->top) + $topAdjusted;
                                    $myLeftAdjusted = ((int) $subItem->left) + $leftAdjusted;

                                    $pdf->setY($myTopAdjusted);
                                    $pdf->setX($myLeftAdjusted);

                                    $pdf->SetFont('Courier', '', 10);
                                    $pdf->Write(0, 'x');
                                }
                            }
                        }

                        if ($value->isChecked) {
                            $pdf->setY($topAdjusted);
                            $pdf->setX($leftAdjusted);

                            $pdf->SetFont('Courier', '', 10);
                            $pdf->Write(0, 'x');
                        }
                    }

                    if ($field->field_name === 'Signature') {
                        $dataURI = $value->value;
                        $dataPieces = explode(',', $dataURI);
                        $encodedImg = $dataPieces[1];
                        $decodedImg = base64_decode($encodedImg);

                        if ($decodedImg !== false) {
                            $temporaryPath = FCPATH . ltrim($field->unique_key, '/');

                            if (file_put_contents($temporaryPath, $decodedImg) !== false) {
                                $top = (int) $coordinates->top;
                                $left = (int) $coordinates->left;

                                $topAdjusted = (32.5 / 100) * $top;
                                $topAdjusted = $top - $topAdjusted;

                                $leftAdjusted = (38 / 100) * $left;
                                $leftAdjusted = $left - $leftAdjusted;

                                $pdf->setY($topAdjusted);
                                $pdf->setX($leftAdjusted);

                                $pdf->Image($temporaryPath, null, null, null, 30);
                                unlink($temporaryPath);
                            }
                        }
                    }

                    if ($field->field_name === 'Text') {
                        $top = (int) $coordinates->top;
                        $left = (int) $coordinates->left;

                        $topAdjusted = (31.5 / 100) * $top;
                        $topAdjusted = $top - $topAdjusted;

                        $leftAdjusted = (32 / 100) * $left;
                        $leftAdjusted = $left - $leftAdjusted;

                        $pdf->setY($topAdjusted);
                        $pdf->setX($leftAdjusted);

                        $pdf->SetFont('Courier', '', 10);
                        $pdf->Write(0, $value->value);
                    }

                    if ($field->field_name === 'Date Signed') {
                        $top = (int) $coordinates->top;
                        $left = (int) $coordinates->left;

                        $topAdjusted = (31.9 / 100) * $top;
                        $topAdjusted = $top - $topAdjusted;

                        $leftAdjusted = (32.3 / 100) * $left;
                        $leftAdjusted = $left - $leftAdjusted;

                        $pdf->setY($topAdjusted);
                        $pdf->setX($leftAdjusted);

                        $pdf->SetFont('Courier', '', 10);
                        $pdf->Write(0, $value->value);
                    }

                    if ($field->field_name === 'Formula') {
                        $top = (int) $coordinates->top;
                        $left = (int) $coordinates->left;

                        $topAdjusted = (31.9 / 100) * $top;
                        $topAdjusted = $top - $topAdjusted;

                        $leftAdjusted = (32.3 / 100) * $left;
                        $leftAdjusted = $left - $leftAdjusted;

                        $pdf->setY($topAdjusted);
                        $pdf->setX($leftAdjusted);

                        $pdf->SetFont('Courier', '', 10);
                        $pdf->Write(0, $value->value);
                    }
                }
            }
        }

        // echo '<pre>';
        // print_r($fields);
        // echo '</pre>';

        $result = $pdf->Output(null, 'S');
        return $result;
    }
}

// https://stackoverflow.com/a/50373095/8062659

function sign($message, $key)
{
    return hash_hmac('sha256', $message, $key) . $message;
}

function verify($bundle, $key)
{
    return hash_equals(
        hash_hmac('sha256', mb_substr($bundle, 64, null, '8bit'), $key),
        mb_substr($bundle, 0, 64, '8bit')
    );
}

function getKey($password, $keysize = 16)
{
    return hash_pbkdf2('sha256', $password, 'some_token', 100000, $keysize, true);
}

function encrypt($message, $password)
{
    $iv = random_bytes(16);
    $key = getKey($password);
    $result = sign(openssl_encrypt($message, 'aes-256-ctr', $key, OPENSSL_RAW_DATA, $iv), $key);
    return bin2hex($iv) . bin2hex($result);
}

function decrypt($hash, $password)
{
    $iv = hex2bin(substr($hash, 0, 32));
    $data = hex2bin(substr($hash, 32));
    $key = getKey($password);
    if (!verify($data, $key)) {
        return null;
    }
    return openssl_decrypt(mb_substr($data, 64, null, '8bit'), 'aes-256-ctr', $key, OPENSSL_RAW_DATA, $iv);
}

function getMailInstance($config = [])
{
    $config = array_replace([
        'isHTML' => true,
        'subject' => 'nSmarTrac: DocuSign',
    ], $config);

    $server = MAIL_SERVER;
    $port = MAIL_PORT;
    $username = MAIL_USERNAME;
    $password = MAIL_PASSWORD;
    $from = MAIL_FROM;
    $subject = $config['subject'];

    include APPPATH . 'libraries/PHPMailer/PHPMailerAutoload.php';
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->getSMTPInstance()->Timelimit = 5;
    $mail->Host = $server;
    $mail->SMTPAuth = true;
    $mail->Username = $username;
    $mail->Password = $password;
    $mail->SMTPSecure = 'ssl';
    $mail->Timeout = 10; // seconds
    $mail->Port = $port;
    $mail->From = $from;
    $mail->FromName = 'nSmarTrac';
    $mail->Subject = $subject;
    $mail->IsHTML($config['isHTML']);

    if (isLocalhost()) {
        // Send using gmail
        $mail->Host = 'tls://smtp.gmail.com:587';
        $mail->Username = null;
        $mail->Password = null;
        $mail->port = 587;
        $mail->SMTPOptions = [
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true,
            ],
        ];
    }

    return $mail;
}

function isLocalhost(): bool
{
    $whitelist = ['127.0.0.1', '::1'];
    return in_array($_SERVER['REMOTE_ADDR'], $whitelist);
}
