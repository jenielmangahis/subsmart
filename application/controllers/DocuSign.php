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

        header('content-type: application/json');
        echo json_encode([
            'document' => $document,
            'recipient' => $recipient,
            'fields' => $fields,
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

        $server = MAIL_SERVER;
        $port = MAIL_PORT;
        $username = MAIL_USERNAME;
        $password = MAIL_PASSWORD;
        $from = MAIL_FROM;
        $subject = 'nSmarTrac: DocuSign';

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
        $mail->IsHTML(true);

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
