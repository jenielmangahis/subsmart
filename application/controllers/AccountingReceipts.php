<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AccountingReceipts extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('receipt_model');
    }

    public function apiGetReceipts()
    {
        header('content-type: application/json');
        echo json_encode(['data' => $this->receipt_model->getReceipt()]);
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
        $this->db->delete('accounting_receipts');

        header('content-type: application/json');
        echo json_encode(['data' => $ids]);
    }
}
