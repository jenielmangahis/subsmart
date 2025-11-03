<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CustomerDashboardWidget extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('General_model', 'general');
    }

    public function saveCustomerEquipment()
    {
        $input = $this->input->post();

        $equipmentData = [
            'customer_id' => $input['addEquipmentCustomerId'] ?? null,
            'equipment'   => $input['addEquipmentName'] ?? null,
            'category'    => $input['addEquipmentCategory'] ?? null,
            'device_type' => $input['addEquipmentDeviceType'] ?? null,
            'serial_no'   => $input['addEquipmentSerialNo'] ?? null,
            'model_no'    => $input['addEquipmentModelNo'] ?? null,
            'qty'         => $input['addEquipmentQty'] ?? null,
            'status'      => $input['addEquipmentStatus'] ?? null,
            'qr_code'     => $input['addEquipmentQRCodeBase64'] ?? null,
        ];

        $inserted = $this->general->add_return_id($equipmentData, 'customer_equipment');

        echo json_encode($inserted);
    }

    public function updateCustomerEquipment()
    {
        $input = $this->input->post();
        $id = $input['editEquipmentId'] ?? null;

        $data = [
            'category'     => $input['editEquipmentCategory'] ?? '',
            'device_type'  => $input['editEquipmentDeviceType'] ?? '',
            'serial_no'    => $input['editEquipmentSerialNo'] ?? '',
            'model_no'     => $input['editEquipmentModelNo'] ?? '',
            'qty'          => $input['editEquipmentQty'] ?? '',
            'equipment'    => $input['editEquipmentName'] ?? '',
            'status'       => $input['editEquipmentStatus'] ?? '',
            'date_updated' => date('Y-m-d H:i:s'),
        ];

        if (!empty($input['editEquipmentQRCodeBase64'])) {
            $data['qr_code'] = $input['editEquipmentQRCodeBase64'];
        }

        $updated = $this->general->update_with_key($data, $id, 'customer_equipment');

        echo json_encode($updated);
    }

    public function removeCustomerEquipment()
    {
        $input = $this->input->post();
        $id = $input['id'] ?? null;

        if (empty($id)) {
            echo json_encode(['success' => false, 'message' => 'Missing equipment ID.']);
            return;
        }

        $deleted = $this->general->delete_([
            'table' => 'customer_equipment',
            'where' => ['id' => $id]
        ]);
    
        echo json_encode($deleted);
    }
   
    public function getCustomerEquipment()
    {
        $customer_id = $this->input->post('customer_id');

        $this->db->select('
            customer_equipment.id,
            customer_equipment.customer_id,
            customer_equipment.equipment,
            customer_equipment.category,
            customer_equipment.device_type,
            customer_equipment.serial_no,
            customer_equipment.model_no,
            customer_equipment.qty,
            customer_equipment.status,
            customer_equipment.date_created,
            customer_equipment.date_updated
        ');
        $this->db->from('customer_equipment');
        $this->db->where('customer_equipment.customer_id', "$customer_id");
        $query = $this->db->get();
        $data = $query->result();

        echo json_encode($data);
    }

    public function updatePanelEquipmentLocation()
    {
        $input = $this->input->post();

        $data = [
            'customer_id'  => $input['customer_id'],
            'panel'        => $input['panelLocation'],
            'transformer'  => $input['transformerLocation'],
        ];

        $replace = $this->db->replace('panel_equipment_location', $data);

        echo json_encode($replace);
    }

    public function getPanelLocation()
    {
        $customer_id = $this->input->post('customer_id');

        $this->db->select('
            panel_equipment_location.panel,
            panel_equipment_location.transformer
        ');
        $this->db->from('panel_equipment_location');
        $this->db->where('panel_equipment_location.customer_id', "$customer_id");
        $query = $this->db->get();
        $data = $query->result();

        echo json_encode($data);
    }

    public function getRemoteUtilityInfo()
    {
        $customer_id = $this->input->post('customer_id');
        $alarmcom_customer_id = $this->input->post('alarmcom_customer_id');

        $query = $this->db->query("
            SELECT 
                alarmcom_customers.customer_id AS data,
                'customer_info' AS category
            FROM alarmcom_customers
            WHERE alarmcom_customers.customer_id = {$alarmcom_customer_id}
            UNION
            SELECT 
                acs_profile.status AS data,
                'status' AS category
            FROM acs_profile
            WHERE acs_profile.prof_id = {$customer_id}
            UNION
            SELECT 
                COUNT(acs_customer_documents.id) AS data,
                'documents' AS category
            FROM acs_customer_documents
            WHERE acs_customer_documents.customer_id = {$customer_id}
            UNION
            SELECT 
                0 AS data,
                'gallery' AS category
            FROM acs_customer_documents
            WHERE acs_customer_documents.customer_id = {$customer_id}
            UNION
            SELECT 
                alarmcom_customers.panel_version AS data,
                'panel_version' AS category
            FROM alarmcom_customers
            WHERE alarmcom_customers.customer_id = {$alarmcom_customer_id}
            UNION
            SELECT 
                alarmcom_customers.login_name AS data,
                'login_name' AS category
            FROM alarmcom_customers
            WHERE alarmcom_customers.customer_id = {$alarmcom_customer_id}
            UNION
            SELECT 
                alarmcom_customers.package_description AS data,
                'package_description' AS category
            FROM alarmcom_customers
            WHERE alarmcom_customers.customer_id = {$alarmcom_customer_id}
            UNION
            SELECT 
                'Always' AS data,
                'monitoring' AS category
            UNION
            SELECT 
                ROUND(SUM(data), 2) AS data,
                'ledger_balance' AS category
            FROM (
                SELECT 
                    ROUND(
                        CASE 
                            WHEN (
                                CASE 
                                    WHEN invoices.job_id IS NOT NULL AND invoices.job_id != '' THEN 
                                        (SELECT SUM(job_items.total) FROM job_items WHERE job_items.job_id = jobs.id)
                                    ELSE invoices.grand_total
                                END
                            ) - COALESCE(SUM(payment_records.invoice_amount), 0) < 0 
                            THEN 0
                            ELSE (
                                CASE 
                                    WHEN invoices.job_id IS NOT NULL AND invoices.job_id != '' THEN 
                                        (SELECT SUM(job_items.total) FROM job_items WHERE job_items.job_id = jobs.id)
                                    ELSE invoices.grand_total
                                END
                            ) - COALESCE(SUM(payment_records.invoice_amount), 0)
                        END
                    , 2) AS data
                FROM invoices
                LEFT JOIN payment_records ON payment_records.invoice_id = invoices.id
                LEFT JOIN users ON users.id = invoices.user_id
                LEFT JOIN jobs ON jobs.id = invoices.job_id
                LEFT JOIN acs_profile ON acs_profile.prof_id = invoices.customer_id
                WHERE invoices.company_id = 31
                AND invoices.customer_id = {$customer_id}
                AND invoices.view_flag = 0
                GROUP BY invoices.id
            ) AS t
            UNION
            SELECT 
                COUNT(acs_notes.id) AS data,
                'notes' AS category
            FROM acs_notes
            WHERE acs_notes.fk_prof_id = {$customer_id}
        ");
        $data = $query->result();
        echo json_encode($data);
    }
}