<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ReportParams
{
    public function __construct(array $config)
    {
        $this->reportPeriodDate = $config['report_period_value'];
        $this->daysPerAging = (int) $config['days_per_aging_period'];
        $this->numberOfPeriods = (int) $config['number_of_periods'];
    }
}

class AccountingARSummary extends MY_Controller
{
    public function apiGetReports()
    {

        header('content-type: application/json');
        echo json_encode(['data' => $this->getReports()]);
    }

    private function getReports(ReportParams $params = null)
    {
        if (is_null($params)) {
            $this->db->where('user_id', logged('id'));
            $form = $this->db->get('accounting_ar_summary_form')->row_array();

            if ($form) {
                $params = new ReportParams($form);
            } else {
                $firstDayOfYear = new \DateTime(date('Y') . '-01-01');
                $params = new ReportParams([
                    'report_period_value' => $firstDayOfYear->format('Y-m-d'),
                    'days_per_aging_period' => 30,
                    'number_of_periods' => 4,
                ]);
            }
        }

        $reportPeriodDate = $params->reportPeriodDate;
        $daysPerAging = $params->daysPerAging;
        $numberOfPeriods = $params->numberOfPeriods;

        $reportPeriod = new DateTimeImmutable($reportPeriodDate);
        $companyId = logged('company_id');

        $query = <<<SQL
            SELECT
                invoices.due_date,
                invoices.total_due,
                invoices.customer_id,
                CONCAT(acs_profile.first_name, ' ', acs_profile.last_name) AS customer_name
            FROM invoices LEFT JOIN acs_profile ON acs_profile.prof_id = invoices.customer_id
            WHERE invoices.customer_id != 0 AND acs_profile.company_id = {$companyId};
        SQL;

        $query = $this->db->query($query);
        $invoices = $query->result();

        $invoices = array_map(function ($invoice) {
            $invoice->customer_id = (int) $invoice->customer_id;
            $invoice->total_due = (float) $invoice->total_due;
            return $invoice;
        }, $invoices);

        $periods = [];
        for ($i = 1; $i <= $numberOfPeriods; $i++) {
            $isLastLoop = $i === $numberOfPeriods;
            $isFirstLoop = $i === 1;

            $id = $isFirstLoop ? $i . 'to' . ($i * $daysPerAging) : (($i * $daysPerAging) - $daysPerAging) + 1 . 'to' . $i * $daysPerAging;
            if ($isLastLoop) {
                $id = (($i * $daysPerAging) - $daysPerAging) + 1 . 'andOver';
            }

            array_push($periods, [
                'id' => $id,

                // if not the first period, get the last period's end date then add 1 day
                'start' => $isFirstLoop ? $reportPeriod : $periods[count($periods) - 1]['end']->modify('1 day'),

                // if this is the last period, set end as the last possible date
                // @see https://stackoverflow.com/a/25305918/8062659.
                'end' => $isLastLoop ? new DateTime('99999/12/31') : $reportPeriod->modify(($daysPerAging * $i) . ' day'),
            ]);
        }

        $records = [];
        foreach ($invoices as $invoice) {
            $dueDate = new DateTime($invoice->due_date);
            $recordIndex = array_search($invoice->customer_id, array_column($records, 'customer_id'));
            $isExists = $recordIndex !== false;

            $record = [
                'customer_id' => $invoice->customer_id,
                'name' => $invoice->customer_name,
            ];
            if ($isExists) {
                $record = $records[$recordIndex];
            }

            foreach ($periods as $period) {
                if (!array_key_exists($period['id'], $record)) {
                    $record[$period['id']] = 0;
                }

                if ($dueDate >= $period['start'] && $dueDate <= $period['end']) {
                    $record[$period['id']] = $record[$period['id']] + (float) $invoice->total_due;
                }
            }

            if ($isExists) {
                $records[$recordIndex] = $record;
            } else {
                $records[] = $record;
            }
        }

        $periodIds = array_map(function ($period) {return $period['id'];}, $periods);
        return array_map(function ($record) use ($periodIds) {
            $total = 0;
            foreach ($record as $key => $data) {
                if (!in_array($key, $periodIds)) {
                    continue;
                }

                $total += $data;
                $record[$key] = number_format($data, 2);
            }

            $record['total'] = number_format($total, 2);
            return $record;
        }, $records);
    }

