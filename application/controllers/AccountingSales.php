<?php
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
        $this->db->insert('accounting_tax_agencies', $payload);

        $this->db->where('id', $this->db->insert_id());
        $record = $this->db->get('accounting_tax_agencies')->row();

        header('content-type: application/json');
        echo json_encode(['data' => $record]);
    }

    public function apiGetAgencies()
    {
        header('content-type: application/json');
        echo json_encode(['data' => $this->db->get('accounting_tax_agencies')->result()]);
    }
}
