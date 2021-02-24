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

        $file = $_FILES['document'];
        $filepath = './uploads/fillandsign/';

        if (!file_exists($filepath)) {
            mkdir($filepath, 0777, true);
        }

        $userId = logged('id');
        $tempName = $file['tmp_name'];

        $filename = $file['name'];
        $filename = time() . "_" . rand(1, 9999999) . "_" . basename($filename);

        move_uploaded_file($tempName, $filepath . $filename);
        $this->db->insert('fill_and_sign_documents', [
            'name' => $filename,
            'user_id' => $userId,
        ]);

        header('content-type: application/json');
        echo json_encode(['document_id' => $this->db->insert_id()]);
    }

    public function get($documentId)
    {
        $this->db->where('user_id', logged('id'));
        $this->db->where('id', $documentId);
        $record = $this->db->get('fill_and_sign_documents')->row();

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

    public function createLink($documentId)
    {
        header('content-type: application/json');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false]);
            return;
        }

        $file = $_FILES['document'];
        $filepath = './uploads/fillandsign/out/';

        if (!file_exists($filepath)) {
            mkdir($filepath, 0777, true);
        }

        $this->db->where('document_id', $documentId);
        $record = $this->db->get('fill_and_sign_documents_links')->row();

        if (!is_null($record)) {
            echo json_encode(['link' => $record]);
            return;
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

        echo json_encode(['link' => $record]);
    }
}
