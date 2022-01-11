<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AccountingARSummary extends MY_Controller
{
    public function apiGetReports()
    {

        header('content-type: application/json');
        echo json_encode(['data' => $this->getReports()]);
    }

    private function getReports()
    {
        $this->load->model('accounting_invoices_model');
        $customers = $this->accounting_invoices_model->getCustomersInv();

        $retval = [];
        foreach ($customers as $customer) {
            $dateNow = date('Y-m-d');
            $dueDate = date('Y-m-d', strtotime($customer->due_date));
            // $interval = $dateNow->diff($dueDate);
            // $diff = abs(strtotime($dateNow) - strtotime($dueDate));
            // $datediff = abs($dateNow - $dueDate);
            // $datediff = abs($dateNow - $dueDate);

            // $no_of_days =  floor($datediff / (60 * 60 * 24));
            // $diff=date_diff($dateNow,$dueDate);

            $diff = abs($dateNow - $dueDate);

            // To get the year divide the resultant date into
            // total seconds in a year (365*60*60*24)
            $years = floor($diff / (365 * 60 * 60 * 24));

            // To get the month, subtract it with years and
            // divide the resultant date into
            // total seconds in a month (30*60*60*24)
            $months = floor(($diff - $years * 365 * 60 * 60 * 24)
                / (30 * 60 * 60 * 24));

            // To get the day, subtract it with years and
            // months and divide the resultant date into
            // total seconds in a days (60*60*24)
            $days = floor(($diff - $years * 365 * 60 * 60 * 24 -
                $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));

            array_push($retval, [
                'name' => $customer->first_name . ' ' . $customer->last_name,
                'current' => number_format($customer->grand_total, 2),
                '1to30' => $days,
                '31to60' => '',
                '61to90' => '',
                '91andOver' => '$0.00',
                'total' => number_format($customer->grand_total, 2),
            ]);
        }

        array_push($retval, [
            'name' => 'Total',
            'current' => '$0.00',
            '1to30' => '$0.00',
            '31to60' => '$0.00',
            '61to90' => '$0.00',
            '91andOver' => '$0.00',
            'total' => '$0.00',
        ]);

        return $retval;
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
}
