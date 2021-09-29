<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AccountingPayroll extends MY_Controller
{
    public function getPayrollTaxPayments()
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

        header('content-type: application/json');
        echo json_encode(['data' => $results]);
    }
}
