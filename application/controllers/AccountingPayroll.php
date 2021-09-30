<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AccountingPayroll extends MY_Controller
{
    public function apiGetPayrollTaxPayments()
    {
        $query = <<<SQL
        SELECT `a`.*
            FROM `accounting_chart_of_accounts` `a`
            LEFT JOIN `accounting_vendor_transaction_categories` `c`
        ON `a`.`id` = `c`.`expense_account_id`
        WHERE `c`.`id` IS NOT NULL
        AND `c`.`tax` = 1
SQL;
        $results = $this->db->query($query)->result();

        foreach ($results as $result) {
            $result->date_range = $this->getAccountDateRange($result);
        }

        header('content-type: application/json');
        echo json_encode(['data' => $results]);
    }

    private function getAccountDateRange($result)
    {
        $dateCreated = new DateTime($result->created_at);
        $dateEnd = new DateTime('last day of december ' . date('Y'));
        $dateStart = null;

        switch (strtolower($result->time)) {
            case 'beginning-of-year':
                $dateStart = new DateTime('first day of january ' . $dateCreated->format('Y'));
                break;

            case 'beginning-of-month':
                $createdMonth = $dateCreated->format('M');
                $dateStart = new DateTime("first day of ${createdMonth} " . $dateCreated->format('Y'));
                break;

            case 'today':
                $dateStart = $dateCreated;
                break;

            case 'other':
                if ($this->isValidDate($result->time_date)) {
                    $dateStart = new DateTime($result->time_date);
                }
                break;

            default:
                break;
        }

        if (is_null($dateStart)) {
            return null;
        }

        $dateEndString = $dateEnd->format('m/d/Y');
        $dateStartString = $dateStart->format('m/d/Y');
        return $dateStartString . ' — ' . $dateEndString;
    }

    private function isValidDate($date)
    {
        try {
            new DateTime($date);
        } catch (Exception $error) {
            return false;
        }

        return true;
    }
}
