<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AccountingPayroll extends MY_Controller
{
    public function apiGetPayroll()
    {
        $query = <<<SQL
        SELECT * FROM `accounting_expense` WHERE `vendor_id` in (SELECT `employee_id` FROM `accounting_payroll_employees`)
SQL;

        $results = $this->db->query($query)->result();
        header('content-type: application/json');
        echo json_encode(['data' => $results]);
    }
}
