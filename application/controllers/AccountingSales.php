<?php

use oasis\names\specification\ubl\schema\xsd\CommonBasicComponents_2\StartDate;

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
        $userId = logged('id');
        $data = null;

        if (!array_key_exists('rates', $payload)) {
            $payload['user_id'] = $userId;
            $data = $this->saveRate($payload);
        } else {
            ['rates' => $rates] = $payload;
            $rateValues = array_map(function ($rate) {
                return (float) $rate['rate'];
            }, $rates);

            $totalRate = array_sum($rateValues);
            $parent = $this->saveRate([
                'name' => $payload['name'],
                'rate' => $totalRate,
                'agency_id' => null,
                'user_id' => $userId,
            ]);

            foreach ($rates as $rate) {
                $agency = new stdClass;
                $agency->id = $rate['agency_id'] ?? null;

                if (array_key_exists('agency', $rate)) {
                    $agency = $this->findOrCreateAgency([
                        'user_id' => $userId,
                        'name' => $rate['agency'],
                    ]);
                }

                $this->db->insert('accounting_tax_rates_combined_items', [
                    'user_id' => $userId,
                    'rate_id' => $parent->id,
                    'agency_id' => $agency->id,
                    'rate' => $rate['rate'],
                    'name' => $rate['name'],
                ]);
            }

            $data = $parent;
        }

        header('content-type: application/json');
        echo json_encode(['data' => $data]);
    }

    private function saveRate(array $payload)
    {
        $agency = new stdClass;
        $agency->id = $payload['agency_id'] ?? null;

        if (array_key_exists('agency', $payload)) {
            $agency = $this->findOrCreateAgency([
                'user_id' => $payload['user_id'],
                'name' => $payload['agency'],
            ]);
        }

        unset($payload['agency']);
        $payload['agency_id'] = $agency->id;
        $this->db->insert('accounting_tax_rates', $payload);

        $this->db->where('id', $this->db->insert_id());
        return $this->db->get('accounting_tax_rates')->row();
    }

    private function findOrCreateAgency(array $attributes, array $values = [])
    {
        foreach ($attributes as $key => $attributeValue) {
            $this->db->where($key, $attributeValue);
        }
        $agency = $this->db->get('accounting_tax_agencies')->row();

        if ($agency) {
            return $agency;
        }

        $payload = array_merge($attributes, $values, [
            'frequency' => 'yearly',
            'start_date' => date('Y-m-d'),
            'start_period' => date('Y') . '-01-01',
        ]);

        $this->db->insert('accounting_tax_agencies', $payload);

        $this->db->where('id', $this->db->insert_id());
        return $this->db->get('accounting_tax_agencies')->row();
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
        $getAgency = function ($rate) use ($agencyIdMap) {
            if (is_null($rate->agency_id)) {
                return null;
            }

            if (!array_key_exists($rate->agency_id, $agencyIdMap)) {
                $this->db->where('id', $rate->agency_id);
                $agencyIdMap[$rate->agency_id] = $this->db->get('accounting_tax_agencies')->row();
            }

            return $agencyIdMap[$rate->agency_id];
        };

        foreach ($rates as $rate) {
            $rate->agency = $getAgency($rate);

            if (!is_null($rate->agency_id)) {
                continue;
            }

            $this->db->where('rate_id', $rate->id);
            $rate->items = $this->db->get('accounting_tax_rates_combined_items')->result();

            foreach ($rate->items as $item) {
                $item->agency = $getAgency($item);
            }
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

        $query = <<<SQL
        SELECT `i`.*, `a`.`agency_id` FROM `invoices` AS `i`
        LEFT JOIN `accounting_invoice_tax_agencies` AS `a` ON `a`.`invoice_id` = `i`.`id`
        WHERE `i`.`user_id` = ? AND STR_TO_DATE(`i`.`due_date`, '%Y-%m-%d') >= ? AND
        STR_TO_DATE(`i`.`due_date`, '%Y-%m-%d') <= ? ORDER BY STR_TO_DATE(`i`.`due_date`, '%Y-%m-%d') DESC

SQL;

        $params = [logged('id'), $dueStart, $dueEnd];
        $results = $this->db->query($query, $params)->result();

        $companyIdMap = [];
        $agencyIdMap = [];
        $bankIdMap = [];
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

            $this->db->where('invoice_id', $result->id);
            $result->items = $this->db->get('invoices_items')->result();

            $this->db->where('invoice_id', $result->id);
            $result->adjustments = $this->db->get('accounting_tax_adjustments')->result();

            $this->db->where('invoice_id', $result->id);
            $result->payments = $this->db->get('accounting_invoice_tax_payments')->result();

            // assign payment bank
            foreach ($result->payments as $payment) {
                if (!array_key_exists($payment->bank_account_id, $bankIdMap)) {
                    $this->db->where('id', $payment->bank_account_id);
                    $bankIdMap[$payment->bank_account_id] = $this->db->get('accounting_chart_of_accounts')->row();
                }

                $payment->bank = $bankIdMap[$payment->bank_account_id];
            }

            $dueDateUnix = strtotime($result->due_date);
            $type = null;

            if ($result->due_date === $currentDate) {
                $type = 'due';
            } elseif ($dueDateUnix > $currentDateUnix) {
                $type = 'upcoming';
            } elseif ($dueDateUnix < $currentDateUnix) {
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

    public function apiSavePayment()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false]);
            return;
        }

        $payload = json_decode(file_get_contents('php://input'), true);
        $payload['user_id'] = logged('id');

        $this->db->insert('accounting_invoice_tax_payments', $payload);

        $this->db->where('id', $this->db->insert_id());
        $record = $this->db->get('accounting_invoice_tax_payments')->row();

        header('content-type: application/json');
        echo json_encode(['data' => $record]);
    }

    public function apiEditRateItem($rateItemId)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false]);
            return;
        }

        $payload = json_decode(file_get_contents('php://input'), true);

        $this->db->where('id', $rateItemId);
        $this->db->update('accounting_tax_rates_combined_items', $payload);

        $this->db->where('id', $rateItemId);
        $record = $this->db->get('accounting_tax_rates_combined_items')->row();

        $this->db->where('rate_id', $record->rate_id);
        $allParentItems = $this->db->get('accounting_tax_rates_combined_items')->result();

        $newParentTotal = 0;
        foreach ($allParentItems as $item) {
            $newParentTotal += (float) $item->rate;
        }

        $this->db->where('id', $record->rate_id);
        $this->db->update('accounting_tax_rates', ['rate' => $newParentTotal]);

        header('content-type: application/json');
        echo json_encode(['data' => $record]);
    }
    public function get_income_overtime()
    {
        $this->load->model('accounting_receive_payment_model');
        //caculating this month overall income
        $income_label="";
        $last_income_label="";
        $income_month_label="";
        $income_year_label="";
        $duration = $this->input->post("duration");
        if ($duration == "This month") {
            $start_date=date("Y-m-01");
            $end_date=date("Y-m-d");
            $income_label=date("M Y");
            $last_income_label=date("M Y", strtotime('-1 year', strtotime($end_date)));
            $income_month_label=date("m", strtotime($end_date));
            $income_year_label=date("Y", strtotime($end_date));
        } elseif ($duration == "Last month") {
            $end_date=date("Y-m-d", strtotime("last day of previous month"));
            $start_date=date("Y-m-01", strtotime($end_date));
            $income_label=date("M Y", strtotime($end_date));
            $last_income_label=date("M Y", strtotime('-1 year', strtotime($end_date)));
            $income_month_label=date("m", strtotime($end_date));
            $income_year_label=date("Y", strtotime($end_date));
        } elseif ($duration == "This quarter") {
            $month = date("n");
            $yearQuarter = ceil($month / 3);
            if ($yearQuarter == 1) {
                $start_date = date("Y-01-01");
            } elseif ($yearQuarter == 2) {
                $start_date = date("Y-04-01");
            } elseif ($yearQuarter == 3) {
                $start_date = date("Y-07-01");
            } elseif ($yearQuarter == 4) {
                $start_date = date("Y-10-01");
            }
            $end_date = date("Y-m-d");
            $income_label="Q".$yearQuarter." ".date("Y", strtotime($end_date));
            $last_income_label="Q".$yearQuarter." ".date("Y", strtotime('-1 year', strtotime($end_date)));
            $income_month_label=date("m", strtotime($end_date));
            $income_year_label=date("Y", strtotime($end_date));
        } elseif ($duration == "Last quarter") {
            $month = date("n");
            $yearQuarter = ceil($month / 3)-1;
            $year=date("Y");
            if ($yearQuarter < 1) {
                $yearQuarter+=4;
                $year=date("Y", strtotime("-1 year", strtotime(date("Y-m-d"))));
            }
            if ($yearQuarter == 1) {
                $start_date = $year."-".date("01-01");
            } elseif ($yearQuarter == 2) {
                $start_date = $year."-".date("04-01");
            } elseif ($yearQuarter == 3) {
                $start_date = $year."-".date("07-01");
            } elseif ($yearQuarter == 4) {
                $start_date = $year."-".date("10-01");
            }
            $end_date = date("Y-m-t", strtotime('+2 months', strtotime($start_date)));
            $income_label="Q".$yearQuarter." ".date("Y", strtotime($end_date));
            $last_income_label="Q".$yearQuarter." ".date("Y", strtotime('-1 year', strtotime($end_date)));
            $income_month_label=date("m", strtotime($end_date));
            $income_year_label=date("Y", strtotime($end_date));
        } elseif ($duration == "This year by month" || $duration == "This year by quarter") {
            $start_date = date("Y-01-01");
            $end_date = date("Y-m-d");
            $income_label=date("Y");
            $last_income_label=date("Y", strtotime('-1 year', strtotime($end_date)));
            $income_month_label=date("m", strtotime($end_date));
            $income_year_label=date("Y", strtotime($end_date));
        } elseif ($duration == "Last year by month" || $duration == "Last year by quarter") {
            $lastyear=date("Y")-1;
            $start_date= date("Y-m-d", strtotime($lastyear."-01-01"));
            $end_date = date("Y-m-t", strtotime('+11 months', strtotime($start_date)));
            $income_label=date("Y", strtotime($end_date));
            $last_income_label=date("Y", strtotime('-1 year', strtotime($end_date)));
            $income_month_label=date("m", strtotime($end_date));
            $income_year_label=date("Y", strtotime($end_date));
        }
        $receive_payments = $this->accounting_receive_payment_model->get_ranged_received_payment_by_company_id(getLoggedCompanyID(), $start_date, $end_date);
        $current_income=0;
        $income_per_day = array();
        $income_per_month = array();
        $income_per_quarter = array();
        foreach ($receive_payments as $payment) {
            $current_income +=$payment->amount;

            $per_day_index=date("d", strtotime($payment->payment_date))+10;
            $income_per_day[$per_day_index]+=$payment->amount;

            $per_month_index=date("m", strtotime($payment->payment_date))+10;
            $income_per_month[$per_month_index]+=$payment->amount;

            $month = date("n", strtotime($payment->payment_date));
            $yearQuarter = ceil($month / 3);
            $income_per_quarter[$yearQuarter] +=$payment->amount;
        }
        // ksort($income_per_day);
        // ksort($income_per_month);
        // ksort($income_per_quarter);
        $last_start_date = date("Y-m-d", strtotime("-1 year", strtotime($start_date)));
        $last_end_date = date("Y-m-d", strtotime("-1 year", strtotime($end_date)));
        $receive_payments = $this->accounting_receive_payment_model->get_ranged_received_payment_by_company_id(getLoggedCompanyID(), $last_start_date, $last_end_date);
        $last_income=0;
        $last_income_per_day = array();
        $last_income_per_month = array();
        $last_income_per_quarter = array();
        foreach ($receive_payments as $payment) {
            $last_income +=$payment->amount;

            $per_day_index=date("d", strtotime($payment->payment_date))+10;
            $last_income_per_day[$per_day_index]+=$payment->amount;

            $per_month_index=date("m", strtotime($payment->payment_date))+10;
            $last_income_per_month[$per_month_index]+=$payment->amount;

            $month = date("n", strtotime($payment->payment_date));
            $yearQuarter = ceil($month / 3);
            $last_income_per_quarter[$yearQuarter] +=$payment->amount;
        }

        // ksort($last_income_per_day);
        // ksort($last_income_per_month);
        // ksort($last_income_per_quarter);

        $data = new stdClass();
        $data->current_income=$current_income;
        $data->last_income=$last_income;
        $data->formatted_current_income=number_format($current_income, 2);
        $data->formatted_last_income=number_format($last_income, 2);
        $data->income_per_day=$income_per_day;
        $data->income_per_month=$income_per_month;
        $data->income_per_quarter=$income_per_quarter;
        $data->last_income_per_day=$last_income_per_day;
        $data->last_income_per_month=$last_income_per_month;
        $data->last_income_per_quarter=$last_income_per_quarter;
        $data->income_label=$income_label;
        $data->last_income_label=$last_income_label;
        $data->income_month_label=$income_month_label;
        $data->income_year_label=$income_year_label;

        if (date("m", strtotime($last_start_date)) == date("m", strtotime($last_end_date))) {
            $data->more_than_prev_month_label=date("M d", strtotime($last_start_date))." - ".date("d, Y", strtotime($last_end_date));
        } else {
            $data->more_than_prev_month_label=date("M d", strtotime($last_start_date))." - ".date("M d, Y", strtotime($last_end_date));
        }

        if ($last_income <= $current_income) {
            $data->increased_decreased_label=number_format($current_income-$last_income, 2);
            $data->increased = true;
        } else {
            $data->increased_decreased_label=number_format($last_income-$current_income, 2);
            $data->increased = false;
        }
        
        echo json_encode($data);
    }
}
