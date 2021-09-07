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
        $includeInactive = $this->input->get('include_inactive', true);
        $includeInactive = filter_var($includeInactive, FILTER_VALIDATE_BOOLEAN);

        $this->db->where('user_id', logged('id'));
        if (!$includeInactive) {
            $this->db->where('is_active', 1);
        }

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

        if (!array_key_exists('agency_id', $payload)) {
            $this->db->select('id');
            $this->db->where('user_id', $payload['user_id']);
            $this->db->where('agency', $payload['agency']);
            $agency = $this->db->get('accounting_tax_agencies')->row();
            $payload['agency_id'] = $agency ? $agency->id : null;

            if (is_null($payload['agency_id'])) {
                $this->db->insert('accounting_tax_agencies', [
                    'user_id' => $payload['user_id'],
                    'agency' => $payload['agency'],
                    'frequency' => 'yearly',
                    'start_date' => date('Y-m-d'),
                    'start_period' => date('Y') . '-01-01',
                ]);

                $payload['agency_id'] = $this->db->insert_id();
            }
        }

        unset($payload['agency']);
        $this->db->insert('accounting_tax_rates', $payload);

        $this->db->where('id', $this->db->insert_id());
        $record = $this->db->get('accounting_tax_rates')->row();

        header('content-type: application/json');
        echo json_encode(['data' => $record]);
    }

    public function apiGetRates()
    {
        $includeInactive = $this->input->get('include_inactive', true);
        $includeInactive = filter_var($includeInactive, FILTER_VALIDATE_BOOLEAN);

        $this->db->where('user_id', logged('id'));
        if (!$includeInactive) {
            $this->db->where('is_active', 1);
        }

        $rates = $this->db->get('accounting_tax_rates')->result();

        $agencyIdMap = [];
        foreach ($rates as $rate) {
            if (!array_key_exists($rate->agency_id, $agencyIdMap)) {
                $this->db->where('id', $rate->agency_id);
                $agencyIdMap[$rate->agency_id] = $this->db->get('accounting_tax_agencies')->row();
            }

            $rate->agency = $agencyIdMap[$rate->agency_id];
        }

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
        if (empty($payload)) {
            $payload['due_start'] = date('Y-m-01');
            $payload['due_end'] = $payload['due_start'];
        }

        $dueStart = strtotime($payload['due_start']);
        $dueStart = date('Y-m-d', $dueStart);

        $dueEnd = strtotime($payload['due_end']);
        $dueEnd = date('Y-m-t', $dueEnd);

        $this->db->where('user_id', logged('id'));
        // $this->db->where('taxes >', '0');

        $this->db->where("STR_TO_DATE(due_date,'%Y-%m-%d') >=", $dueStart);
        $this->db->where("STR_TO_DATE(due_date,'%Y-%m-%d') <=", $dueEnd);

        $this->db->join('accounting_invoice_tax_agencies agencies', 'agencies.invoice_id = invoices.id', 'left');
        $this->db->order_by("STR_TO_DATE(due_date, '%Y-%m-%d')", 'DESC', false);
        $results = $this->db->get('invoices')->result();

        $companyIdMap = [];
        $agencyIdMap = [];
        $records = [
            'due' => [],
            'upcoming' => [],
            'overdue' => [],
        ];

        $currentDate = date('Y-m-d');
        $currentDateUnix = strtotime($currentDate);

        foreach ($results as $result) {
            if (!array_key_exists($result->company_id, $companyIdMap)) {
                $this->db->where('id', $result->company_id);
                $companyIdMap[$result->company_id] = $this->db->get('clients')->row();
            }

            if (!is_null($result->agency_id) && !array_key_exists($result->agency_id, $agencyIdMap)) {
                $this->db->where('id', $result->agency_id);
                $agencyIdMap[$result->agency_id] = $this->db->get('accounting_tax_agencies')->row();
            }

            $result->company = $companyIdMap[$result->company_id];
            $result->agency = $agencyIdMap[$result->agency_id];

            $dueDateUnix = strtotime($result->due_date);
            $type = null;

            if ($result->due_date === $currentDate) {
                $type = 'due';

            } else if ($dueDateUnix > $currentDateUnix) {
                $type = 'upcoming';

            } else if ($dueDateUnix < $currentDateUnix) {
                $type = 'overdue';
            }

            $records[$type][] = $result;
        }

        header('content-type: application/json');
        echo json_encode([
            'data' => $records,
            'due_start' => $dueStart,
            'due_end' => $dueEnd,
        ]);
    }

    public function apiGetTaxedInvoicesDueDates()
    {
        $this->db->where('user_id', logged('id'));
        $this->db->select("STR_TO_DATE(due_date, '%Y-%m-%d') due_date");
        $this->db->order_by('due_date', 'ASC');
        $results = $this->db->get('invoices')->result();

        $records = [date('F Y')];
        foreach ($results as $result) {
            $date = date('F Y', strtotime($result->due_date));
            if (!in_array($date, $records)) {
                array_push($records, $date);
            }
        }

        $orderFunc = function ($a, $b) {
            return strtotime($a) - strtotime($b);
        };

        usort($records, $orderFunc);

        if (count($records) > 2) {
            // List all months between first and last date
            // https://stackoverflow.com/a/18743012/8062659

            $start = (new DateTime(array_shift($records)))->modify('first day of this month');
            $end = (new DateTime(array_pop($records)))->modify('first day of next month');
            $interval = DateInterval::createFromDateString('1 month');
            $period = new DatePeriod($start, $interval, $end);

            $records = [];
            foreach ($period as $date) {
                array_push($records, $date->format('F Y'));
            }
        }

        // not necessary? :D
        usort($records, $orderFunc);

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
