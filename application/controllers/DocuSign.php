<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DocuSign extends MY_Controller
{
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

        $baseUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $baseUrl = str_replace('/send', '', $baseUrl);

        foreach ($recipients as $recipient) {
            $message = json_encode(['recipient_id' => $recipient->id, 'document_id' => $documentId]);
            $hash = encrypt($message, $this->password);

            $mail->Body = $baseUrl . '/signing?hash=' . $hash;
            $mail->addAddress($recipient->email);
            $mail->send();
            $mail->ClearAllRecipients();
        }

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
