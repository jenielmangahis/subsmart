<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AccountingReceipts extends MY_Controller
{
    public function apiGetReceipts()
    {
        $isReviewed = filter_var($this->input->get('isReviewed'), FILTER_VALIDATE_BOOLEAN);
        $this->db->where('user_id', logged('id'));
        $this->db->where('to_expense', $isReviewed ? 1 : 0);
        $receipts = $this->db->get('accounting_receipts')->result();

        foreach ($receipts as $receipt) {
            if (!is_null($receipt->payee)) {
                $receipt->__select2_payee = $this->getPayee($receipt->payee);
            }

            if (!is_null($receipt->category_id)) {
                $receipt->__select2_category = $this->getAccount($receipt->category_id);
            }

            if (!is_null($receipt->bank_account_id)) {
                $receipt->__select2_bank_account = $this->getAccount($receipt->bank_account_id);
            }
        }

        header('content-type: application/json');
        echo json_encode(['data' => $receipts]);
    }

    private function getPayee($payeeId)
    {
        [$type, $rowId] = explode('-', $payeeId);
        $value = null;

        if ($type === 'vendor') {
            $this->db->where('id', $rowId);
            $this->db->select(['f_name', 'l_name']);
            $result = $this->db->get('accounting_vendors')->row();
            $value = $result->f_name . ' ' . $result->l_name;
        }

        if ($type === 'employee') {
            $this->db->where('id', $rowId);
            $this->db->select(['FName', 'LName']);
            $result = $this->db->get('users')->row();
            $value = $result->FName . ' ' . $result->LName;
        }

        if ($type === 'customer') {
            $this->db->where('customer_id', $rowId);
            $this->db->select(['display_name']);
            $result = $this->db->get('customer_accounting_details')->row();
            $value = $result->display_name;
        }

        if (is_null($value)) {
            return null;
        }

        return ['text' => $value, 'value' => $payeeId];
    }

    private function getAccount($accountId)
    {
        $this->db->where('id', $accountId);
        $this->db->select(['name']);
        $result = $this->db->get('accounting_chart_of_accounts')->row();

        if (!$result) {
            return null;
        }

        return ['text' => $result->name, 'value' => $accountId];
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

        if ($record->to_expense === "0") {
            $this->db->where('receipt_id', $id);
            $this->db->delete('accounting_receipt_matches');
        }

        header('content-type: application/json');
        echo json_encode(['data' => $record]);
    }

    public function apiSearchExpenses()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false]);
            return;
        }

        $payload = json_decode(file_get_contents('php://input'), true);

        $this->db->where('company_id', logged('company_id'));

        // TODO: transaction_type

        if (array_key_exists('payee', $payload)) {
            [$type, $id] = explode('-', $payload['payee']);
            $this->db->where('payee_type', $type);
            $this->db->where('payee_id', $id);
        }

        if (array_key_exists('payment_account', $payload)) {
            $this->db->where('payment_account_id', $payload['payment_account']);
        }

        if (array_key_exists('minimum_transaction_amount', $payload)) {
            $this->db->where('total_amount >=', (int) $payload['minimum_transaction_amount']);
        }

        if (array_key_exists('maximum_transaction_amount', $payload)) {
            $this->db->where('total_amount <=', (int) $payload['maximum_transaction_amount']);
        }

        if (array_key_exists('starting_date', $payload)) {
            $this->db->where('payment_date >=', date('Y-m-d', strtotime($payload['starting_date'])));
        }

        if (array_key_exists('ending_date', $payload)) {
            $this->db->where('payment_date <=', date('Y-m-d', strtotime($payload['ending_date'])));
        }

        $results = $this->db->get('accounting_expense')->result();

        foreach ($results as $result) {
            $result->type = 'expense';

            if (!is_null($result->payee_type) && !is_null($result->payee_id)) {
                $result->__select2_payee = $this->getPayee($result->payee_type . '-' . $result->payee_id);
            }

            if (!is_null($result->payment_account_id)) {
                $result->__select2_account = $this->getAccount($result->payment_account_id);
            }
        }

        header('content-type: application/json');
        echo json_encode(['data' => $results]);
    }

    public function apiSaveMatch($id)
    {
        header('content-type: application/json');
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false]);
            return;
        }

        $payload = json_decode(file_get_contents('php://input'), true);

        if (!array_key_exists('matches', $payload) && !is_array($payload['matches'])) {
            echo json_encode(['data' => null]);
            return;
        }

        $matches = array_map(function ($match) use ($id) {
            return array_merge(['receipt_id' => $id], $match);
        }, $payload['matches']);

        $this->db->insert_batch('accounting_receipt_matches', $matches);

        $this->db->where('id', $id);
        $this->db->update('accounting_receipts', ['to_expense' => 1]);

        echo json_encode(['data' => $matches]);
    }
}
