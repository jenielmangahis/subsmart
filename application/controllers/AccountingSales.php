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
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false]);
            return;
        }

        $payload = json_decode(file_get_contents('php://input'), true);

        $records = [];
        $statuses = ['overdue', 'due', 'upcoming'];

        $currentDate = date('Y-m-d');
        $nextWeekDate = date('Y-m-d', strtotime('+7 days'));

        $companyIdMap = [];

        foreach ($statuses as $status) {
            $this->db->where('user_id', logged('id'));
            $this->db->where('taxes >', '0');

            if (empty($payload)) {
                if ($status === 'overdue') {
                    $this->db->where("STR_TO_DATE(due_date,'%Y-%m-%d') <", $currentDate);
                    // $this->db->where('status', 'Overdue');

                } else if ($status === 'due') {
                    $this->db->where("STR_TO_DATE(due_date,'%Y-%m-%d') =", $currentDate);
                    // $this->db->where('status', 'Due');

                } else { // upcoming
                    $this->db->where("STR_TO_DATE(due_date,'%Y-%m-%d') >", $currentDate);
                    $this->db->where("STR_TO_DATE(due_date,'%Y-%m-%d') <=", $nextWeekDate);
                }
            } else {
                // TODO: debug/fix overdue, due and upcoming

                $dueStart = strtotime($payload['due_start']);
                $dueStart = date('Y-m-d', $dueStart);

                $dueEnd = strtotime($payload['due_end']);
                $dueEnd = date('Y-m-d', $dueEnd);

                $this->db->where("STR_TO_DATE(due_date,'%Y-%m-%d') >=", $dueStart);
                $this->db->where("STR_TO_DATE(due_date,'%Y-%m-%d') <=", $dueEnd);

                if ($status === 'overdue') {
                    $this->db->where('status', 'Overdue');

                } else if ($status === 'due') {
                    $this->db->where('status', 'Due');

                } else { // no upcoming
                    $this->db->where('id', '-1');
                }
            }

            $this->db->order_by("STR_TO_DATE(due_date, '%Y-%m-%d')", 'DESC', false);
            $results = $this->db->get('invoices')->result();

            foreach ($results as $result) {
                if (!array_key_exists($result->company_id, $companyIdMap)) {
                    $this->db->where('id', $result->company_id);
                    $companyIdMap[$result->company_id] = $this->db->get('clients')->row();
                }

                $result->company = $companyIdMap[$result->company_id];
            }

            $records[$status] = $results;
        }

        header('content-type: application/json');
        echo json_encode(['data' => $records]);
    }

    public function apiGetTaxedInvoicesDueDates()
    {
        $this->db->where('user_id', logged('id'));
        $this->db->select("STR_TO_DATE(due_date, '%Y-%m-%d') due_date");
        $this->db->order_by('due_date', 'ASC');
        $results = $this->db->get('invoices')->result();

        $records = [];
        foreach ($results as $result) {
            $date = date('F Y', strtotime($result->due_date));
            if (!in_array($date, $records)) {
                array_push($records, $date);
            }
        }

        header('content-type: application/json');
        echo json_encode(['data' => $records]);
    }

    public function apiSaveAdjustment()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false]);
            return;
        }

        $payload = json_decode(file_get_contents('php://input'), true);
        $payload['user_id'] = logged('id');
        $this->db->insert('accounting_tax_adjustments', $payload);

        $this->db->where('id', $this->db->insert_id());
        $record = $this->db->get('accounting_tax_agencies')->row();

        header('content-type: application/json');
        echo json_encode(['data' => $record]);
    }
}
