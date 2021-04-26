<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DocuSign extends MY_Controller
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

        $this->db->where('id', $recipientId);
        $this->db->where('docfile_id', $documentId);
        $recipient = $this->db->get('user_docfile_recipients')->row();

        $this->db->where('docfile_id', $documentId);
        $this->db->where('user_docfile_recipients_id', $recipientId);
        $fields = $this->db->get('user_docfile_fields')->result();

        foreach ($fields as $field) {
            $this->db->where('recipient_id', $field->user_docfile_recipients_id);
            $this->db->where('field_id', $field->id);
            $field->value = $this->db->get('user_docfile_recipient_field_values')->row();
        }

        $this->db->where('id', $documentId);
        $document = $this->db->get('user_docfile')->row();

        $this->db->where('docfile_id', $documentId);
        $this->db->order_by('id', 'ASC');
        $files = $this->db->get('user_docfile_documents')->result_array();

        header('content-type: application/json');
        echo json_encode([
            'document' => $document,
            'recipient' => $recipient,
            'fields' => $fields,
            'files' => $files,
        ]);
    }

    public function send()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false]);
            return;
        }

        $payload = json_decode(file_get_contents('php://input'), true);
        $documentId = $payload['document_id'] ?? null;

        $this->db->where('id', $documentId);
        $document = $this->db->get('user_docfile')->row();

        if (!$document) {
            set_status_header(404);
            echo json_encode(['error' => 404]);
            return;
        }

        $this->db->where('docfile_id', $documentId);
        $this->db->where('role', 'Needs to Sign');
        $this->db->where('completed_at is NULL', null, false);
        $recipients = $this->db->get('user_docfile_recipients')->result();

        $mail = getMailInstance(['subject' => $document->subject]);
        $templatePath = VIEWPATH . 'esign/docusign/email/invitation.html';
        $template = file_get_contents($templatePath);

        $baseUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $baseUrl = str_replace('/send', '', $baseUrl);

        $this->db->where('id', logged('id'));
        $inviter = $this->db->get('users')->row();
        $inviterName = implode(' ', [$inviter->FName, $inviter->LName]);

        foreach ($recipients as $recipient) {
            $message = json_encode(['recipient_id' => $recipient->id, 'document_id' => $documentId]);
            $hash = encrypt($message, $this->password);

            $data = [
                '%link%' => $baseUrl . '/signing?hash=' . $hash,
                '%inviter%' => $inviterName,
            ];

            // $mail->Body = $baseUrl . '/signing?hash=' . $hash;
            $message = strtr($template, $data);

            $mail->MsgHTML($message);
            $mail->addAddress($recipient->email);
            $mail->send();
            $mail->ClearAllRecipients();

            $this->db->where('id', $recipient->id);
            $this->db->update('user_docfile_recipients', ['sent_at' => date('Y-m-d H:i:s')]);
        }

        $this->db->where('id', $documentId);
        $this->db->update('user_docfile', ['status' => 'Waiting for Others']);

        header('content-type: application/json');
        echo json_encode(['success' => true]);
    }

    public function manage()
    {
        $this->checkLogin();

        add_css([
            'https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css',
            'assets/css/esign/docusign/manage/manage.css',
        ]);

        add_footer_js([
            'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js',
            'https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js',
            'assets/js/esign/docusign/manage.js',
        ]);

        $this->load->view('esign/docusign/manage', $this->page_data);
    }

    public function apiManage($view)
    {
        $view = strtolower($view);

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

        $documents = $this->db->get('user_docfile')->result();
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
            array_push($data, $document);
        }

        header('content-type: application/json');
        echo json_encode(['data' => $data, 'view' => $view]);
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

        $mail = getMailInstance();
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

        header('content-type: application/json');
        echo json_encode(['data' => $record]);
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

    public function home()
    {
        $this->checkLogin();
        add_css('assets/css/esign/docusign/home/home.css');
        $this->load->view('esign/docusign/home', $this->page_data);
    }

    public function templateCreate()
    {
        $this->checkLogin();

        add_css([
            'assets/css/esign/esign-builder/esign-builder.css',
            'assets/css/esign/docusign/template-create/template-create.css',
        ]);

        add_footer_js([
            'assets/js/esign/libs/pdf.js',
            'assets/js/esign/libs/pdf.worker.js',
            'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js',
            'assets/js/esign/docusign/template-create.js',
        ]);

        $this->load->view('esign/docusign/template-create/index', $this->page_data);
    }

    public function templateList()
    {
        $this->checkLogin();
        add_css('assets/css/esign/docusign/template-list/template-list.css');
        $this->load->view('esign/docusign/template-list', $this->page_data);
    }

    public function apiStoreTemplate()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false]);
            return;
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

        $id = $this->input->post('id');
        $recipients = json_decode($recipients, true);

        $payload = [
            'name' => $name,
            'description' => $description,
            'subject' => $subject,
            'message' => $message,
            'user_id' => logged('id'),
            'company_id' => logged('company_id'),
        ];

        if (is_null($id)) { // not created yet
            $this->db->insert('user_docfile_templates', $payload);
            $insertedId = $this->db->insert_id();

            for ($i = 0; $i < $count; $i++) {
                $tempName = $files['tmp_name'][$i];
                $filename = $files['name'][$i];
                $filename = time() . "_" . rand(1, 9999999) . "_" . basename($filename);

                $payload = [
                    'name' => $filename,
                    'path' => str_replace(FCPATH, '/', $filepath . $filename),
                    'template_id' => $insertedId,
                ];

                $this->db->insert('user_docfile_templates_documents', $payload);
                move_uploaded_file($tempName, $filepath . $filename);
            }

            if (!empty($recipients)) {
                foreach ($recipients as $recipient) {
                    $payload = [
                        'user_id' => logged('id'),
                        'template_id' => $insertedId,
                        'name' => $recipient['name'],
                        'email' => $recipient['email'],
                        'role' => $recipient['role'],
                        'color' => $recipient['color'],
                        'role_name' => $recipient['role_name'],
                    ];

                    $this->db->insert('user_docfile_templates_recipients', $payload);
                }
            }

            $this->db->where('id', $insertedId);
            $record = $this->db->get('user_docfile_templates')->row();

            header('content-type: application/json');
            echo json_encode(['data' => $record, 'is_created' => true]);
            return;
        }

        header('content-type: application/json');
        echo json_encode(['data' => null]);
    }

    public function apiTemplates()
    {
        $shared = filter_var($this->input->get('shared'), FILTER_VALIDATE_BOOLEAN);

        if (!$shared) {
            $this->db->where('company_id', logged('company_id'));
            $this->db->where('user_id', logged('id'));
            $this->db->order_by('created_at', 'DESC');
            $records = $this->db->get('user_docfile_templates')->result();

            header('content-type: application/json');
            echo json_encode(['data' => $records]);
            return;
        }

        $this->db->where('user_id', logged('id'));
        $sharedTemplates = $this->db->get('user_docfile_templates_shared')->result_array();

        if (empty($sharedTemplates)) {
            header('content-type: application/json');
            echo json_encode(['data' => []]);
            return;
        }

        $sharedTemplateIds = array_map(function ($template) {
            return $template['template_id'];
        }, $sharedTemplates);

        $this->db->where_in('id', $sharedTemplateIds);
        $this->db->order_by('created_at', 'DESC');
        $records = $this->db->get('user_docfile_templates')->result();

        header('content-type: application/json');
        echo json_encode(['data' => $records]);
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
        $this->db->where('template_id', $templateId);
        $this->db->order_by('id', 'ASC');
        $records = $this->db->get('user_docfile_templates_documents')->result_array();

        header('content-type: application/json');
        echo json_encode(['data' => $records]);
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
        $docId = $payload['doc_id'];
        $field = $payload['field'];
        $recipientId = $payload['recipient_id'];
        $userId = logged('id');
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
                'doc_id' => $docId,
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
                'doc_id' => $docId,
                'template_id' => $templateId,
                'field_name' => $field,
                'unique_key' => $uniqueKey,
                'user_id' => $userId,
                'specs' => is_null($specs) ? $record->specs : $specs,
            ]);
        }

        $recordId = $isCreated ? $this->db->insert_id() : $record->id;
        $this->db->where('id', $recordId);
        $record = $this->db->get('user_docfile_templates_fields')->row();

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

    public function apiSendTemplate($templateId)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false]);
            return;
        }

        $filepath = FCPATH . 'uploads/docusign/';
        if (!file_exists($filepath)) {
            mkdir($filepath, 0777, true);
        }

        $payload = json_decode(file_get_contents('php://input'), true);
        $recipients = $payload['recipients'];

        // copy template to user_docfile

        $this->db->where('id', $templateId);
        $template = $this->db->get('user_docfile_templates')->row();

        $this->db->insert('user_docfile', [
            'user_id' => logged('id'),
            'name' => $template->name,
            'type' => count($recipients) > 1 ? 'Multiple' : 'Single',
            'status' => 'Draft',
            'subject' => $template->subject,
            'message' => $template->message,
            'company_id' => logged('company_id'),
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

        // copy template recipients to user_docfile_recipients and
        // template recipient fields to user_docfile_fields

        $this->db->where('template_id', $template->id);
        $templateRecipients = $this->db->get('user_docfile_templates_recipients')->result_array();

        foreach ($recipients as $recipient) {
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

            $this->db->insert('user_docfile_recipients', [
                'user_id' => logged('id'),
                'docfile_id' => $docfileId,
                'name' => $recipient['name'],
                'email' => $recipient['email'],
                'role' => $recipient['role'],
                'color' => $recipient['color'],
            ]);
            $recipientId = $this->db->insert_id();

            $this->db->where('recipients_id', $matchedRecipient['id']);
            $recipientFields = $this->db->get('user_docfile_templates_fields')->result_array();

            foreach ($recipientFields as $field) {
                $this->db->where('docfile_id', $docfileId);
                $this->db->where('template_id', $field['doc_id']);
                $file = $this->db->get('user_docfile_documents')->row(); // the file where the field belongs

                $this->db->insert('user_docfile_fields', [
                    'coordinates' => $field['coordinates'],
                    'docfile_id' => $docfileId,
                    'field_name' => $field['field_name'],
                    'doc_page' => $field['doc_page'],
                    'doc_id' => $file->id,
                    'unique_key ' => uniqid(),
                    'user_id' => logged('id'),
                    'user_docfile_recipients_id' => $recipientId,
                    'specs' => $field['specs'],
                ]);
            }
        }

        $mail = getMailInstance();
        $templatePath = VIEWPATH . 'esign/docusign/email/invitation.html';
        $template = file_get_contents($templatePath);

        $baseUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $baseUrl = str_replace("/apiSendTemplate/$templateId", '', $baseUrl);

        $this->db->where('id', logged('id'));
        $inviter = $this->db->get('users')->row();
        $inviterName = implode(' ', [$inviter->FName, $inviter->LName]);

        $this->db->where('docfile_id', $docfileId);
        $this->db->where('role', 'Needs to Sign');
        $this->db->where('completed_at is NULL', null, false);
        $recipients = $this->db->get('user_docfile_recipients')->result();

        foreach ($recipients as $recipient) {
            $message = json_encode(['recipient_id' => $recipient->id, 'document_id' => $docfileId]);
            $hash = encrypt($message, $this->password);

            $data = [
                '%link%' => $baseUrl . '/signing?hash=' . $hash,
                '%inviter%' => $inviterName,
            ];

            $message = strtr($template, $data);

            $mail->MsgHTML($message);
            $mail->addAddress($recipient->email);
            $mail->send();
            $mail->ClearAllRecipients();

            $this->db->where('id', $recipient->id);
            $this->db->update('user_docfile_recipients', ['sent_at' => date('Y-m-d H:i:s')]);
        }

        $this->db->where('id', $docfileId);
        $this->db->update('user_docfile', ['status' => 'Waiting for Others']);

        header('content-type: application/json');
        echo json_encode(['success' => true]);
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

    return $mail;
}
