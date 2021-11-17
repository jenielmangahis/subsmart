<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AccountingReceipts extends MY_Controller
{
    public function apiGetReceipts()
    {
        $isReviewed = filter_var($this->input->get('isReviewed'), FILTER_VALIDATE_BOOLEAN);
        $this->db->where('to_expense', $isReviewed ? 1 : 0);
        $receipts = $this->db->get('accounting_receipts')->result();

        header('content-type: application/json');
        echo json_encode(['data' => $receipts]);
    }

    public function apiBatchDeleteReceipts()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false]);
            return;
        }

        $payload = json_decode(file_get_contents('php://input'), true);
        ['ids' => $ids] = $payload;

        $this->db->where_in('id', $ids);
        $this->db->select('receipt_img');
        $receipts = $this->db->get('accounting_receipts')->result();

        $receiptsFiles = array_map(function ($receipt) {return $receipt->receipt_img;}, $receipts);
        $this->tryDeleteImages($receiptsFiles);

        $this->db->where_in('id', $ids);
        $this->db->delete('accounting_receipts');

        header('content-type: application/json');
        echo json_encode(['data' => $ids]);
    }

    public function apiBatchConfirmReceipts()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false]);
            return;
        }

        $payload = json_decode(file_get_contents('php://input'), true);
        ['ids' => $ids] = $payload;

        $updates = [];
        foreach ($ids as $id) {
            $updates[] = ['id' => $id, 'to_expense' => 1];
        }

        $this->db->update_batch('accounting_receipts', $updates, 'id');

        header('content-type: application/json');
        echo json_encode(['data' => $ids]);
    }

    public function apiDeleteReceipt($id)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
            echo json_encode(['success' => false]);
            return;
        }

        $this->db->where('id', $id);
        $this->db->select('receipt_img');
        $receipt = $this->db->get('accounting_receipts')->row();
        $this->tryDeleteImages([$receipt->receipt_img]);

        $this->db->where('id', $id);
        $this->db->delete('accounting_receipts');

        header('content-type: application/json');
        echo json_encode(['data' => $id]);
    }

    private function tryDeleteImages(array $fileNames)
    {
        // require_once APPPATH . 'controllers/Accounting.php';
        // $accountingCtrlr = new Accounting();
        // $uploadPath = str_replace('./', '', $accountingCtrlr->upload_path);
        $uploadPath = '/uploads/accounting/';

        foreach ($fileNames as $fileName) {
            $imagePath = FCPATH . $uploadPath . $fileName;
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
    }

    public function apiEditReceipt($id)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false]);
            return;
        }

        $payload = json_decode(file_get_contents('php://input'), true);

        $this->db->where('id', $id);
        $this->db->update('accounting_receipts', $payload);

        $this->db->where('id', $id);
        $record = $this->db->get('accounting_receipts')->row();

        header('content-type: application/json');
        echo json_encode(['data' => $record]);
    }
}
