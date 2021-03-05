<?php
defined('BASEPATH') or exit('No direct script access allowed');

class FillAndSign extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->checkLogin();
    }

    public function step1()
    {
        add_css([
            'assets/esign/css/bootstrap.min.css',
            'assets/css/esign/fill-and-sign/fill-and-sign.css'
        ]);

        add_footer_js([
            'https://code.jquery.com/jquery-1.12.4.js',
            'https://code.jquery.com/ui/1.12.1/jquery-ui.js',
            'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js',

            'assets/js/esign/libs/pdf.js',
            'assets/js/esign/libs/pdf.worker.js',
            'assets/js/esign/fill-and-sign/step1.js',
        ]);

        $this->load->view('esign/fill-and-sign/step1', $this->page_data);
    }

    public function step2()
    {
        add_css([
            'assets/esign/css/bootstrap.min.css',
            'assets/css/esign/fill-and-sign/fill-and-sign.css',
        ]);

        add_footer_js([
            'https://code.jquery.com/jquery-1.12.4.js',
            'https://code.jquery.com/ui/1.12.1/jquery-ui.js',
            'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js',
            'https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.5.3/signature_pad.min.js',
            'https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.0/jspdf.umd.min.js',
            'https://html2canvas.hertzen.com/dist/html2canvas.js',
            'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js',

            'assets/js/esign/libs/pdf.js',
            'assets/js/esign/libs/pdf.worker.js',
            'assets/js/esign/fill-and-sign/step2.js',
        ]);

        $this->load->view('esign/fill-and-sign/step2', $this->page_data);
    }

    public function store()
    {
        header('content-type: application/json');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false]);
            return;
        }

        $filepath = './uploads/fillandsign/';
        if (!file_exists($filepath)) {
            mkdir($filepath, 0777, true);
        }

        $fileId = $_POST['vault_file_id'] ?? NULL;
        $file = $_FILES['document'];
        $userId = logged('id');

        if ($fileId) {
            // the user has select a document from the files vault

            $query = <<<SQL
            SELECT `filevault`.*, `business_profile`.`folder_name` FROM `filevault`
            LEFT JOIN `business_profile` ON `filevault`.`company_id` = `business_profile`.`id`
            WHERE `filevault`.`file_id` = ? AND `filevault`.`company_id` = ?
            SQL;

            $file = (array) $this->db->query($query, [$fileId, logged('company_id')])->row();

            ['folder_name' => $folderName, 'file_path' => $_filePath, 'title' => $filename] = $file;
            $currFilePath = trim($_filePath, '/');

            // copy vault document with new name
            $filename = time() . "_" . rand(1, 9999999) . "_" . basename($filename);
            copy("./uploads/$folderName/$currFilePath", $filepath . $filename);

            $this->db->insert('fill_and_sign_documents', [
                'name' => $filename,
                'user_id' => $userId,
            ]);

            echo json_encode(['document_id' => $this->db->insert_id()]);
            return;
        }

        $tempName = $file['tmp_name'];
        $filename = $file['name'];
        $filename = time() . "_" . rand(1, 9999999) . "_" . basename($filename);

        move_uploaded_file($tempName, $filepath . $filename);
        $this->db->insert('fill_and_sign_documents', [
            'name' => $filename,
            'user_id' => $userId,
        ]);

        echo json_encode(['document_id' => $this->db->insert_id()]);
    }

    public function get($documentId)
    {
        $this->db->where('user_id', logged('id'));
        $this->db->where('id', $documentId);
        $record = $this->db->get('fill_and_sign_documents')->row();

        if (is_null($record)) {
            $this->output->set_status_header('404');
        }

        header('content-type: application/json');
        echo json_encode(['document' => $record]);
    }

    public function storeField()
    {
        header('content-type: application/json');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false]);
            return;
        }

        $payload = json_decode(file_get_contents('php://input'), true);

        $coordinates = json_encode($payload['coordinates']);
        $documentPage = $payload['document_page'];
        $documentId = $payload['document_id'];
        $value = $payload['value'];
        $uniqueKey = $payload['unique_key'];
        $textType = $payload['text_type'];
        $fontSize = $payload['size'];
        $userId = logged('id');

        $this->db->where('user_id', $userId);
        $this->db->where('document_id', $documentId);
        $this->db->where('unique_key', $uniqueKey);
        $record = $this->db->get('fill_and_sign_documents_fields')->row();

        if (is_null($record)) {
            $this->db->insert('fill_and_sign_documents_fields', [
                'coordinates' => $coordinates,
                'document_page' => $documentPage,
                'document_id' => $documentId,
                'value' => $value,
                'unique_key' => $uniqueKey,
                'user_id' => $userId,
                'textType' => $textType,
                'size' => $fontSize,
            ]);
        } else {
            $this->db->where('id', $record->id);
            $this->db->update('fill_and_sign_documents_fields', [
                'coordinates' => $coordinates,
                'document_page' => $documentPage,
                'document_id' => $documentId,
                'value' => $value,
                'unique_key' => $uniqueKey,
                'textType' => $textType,
                'size' => $fontSize,
            ]);
        }

        echo json_encode(['success' => true]);
    }

    public function getFields($documentId)
    {
        $this->db->where('user_id', logged('id'));
        $this->db->where('document_id', $documentId);
        $records = $this->db->get('fill_and_sign_documents_fields')->result();

        header('content-type: application/json');
        echo json_encode(['fields' => $records]);
    }

    public function deleteField($uniqueKey)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
            echo json_encode(['success' => false]);
            return;
        }

        $this->db->where('user_id', logged('id'));
        $this->db->where('unique_key', $uniqueKey);
        $this->db->delete('fill_and_sign_documents_fields');

        header('content-type: application/json');
        echo json_encode(['success' => true]);
    }

    public function storeSignature()
    {
        header('content-type: application/json');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false]);
            return;
        }

        $payload = json_decode(file_get_contents('php://input'), true);

        $coordinates = json_encode($payload['coordinates']);
        $documentPage = $payload['document_page'];
        $documentId = $payload['document_id'];
        $value = $payload['value'];
        $uniqueKey = $payload['unique_key'];
        $size = json_encode($payload['size']);
        $userId = logged('id');

        $this->db->where('user_id', $userId);
        $this->db->where('document_id', $documentId);
        $this->db->where('unique_key', $uniqueKey);
        $record = $this->db->get('fill_and_sign_documents_signatures')->row();

        if (is_null($record)) {
            $this->db->insert('fill_and_sign_documents_signatures', [
                'coordinates' => $coordinates,
                'document_page' => $documentPage,
                'document_id' => $documentId,
                'value' => $value,
                'unique_key' => $uniqueKey,
                'user_id' => $userId,
                'size' => $size,
            ]);
        } else {
            $this->db->where('id', $record->id);
            $this->db->update('fill_and_sign_documents_signatures', [
                'coordinates' => $coordinates,
                'document_page' => $documentPage,
                'document_id' => $documentId,
                'value' => $value,
                'unique_key' => $uniqueKey,
                'size' => $size,
            ]);
        }

        echo json_encode(['success' => true]);
    }

    public function getSignatures($documentId)
    {
        $this->db->where('user_id', logged('id'));
        $this->db->where('document_id', $documentId);
        $records = $this->db->get('fill_and_sign_documents_signatures')->result();

        header('content-type: application/json');
        echo json_encode(['signatures' => $records]);
    }

    public function deleteSignature($uniqueKey)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
            echo json_encode(['success' => false]);
            return;
        }

        $this->db->where('user_id', logged('id'));
        $this->db->where('unique_key', $uniqueKey);
        $this->db->delete('fill_and_sign_documents_signatures');

        header('content-type: application/json');
        echo json_encode(['success' => true]);
    }

    public function getLink($documentId)
    {
        header('content-type: application/json');

        $this->db->where('document_id', $documentId);
        $record = $this->db->get('fill_and_sign_documents_links')->row();
        echo json_encode(['link' => $record]);
    }

    private function _createLink($file, $documentId) {
        $filepath = './uploads/fillandsign/out/';

        if (!file_exists($filepath)) {
            mkdir($filepath, 0777, true);
        }

        $this->db->where('document_id', $documentId);
        $record = $this->db->get('fill_and_sign_documents_links')->row();

        if (!is_null($record)) {
            return $record;
        }

        $hash = md5(uniqid($documentId, true));
        $this->db->insert('fill_and_sign_documents_links', [
            'hash' => $hash,
            'document_id' => $documentId,
        ]);

        $tempName = $file['tmp_name'];
        move_uploaded_file($tempName, $filepath . $hash . '.pdf');

        $this->db->where('id', $this->db->insert_id());
        $record = $this->db->get('fill_and_sign_documents_links')->row();
        return $record;
    }

    public function createLink($documentId)
    {
        header('content-type: application/json');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false]);
            return;
        }

        $file = $_FILES['document'];
        $record = $this->_createLink($file, $documentId);
        echo json_encode(['link' => $record]);
    }

    public function getVaultPdfs()
    {
        $query = <<<SQL
        SELECT `filevault`.*, `business_profile`.`folder_name`, `users`.`FName`, `users`.`LName` FROM `filevault`
        LEFT JOIN `business_profile` ON `filevault`.`company_id` = `business_profile`.`id`
        LEFT JOIN `users` ON `filevault`.`user_id` = `users`.`id`
        WHERE `filevault`.`title` like '%.pdf' AND `filevault`.`company_id` = ?
        SQL;

        $pdfs = $this->db->query($query, [logged('company_id')])->result();

        header('content-type: application/json');
        echo json_encode(['documents' => $pdfs]);
    }

    function emailDocument($documentId) {
        // header('content-type: application/json');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false]);
            return;
        }

        $file = $_FILES['document'];
        $document = $this->_createLink($file, $documentId);
	    $emails = $this->input->post('emails');

	    $this->db->where('id', logged('id'));
        $currentUser = $this->db->get('users')->row();
	    $currentUserName = implode(' ', [$currentUser->FName, $currentUser->LName]);

        $server = MAIL_SERVER;
        $port = MAIL_PORT ;
        $username = MAIL_USERNAME;
        $password = MAIL_PASSWORD;
        $from = MAIL_FROM;
        $subject = 'nSmarTrac: Fill & eSign';

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
        $mail->Body = $currentUserName . ' shared you a document.';

        $documentPath = realpath(APPPATH . '../uploads/fillandsign/out/' . $document->hash . '.pdf');
        $mail->addAttachment($documentPath);

        foreach($emails as $email) {
            $mail->addAddress($email);
        }

        if(!$mail->send()) {
            echo json_encode(['success' => false]);
            return;
        }

        echo json_encode(['success' => true]);
    }

    private function isLocalhost($whitelist = ['127.0.0.1', '::1']) {
        return in_array($_SERVER['REMOTE_ADDR'], $whitelist);
    }


    public function getRecents() {
        $query = <<<SQL
        SELECT `fill_and_sign_documents`.* FROM `fill_and_sign_documents`
        LEFT JOIN `fill_and_sign_documents_links` ON `fill_and_sign_documents`.`id` = `fill_and_sign_documents_links`.`document_id`
        WHERE `fill_and_sign_documents_links`.`hash` IS NULL AND
        `fill_and_sign_documents`.`user_id` = ?
        ORDER BY `fill_and_sign_documents`.`id` DESC
        LIMIT 5
        SQL;

        $results = $this->db->query($query, [logged('id')])->result();

        header('content-type: application/json');
        echo json_encode(['documents' => $results]);
    }
}
