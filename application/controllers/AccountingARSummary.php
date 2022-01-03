<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AccountingARSummary extends MY_Controller
{
    public function apiGetReports()
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

        header('content-type: application/json');
        echo json_encode(['data' => $retval]);
    }
}
