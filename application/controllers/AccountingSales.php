<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AccountingSales extends MY_Controller
{
    public function apiSaveAgency()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false]);
            return;
        }

        $payload = json_decode(file_get_contents('php://input'), true);
        $payload['user_id'] = logged('id');
        $this->db->insert('accounting_tax_agencies', $payload);

        $this->db->where('id', $this->db->insert_id());
        $record = $this->db->get('accounting_tax_agencies')->row();

        header('content-type: application/json');
        echo json_encode(['data' => $record]);
    }

    public function apiGetAgencies()
    {
        $this->db->where('user_id', logged('id'));
        $agencies = $this->db->get('accounting_tax_agencies')->result();

        header('content-type: application/json');
        echo json_encode(['data' => $agencies]);
    }

    public function apiEditAgency($agencyId)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false]);
            return;
        }

        $payload = json_decode(file_get_contents('php://input'), true);

        $this->db->where('id', $agencyId);
        $this->db->update('accounting_tax_agencies', $payload);

        $this->db->where('id', $agencyId);
        $record = $this->db->get('accounting_tax_agencies')->row();

        header('content-type: application/json');
        echo json_encode(['data' => $record]);
    }

    public function apiSaveRate()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false]);
            return;
        }

        $payload = json_decode(file_get_contents('php://input'), true);
        $payload['user_id'] = logged('id');
        $this->db->insert('accounting_tax_rates', $payload);

        $this->db->where('id', $this->db->insert_id());
        $record = $this->db->get('accounting_tax_rates')->row();

        header('content-type: application/json');
        echo json_encode(['data' => $record]);
    }

    public function apiGetRates()
    {
        $this->db->where('user_id', logged('id'));
        $this->db->where('is_active', 1);
        $rates = $this->db->get('accounting_tax_rates')->result();

        header('content-type: application/json');
        echo json_encode(['data' => $rates]);
    }

    public function apiEditRate($rateId)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false]);
            return;
        }

        $payload = json_decode(file_get_contents('php://input'), true);

        $this->db->where('id', $rateId);
        $this->db->update('accounting_tax_rates', $payload);

        $this->db->where('id', $rateId);
        $record = $this->db->get('accounting_tax_rates')->row();

        header('content-type: application/json');
        echo json_encode(['data' => $record]);
    }

    public function apiGetTaxedInvoices()
    {
        $records = [];
        $statuses = ['overdue', 'due', 'upcoming'];

        $currentDate = date('Y-m-d');
        $nextWeekDate = date('Y-m-d', strtotime('+7 days'));

        foreach ($statuses as $status) {
            $this->db->where('user_id', logged('id'));
            $this->db->where('taxes >', '0');

            if ($status === 'overdue') {
                $this->db->where("STR_TO_DATE(due_date,'%Y-%m-%d') <", $currentDate);

            } else if ($status === 'due') {
                $this->db->where("STR_TO_DATE(due_date,'%Y-%m-%d') =", $currentDate);

            } else { // upcoming
                $this->db->where("STR_TO_DATE(due_date,'%Y-%m-%d') >", $currentDate);
                $this->db->where("STR_TO_DATE(due_date,'%Y-%m-%d') <=", $nextWeekDate);
            }

            $records[$status] = $this->db->get('invoices')->result();
        }

        header('content-type: application/json');
        echo json_encode(['data' => $records]);
    }
}