    public function apiExportExcel()
    {
        $storePath = FCPATH . 'uploads/rulesxlsx/';
        if (!file_exists($storePath)) {
            mkdir($storePath, 0777, true);
        }

        $results = $this->getReports();

        require_once FCPATH . 'packages/xlsxwriter/xlsxwriter.class.php';
        $fileName = md5(uniqid(logged('id'), true)) . '.xlsx';
        $filePath = $storePath . '/' . $fileName;
        $sheetname = 'Worksheet';
        $header = [
            '' => 'string',
            'Current' => 'string',
            '1 - 30' => 'string',
            '31 - 60' => 'string',
            '61 - 90' => 'string',
            '91 and over' => 'string',
            'Total' => 'string',
        ];

        $writer = new XLSXWriter();
        $writer->writeSheetHeader($sheetname, $header);
        $writer->writeSheet($results, $sheetname);
        $writer->writeToFile($filePath);

        if (file_exists($filePath)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filePath));
            readfile($filePath);
            unlink($filePath);
            exit;
        }
    }

    public function apiGetCurrentUser()
    {
        $this->db->where('id', logged('id'));
        $user = $this->db->get('users')->row();
        $user->fullName = $user->FName . ' ' . $user->LName;

        header('content-type: application/json');
        echo json_encode(['data' => $user]);
    }

    public function apiSendEmail()
    {
        header('content-type: application/json');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false]);
            return;
        }

        $payload = json_decode(file_get_contents('php://input'), true);

        include APPPATH . 'controllers/DocuSign.php';

        $mail = getMailInstance();
        $templatePath = VIEWPATH . 'esign/docusign/email/ar-summary.html';
        $template = file_get_contents($templatePath);

        $data = [
            '%message%' => $payload['body'],
        ];
        $message = strtr($template, $data);

        $mail->Subject = $payload['subject'];
        $mail->MsgHTML($message);
        $mail->addAddress($payload['to']);
        $mail->send();
        $mail->ClearAllRecipients();

        echo json_encode(['data' => $payload]);
    }

    public function apiGetTableInfo()
    {
        $this->db->where('company_id', logged('id'));
        $this->db->select('id');
        $currInfo = $this->db->get('accounting_ar_summary_info')->row();

        if (is_null($currInfo)) {
            $this->db->where('id', logged('id'));
            $client = $this->db->get('clients')->row();
            $this->db->insert('accounting_ar_summary_info', [
                'company_id' => $client->id,
                'title' => $client->business_name,
                'subtitle' => 'A/R Aging Summary',
            ]);
        }

        $this->db->where('company_id', logged('id'));
        $currInfo = $this->db->get('accounting_ar_summary_info')->row();

        header('content-type: application/json');
        echo json_encode(['data' => $currInfo]);
    }

    public function apiSaveTableInfo()
    {
        header('content-type: application/json');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false]);
            return;
        }

        $payload = json_decode(file_get_contents('php://input'), true);

        $this->db->where('company_id', logged('id'));
        $this->db->select('id');
        $currInfo = $this->db->get('accounting_ar_summary_info')->row();

        if (is_null($currInfo)) {
            $payload['company_id'] = logged('id');
            $this->db->insert('accounting_ar_summary_info', $payload);
        } else {
            $this->db->where('id', $currInfo->id);
            $this->db->update('accounting_ar_summary_info', $payload);
        }

        $this->db->where('company_id', logged('id'));
        $currInfo = $this->db->get('accounting_ar_summary_info')->row();
        echo json_encode(['data' => $currInfo]);
    }

    public function apiRunReport()
    {
        header('content-type: application/json');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false]);
            return;
        }

        $payload = json_decode(file_get_contents('php://input'), true);
        $params = new ReportParams($payload);
        echo json_encode(['data' => $this->getReports($params)]);
    }

    public function apiRunReportCustomize()
    {
        header('content-type: application/json');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false]);
            return;
        }

        $payload = json_decode(file_get_contents('php://input'), true);

        $this->db->where('user_id', logged('id'));
        $form = $this->db->get('accounting_ar_summary_form')->row();

        $input = [
            'user_id' => logged('id'),
            'report_period' => $payload['report_period'],
            'report_period_value' => $payload['report_period_value'],
            'divide_by_1000' => $payload['divide_by_1000'],
            'without_cents' => $payload['without_cents'],
            'except_zero_amount' => $payload['except_zero_amount'],
            'negative_numbers' => $payload['negative_numbers'],
            'negative_numbers_show_in_red' => $payload['negative_numbers_show_in_red'],
            'show_nonzero_or_active_only' => $payload['show_nonzero_or_active_only'],
            'aging_method' => $payload['current'] ? 'current' : 'report_date',
            'number_of_periods' => $payload['number_of_periods'],
            'days_per_aging_period' => $payload['days_per_aging_period'],
            'filter_customer' => $payload['filter_customer'],
            'show_logo' => $payload['show_logo'],
            'company_name' => $payload['company_name'],
            'company_name_value' => $payload['company_name_value'],
            'report_title' => $payload['report_title'],
            'report_title_value' => $payload['report_title_value'],
            'header_report_period' => $payload['header_report_period'],
            'date_prepared' => $payload['date_prepared'],
            'time_prepared' => $payload['time_prepared'],
            'header' => $payload['header'],
            'footer' => $payload['footer'],
        ];

        if ($form) {
            $this->db->where('id', $form->id);
            $this->db->update('accounting_ar_summary_form', $input);
        } else {
            $this->db->insert('accounting_ar_summary_form', $input);
        }

        $this->db->where('user_id', logged('id'));
        $form = $this->db->get('accounting_ar_summary_form')->row();
        echo json_encode(['data' => $form]);
    }

    public function apiGetReportCustomize()
    {
        $this->db->where('user_id', logged('id'));
        $form = $this->db->get('accounting_ar_summary_form')->row();
        echo json_encode(['data' => $form]);
    }

    public function apiSaveCustomizationPopoverForm()
    {
        header('content-type: application/json');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false]);
            return;
        }

        $payload = json_decode(file_get_contents('php://input'), true);
        echo json_encode(['data' => $payload]);
    }
}
