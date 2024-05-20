<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Accounting_paychecks_model extends MY_Model
{

	public $table = 'accounting_paychecks';

	public function __construct()
	{
		parent::__construct();
	}

	public function insert_by_batch($data)
	{
		$this->db->insert_batch($this->table, $data);
		return $this->db->insert_id();
	}

	public function get_company_paychecks($companyId)
	{
		$this->db->where('company_id', $companyId);
		$this->db->where('status', 1);
		$query = $this->db->get($this->table);
		return $query->result();
	}

	public function get_by_id($id)
	{
		$this->db->where('id', $id);
		$query = $this->db->get($this->table);
		return $query->row();
	}

	public function update_check_no($id, $checkNumber)
	{
		$this->db->where('id', $id);
		$update = $this->db->update($this->table, ['check_no' => $checkNumber]);
		return $update ? true : false;
	}

	public function void_paycheck($paycheckId)
	{
		$this->db->where('id', $paycheckId);
		$update = $this->db->update($this->table, ['status' => 4]);
		return $update ? true : false;
	}

	public function batch_void_paycheck($id)
	{
		$data = [
			'status' => '4',
			'check_no' => 'Void'
		];
		$this->db->where('id', $id);
		$this->db->update('accounting_paychecks', $data);
	}

	public function batch_delete_paycheck($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('accounting_paychecks');
	}

	public function get_by_employee_id($employeeId)
	{
		$this->db->where('employee_id', $employeeId);
		$query = $this->db->get($this->table);
		return $query->result();
	}

	public function get_voided_paychecks($companyId)
	{
		$this->db->where('company_id', $companyId);
		$this->db->where('status', '4');
		$query = $this->db->get('accounting_paychecks');

		if ($query->num_rows() > 0) {
			$paychecks = $query->result_array();
			$data = [];

			foreach ($paychecks as $paycheck) {
				$employee = $this->users_model->getUser($paycheck['employee_id']);
				$employee_name = $employee ? "{$employee->LName}, {$employee->FName}" : 'No name provided';

				$checkNo = $paycheck['check_no'];
				if ($paycheck['status'] === '4') {
					$checkNo = 'Void';
				}

				if ($paycheck['pay_method'] === 'Adjustment' && $paycheck['status'] !== '4') {
					$checkNo = '-';
				}

				$data[] = [
					'id' => $paycheck['id'],
					'pay_date' => date("m/d/Y", strtotime($paycheck['pay_date'])),
					'employee_id' => $paycheck['employee_id'],
					'name' => $employee_name,
					'total_pay' => number_format(floatval(str_replace(',', '', $paycheck['total_pay'])), 2),
					'net_pay' => number_format(floatval(str_replace(',', '', $paycheck['net_pay'])), 2),
					'pay_method' => $paycheck['pay_method'],
					'check_number' => $checkNo,
					'status' => 'Void'
				];
			}

			return $data;
		} else {
			return false;
		}
	}
}
