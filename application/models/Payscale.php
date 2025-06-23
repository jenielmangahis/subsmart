<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Payscale extends MY_Model
{
    public function calculateCommission($employee_id, $reference_id, $reference_no, $reference_status, $gross, $net, $type)
    {
        $this->db->select('id, company_id, employee_id, commission_name, commission_type, commission_value');
        $this->db->from('employee_commission_settings');
        $this->db->where('employee_id', $employee_id);
        $commissions = $this->db->get()->result();

        if (empty($commissions)) {
            return;
        }

        foreach ($commissions as $commission) {
            if (stripos($commission->commission_name, $type) === false) {
                continue;
            }

            $calculated_commission = 0;

            switch ($commission->commission_type) {
                case 'net_percentage':
                    $calculated_commission = $net * ($commission->commission_value / 100);
                    break;
                case 'gross_percentage':
                    $calculated_commission = $gross * ($commission->commission_value / 100);
                    break;
                case 'fixed_amount':
                    $calculated_commission = $commission->commission_value;
                    break;
            }

            $this->db->select('id');
            $this->db->from('employee_commission_summary');
            $this->db->where([
                'employee_id'  => $employee_id,
                'reference_id' => $reference_id
            ]);
            $existing = $this->db->get()->row();

            $data = [
                'company_id'            => $commission->company_id,
                'employee_id'           => $employee_id,
                'reference_id'          => $reference_id,
                'reference_no'          => $reference_no,
                'reference_status'      => $reference_status,
                'commission_name'       => $commission->commission_name,
                'commission_type'       => $commission->commission_type,
                'commission_value'      => $commission->commission_value,
                'calculated_commission' => $calculated_commission,
                'date_updated'          => date('Y-m-d H:i:s')
            ];

            if ($existing) {
                $this->db->where('id', $existing->id);
                $this->db->update('employee_commission_summary', $data);
            } else {
                $data['date_created'] = date('Y-m-d H:i:s');
                $this->db->insert('employee_commission_summary', $data);
            }
        }
    }

    public function updateCommissionStatus($reference_id, $reference_status)
    {
        $this->db->where('reference_id', $reference_id);
        $this->db->update('employee_commission_summary', [
            'reference_status' => $reference_status,
            'date_updated'     => date('Y-m-d H:i:s')
        ]);
    }
}